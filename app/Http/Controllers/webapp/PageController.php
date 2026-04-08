<?php

namespace App\Http\Controllers\webapp;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Contracts\BlogRepositoryInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{

    protected $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepositoryInterface)
    {

        $this->blogRepository = $blogRepositoryInterface;
    }

    public function index(){
        $categories = \App\Models\Category::where('is_active', 1)->get();

        $cities = \App\Models\CoachProfile::where('approval_status', 'approved')
            ->where('is_featured', 1)
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct()
            ->pluck('city');

        $blogs = \App\Models\Blog::where('is_published', true) // or your active status column
            ->latest()
            ->take(3)
            ->get();

        $featuredCoaches = \App\Models\CoachProfile::with('user')
            ->withCount(['receivedConnectionRequests as connection_requests_count'])
            ->where('approval_status', 'approved')
            ->where('is_featured', 1)
            ->orderByDesc('ranking_score')
            ->orderByDesc('connection_requests_count')
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        // Fetch active hero banners
        $heroBanners = \App\Models\HeroBanner::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('webapp.index', compact('categories', 'cities', 'featuredCoaches','blogs', 'heroBanners'));
    }

    public function aboutUs(){
        return view('webapp.about-us');
    }

    public function blogs(){
        $blogs = $this->blogRepository->getAll(12, true); // Show only published blogs
        $categories = Category::where('is_active', true)->get();
        return view('webapp.blogs', compact('blogs', 'categories'));
    }

    public function blogDetail($slug){
        $blog = $this->blogRepository->findBySlug($slug);
        if (!$blog) {
            abort(404);
        }
        return view('webapp.blog-detail', compact('blog'));
    }

    public function contact(){
        return view('webapp.contact');
    }

    public function rank(Request $request)
    {
        $query = \App\Models\CoachProfile::with('user')
            ->withCount(['receivedConnectionRequests as connection_requests_count'])
            ->where('approval_status', 'approved')
            ->where('is_featured', 1);

        $filterCities = \App\Models\CoachProfile::where('approval_status', 'approved')
            ->where('is_featured', 1)
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->select('city')
            ->distinct()
            ->orderBy('city', 'asc')
            ->pluck('city');

        if ($request->has('city')) {
            $query->whereIn('city', (array)$request->city);
        }
        $blogs = $this->blogRepository->getAll(12, true); // Show only published blogs
        $topCoaches = $query
            ->orderByDesc('ranking_score')
            ->orderByDesc('connection_requests_count')
            ->orderByDesc('created_at')
            ->paginate(10);


        return view('webapp.rank', compact('topCoaches', 'blogs', 'filterCities'));
    }
    public function findCoach()
    {
        // Fetch all active categories
        $categories = \App\Models\Category::where('is_active', 1)->get();

        // Fetch unique cities from coach profiles
        $cities = \App\Models\CoachProfile::where('approval_status', 'approved')
            ->where('is_featured', 1)
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct()
            ->orderBy('city', 'asc')
            ->pluck('city');

        return view('webapp.find-coach', compact('categories', 'cities'));
    }

   public function searchCoaches(Request $request)
    {
        $name = $request->input('name');
        $categorySlug = $request->input('category');
        $city = $request->input('city');

        $queryBuilder = \App\Models\CoachProfile::with('user')
            ->withCount(['receivedConnectionRequests as connection_requests_count'])
            ->where('approval_status', 'approved')
            ->where('is_featured', true);

        if ($name) {
            $queryBuilder->whereHas('user', function($q) use ($name) {
                $q->where('name', 'LIKE', "%{$name}%");
            });
        }
        if ($city) {
            $queryBuilder->where('city', $city);
        }

        if ($categorySlug) {
            $queryBuilder->whereHas('categories', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $results = $queryBuilder
            ->orderByDesc('ranking_score')
            ->orderByDesc('connection_requests_count')
            ->orderByDesc('created_at')
            ->paginate(10);

        $categories = \App\Models\Category::where('is_active', 1)->get();

        $cities = \App\Models\CoachProfile::where('approval_status', 'approved')
        ->where('is_featured', 1)
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct()
            ->pluck('city');

        return view('webapp.search-coach', compact('results', 'categories', 'cities'));
    }
    public function viewProfile($id){
        $coach = \App\Models\CoachProfile::with('user')->findOrFail($id);
        $coachBlogs = \App\Models\Blog::where('user_id', $coach->user_id)
            ->where('is_published', true)
            ->latest()
            ->take(6)
            ->get();

        // Fetch coach media
        $media = \App\Models\Media::where('model_type', 'App\\Models\\User')
            ->where('model_id', $coach->user_id)
            ->where('collection_name', 'profile_media')
            ->get();

        $connectionRequest = null;
        if (auth()->check() && auth()->user()->user_type === 3) {
            $connectionRequest = \App\Models\MessageRequest::where('sender_id', auth()->id())
                ->where('receiver_id', $coach->user_id)
                ->first();
        }

        $blogs = \App\Models\Blog::where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('webapp.view-profile', compact('coach', 'coachBlogs', 'blogs', 'connectionRequest', 'media'));
    }

    public function privacyPolicy(){
        $content = \App\Models\Page::where('type', 'privacy')->first();
        if ($content) {
            return view('webapp.privacy-policy', compact('content'));
        }
        return view('webapp.privacy-policy');
    }

    public function termsAndConditions(){
        $content = \App\Models\Page::where('type', 'terms')->first();
        if ($content) {
            return view('webapp.terms-and-conditions', compact('content'));
        }
        return view('webapp.terms-and-conditions');
    }

    public function sitemap()
    {
        $blogs = \App\Models\Blog::where('is_published', 1)->latest()->get();
        $coaches = \App\Models\CoachProfile::where('approval_status', 'approved')->get();

        return response()->view('webapp.sitemap', [
            'blogs' => $blogs,
            'coaches' => $coaches,
        ])->header('Content-Type', 'text/xml');
    }
}
