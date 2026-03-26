<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SeekersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoachProfileRequest;
use App\Http\Requests\Admin\UpdateCoachProfileRequest;
use App\Imports\CoachesImport;
use App\Repositories\Contracts\CoachRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;


class CoachController extends Controller
{
    protected $coachRepo;
    protected $categoryRepo;

    public function __construct(
        CoachRepositoryInterface $coachRepo,
        CategoryRepositoryInterface $categoryRepo
    ) {
        $this->coachRepo = $coachRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:100',
            'status' => 'nullable|in:approved,pending,rejected',
        ]);

        $coaches = $this->coachRepo->getAll();
        return view('admin.coaches.index', compact('coaches'));
    }

    public function create()
    {
        $categories = $this->categoryRepo->getAll();
        return view('admin.coaches.create', compact('categories'));
    }

    public function store(StoreCoachProfileRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $profilePicturePath = null;
                if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
                    $file = $request->file('profile_picture');
                    $filename = 'coach_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('users/coaches', $filename, 'public');
                    $profilePicturePath = 'storage/' . $path;
                }

                $user = User::create([
                    'name'              => $request->name,
                    'email'             => $request->email,
                    'phone'             => $request->phone,
                    'profile_image'     => $profilePicturePath,
                    'password'          => Hash::make(Str::random(12)),
                    'user_type'         => 2,
                    'email_verified_at' => now(),
                    'status'            => $request->has('status') ? 1 : 0
                ]);

                $categoryIds = $this->processCategories($request->categories);

                $profileData = $request->only([
                    'gender',
                    'company_name',
                    'designation',
                    'city',
                    'state',
                    'linkedin_url',
                    'website_url',
                    'experience_years',
                    'bio',
                    'ranking_score',
                    'current_rank',
                    'approval_status'
                ]);

                $profileData['user_id'] = $user->id;
                $profileData['categories'] = $categoryIds;
                $profileData['is_visible'] = $request->has('is_visible') ? 1 : 0;
                $profileData['is_featured'] = $request->has('is_featured') ? 1 : 0;
                $profileData['show_personal_details'] = $request->has('show_personal_details') ? 1 : 0;

                $this->coachRepo->create($profileData);
            });

            return redirect()->route('admin.coaches.index')->with('success', 'Coach account created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(string $id)
    {
        $coach = $this->coachRepo->findById($id);

        if (!$coach) {
            return redirect()->route('admin.coaches.index')->with('error', 'Coach not found.');
        }

        $categories = $this->categoryRepo->getAll();
        return view('admin.coaches.edit', compact('coach', 'categories'));
    }

    public function update(UpdateCoachProfileRequest $request, string $id)
    {
        try {
            $coach = $this->coachRepo->findById($id);
            if (!$coach) return back()->with('error', 'Coach not found.');

            DB::transaction(function () use ($request, $coach) {
                $userData = [
                    'name'   => $request->name,
                    'email'  => $request->email,
                    'phone'  => $request->phone,
                    'status' => $request->has('status') ? 1 : 0,
                ];

                if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
                    if ($coach->user->profile_image) {
                        Storage::disk('public')->delete(str_replace('storage/', '', $coach->user->profile_image));
                    }
                    $file = $request->file('profile_picture');
                    $filename = 'coach_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('users/coaches', $filename, 'public');
                    $userData['profile_image'] = 'storage/' . $path;
                }

                $coach->user->update($userData);

                $categoryIds = $this->processCategories($request->categories);

                $profileData = $request->only([
                    'gender',
                    'company_name',
                    'designation',
                    'city',
                    'state',
                    'linkedin_url',
                    'website_url',
                    'experience_years',
                    'bio',
                    'ranking_score',
                    'current_rank',
                    'approval_status'
                ]);

                $profileData['categories'] = $categoryIds;
                $profileData['is_visible'] = $request->has('is_visible') ? 1 : 0;
                $profileData['is_featured'] = $request->has('is_featured') ? 1 : 0;
                $profileData['show_personal_details'] = $request->has('show_personal_details') ? 1 : 0;

                $this->coachRepo->update($coach->id, $profileData);
            });

            return redirect()->route('admin.coaches.index')->with('success', 'Coach profile updated.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, string $id)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);
        $this->coachRepo->updateStatus($id, $request->status);
        return back()->with('success', 'Coach status updated to ' . ucfirst($request->status));
    }

    public function destroy(string $id)
    {
        $coach = $this->coachRepo->findById($id);

        if (!$coach) {
            return back()->with('error', 'Coach not found.');
        }

        DB::transaction(function () use ($coach) {
            if ($coach->user) {
                $timestamp = now()->timestamp;
                $coach->user->email = "deleted_{$timestamp}_" . $coach->user->email;
                $coach->user->phone = "deleted_{$timestamp}_" . $coach->user->phone;
                $coach->user->save();
                $coach->user->delete();
            }
            $coach->delete();
        });

        return redirect()->route('admin.coaches.index')->with('success', 'Coach deleted successfully.');
    }

    private function processCategories($categories)
    {
        return collect($categories)->map(function ($value) {
            if (Str::isUuid($value) && Category::where('id', $value)->exists()) {
                return $value;
            }
            $newCategory = Category::firstOrCreate(
                ['name' => $value],
                ['slug' => Str::slug($value), 'is_active' => 1]
            );
            return $newCategory->id;
        })->toArray();
    }

    public function exportExcel()
    {
        return Excel::download(new SeekersExport, 'seekers_list.xlsx');
    }
}
