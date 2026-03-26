<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $query = Newsletter::query();

        // Optional: Simple Search logic
        if ($request->has('search') && $request->search != '') {
            $query->where('email', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%');
        }

        $subscribers = $query->latest()->paginate(10);

        return view('admin.newsletters.index', compact('subscribers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => true,
        ]);

        return response()->json(['success' => true, 'message' => 'Subscriber added successfully!']);
    }

    public function toggleStatus(Request $request)
    {
        $newsletter = Newsletter::findOrFail($request->id);
        $newsletter->is_active = !$newsletter->is_active;
        $newsletter->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated to ' . ($newsletter->is_active ? 'Active' : 'Inactive')
        ]);
    }

    public function destroy($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();

        return response()->json(['success' => true, 'message' => 'Subscriber deleted successfully!']);
    }
}
