<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CoachBlogRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // or Imagick\Driver
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    protected $blogRepo;

    public function __construct(CoachBlogRepositoryInterface $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

    public function index()
    {
        $blogs = $this->blogRepo->getCoachBlogs(Auth::id());
        return view('coach.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('coach.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=1267,height=463',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ], [
            'featured_image.dimensions' => 'Featured image must be exactly 1267 x 463 px.',
        ]);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $this->uploadImage($request->file('featured_image'));
        }

        $data['user_id'] = Auth::id();
        $this->blogRepo->store($data);

        return redirect()->route('coach.blogs.index')->with('success', 'Article submitted for review.');
    }

    public function edit(string $id)
    {
        $blog = $this->blogRepo->findCoachBlog(Auth::id(), $id);
        $categories = Category::where('is_active', 1)->get();

        return view('coach.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=1267,height=463',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ], [
            'featured_image.dimensions' => 'Featured image must be exactly 1267 x 463 px.',
        ]);

        if ($request->hasFile('featured_image')) {
            // Optional: Delete old image logic
            $blog = $this->blogRepo->findCoachBlog(Auth::id(), $id);
            if ($blog->featured_image && File::exists(public_path($blog->featured_image))) {
                File::delete(public_path($blog->featured_image));
            }

            $data['featured_image'] = $this->uploadImage($request->file('featured_image'));
        }

        $this->blogRepo->update($id, $data, Auth::id());

        return redirect()->route('coach.blogs.index')->with('success', 'Article updated.');
    }

    public function destroy(string $id)
    {
        $blog = $this->blogRepo->findCoachBlog(Auth::id(), $id);

        if ($blog->featured_image && File::exists(public_path($blog->featured_image))) {
            File::delete(public_path($blog->featured_image));
        }

        $this->blogRepo->delete($id, Auth::id());
        return redirect()->route('coach.blogs.index')->with('success', 'Article deleted.');
    }

    /**
     * Helper for Intervention Image Upload
     */
    private function uploadImage($file)
    {
        // 1. Generate a unique filename
        $filename = time() . '_' . uniqid() . '.webp';
        $directory = 'uploads/blogs';
        $path = $directory . '/' . $filename;

        // 2. Initialize Intervention Image Manager
        $manager = new ImageManager(new Driver());

        // 3. Read, Resize, and Encode
        $encoded = $manager->read($file)
            ->cover(800, 450) // Maintain 16:9 ratio
            ->toWebp(80);     // 80% quality WebP

        Storage::disk('public')->put($path, (string) $encoded);

        // 5. Return the path (Store this in the DB)
        return $path;
    }
}
