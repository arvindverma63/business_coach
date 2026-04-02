<?php

namespace App\Http\Controllers\Admin;

use App\Models\HeroBanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HeroBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = HeroBanner::orderBy('sort_order', 'asc')->paginate(10);
        return view('admin.hero-banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hero-banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        // Handle image uploads
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('hero-banners', 'public');
        }

        $validated['title'] = 'Hero Banner';
        $validated['subtitle'] = null;
        $validated['description'] = null;
        $validated['button_text'] = null;
        $validated['button_url'] = null;
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        HeroBanner::create($validated);

        return redirect()->route('admin.hero-banners.index')->with('success', 'Hero banner created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroBanner $heroBanner)
    {
        return view('admin.hero-banners.edit', compact('heroBanner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroBanner $heroBanner)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        // Handle image uploads
        if ($request->hasFile('image')) {
            if ($heroBanner->image && Storage::disk('public')->exists($heroBanner->image)) {
                Storage::disk('public')->delete($heroBanner->image);
            }
            $validated['image'] = $request->file('image')->store('hero-banners', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $heroBanner->update($validated);

        return redirect()->route('admin.hero-banners.index')->with('success', 'Hero banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroBanner $heroBanner)
    {
        if ($heroBanner->image && Storage::disk('public')->exists($heroBanner->image)) {
            Storage::disk('public')->delete($heroBanner->image);
        }

        $heroBanner->delete();
        return redirect()->route('admin.hero-banners.index')->with('success', 'Hero banner deleted successfully.');
    }

    /**
     * Toggle the active status.
     */
    public function toggleStatus(Request $request)
    {
        $banner = HeroBanner::findOrFail($request->id);
        $banner->is_active = !$banner->is_active;
        $banner->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully.',
            'is_active' => $banner->is_active
        ]);
    }
}
