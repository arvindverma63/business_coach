<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Contracts\MessageRequestInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{
    public function __construct(
        protected MessageRequestInterface $requestRepo
    ) {}

    public function index(Request $request)
    {
        $query = User::with([
                'categories',
                'coachProfile.categories',
                'blogs' => function ($query) {
                    $query->with('category')
                        ->where('is_published', true)
                        ->latest();
                },
                'mediaGallery' => function ($query) {
                    $query->with('category')->latest();
                },
            ])
            ->where('user_type', 2) // Coach
            ->whereHas('coachProfile', function ($q) {
                $q->where('approval_status', 'approved');
            });

        // Search by name OR category
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('coachProfile.categories', function ($catQuery) use ($search) {
                        $catQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $coaches = $query->latest()->paginate(12);

        return view('seeker.coaches.index', compact('coaches'));
    }

    public function sendRequest(Request $request, $coachId)
    {
        $seekerId = Auth::id();

        // 1. Prevent duplicate requests using the repository check
        $existingRequest = \App\Models\MessageRequest::where('sender_id', $seekerId)
            ->where('receiver_id', $coachId)
            ->whereIn('status', ['pending', 'accepted'])
            ->first();

        if ($existingRequest) {
            return back()->with('error', 'A connection request is already ' . $existingRequest->status . '.');
        }

        // 2. Prevent self-messaging
        if ($seekerId === $coachId) {
            return back()->with('error', 'You cannot send a request to yourself.');
        }

        // 3. Create the request via repository
        $this->requestRepo->sendRequest([
            'sender_id' => $seekerId,
            'receiver_id' => $coachId,
            'message' => $request->message ?? "Hi, I would like to connect with you for coaching.",
        ]);

        return back()->with('success', 'Connection request sent successfully!');
    }
}
