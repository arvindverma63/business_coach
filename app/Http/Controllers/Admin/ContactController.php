<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * FRONTEND: Show the Contact Page
     */
    public function index()
    {
        // Get the first row of settings or provide an empty object to avoid errors
        $settings = ContactSetting::first() ?? new ContactSetting();
        return view('webapp.contact', compact('settings'));
    }

    /**
     * FRONTEND: Save User Inquiry (AJAX)
     */
    public function storeInquiry(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'message'    => 'required|string',
        ]);

        ContactInquiry::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your message has been received.'
        ]);
    }

    /**
     * ADMIN: Show Settings & List of Inquiries
     */
    public function adminIndex()
    {
        $settings = ContactSetting::first() ?? new ContactSetting();
        $inquiries = ContactInquiry::latest()->paginate(10);

        return view('admin.contact.index', compact('settings', 'inquiries'));
    }

    /**
     * ADMIN: Update Contact Details
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^[0-9]+$/'],
            'address' => 'required'
        ]);

        $settings = ContactSetting::first() ?: new ContactSetting();
        $settings->fill($request->all());
        $settings->save();

        return response()->json([
            'success' => true,
            'message' => 'Contact details updated successfully!'
        ]);
    }

    /**
     * ADMIN: Delete an Inquiry
     */
    public function destroyInquiry($id)
    {
        ContactInquiry::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Inquiry deleted.']);
    }
}
