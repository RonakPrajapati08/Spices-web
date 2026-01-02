<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiriesModel;
use App\Models\ContactPageModel;
use Illuminate\Http\Request;

class ContactInquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // ONLY email subscription (footer)
        if ($request->has('email') && !$request->has('name')) {
            $request->validate([
                'email' => 'required|email|max:150',
            ]);

            ContactInquiriesModel::create([
                'email' => $request->email,
                'name'  => 'newsletter', // optional
            ]);

            return back()->with('success', 'Subscribed successfully!');
        }

        $request->validate([
            'name'    => 'required|string|max:150',
            'email'   => 'required|email|max:150',
            'phone'   => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        ContactInquiriesModel::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Your message has been sent successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
