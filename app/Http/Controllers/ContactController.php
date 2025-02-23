<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Stakeholder;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
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
    public function store(StoreContactRequest $request, Stakeholder $stakeholder)
    {
        $contactData=$request->validated();
        
        $contactData['created_by']=Auth::id();
        $contactData['updated_by']=Auth::id();

        Contact::create($contactData);

        return back()->with('status', 'Stakeholder Contact Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
       $contactData=$request->validated();
       $contact->update($contactData);

       return back()->with('status', "Contact {$contact->name} updated successfully.");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('status', "Contact {$contact->name} deleted successfully.");
    }
}
