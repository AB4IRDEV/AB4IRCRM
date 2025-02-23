<?php

namespace App\Http\Controllers;

use App\Models\Stakeholder;
use App\Http\Requests\StoreStakeholderRequest;
use App\Http\Requests\UpdateStakeholderRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\returnSelf;

class StakeholderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stakeholders=Stakeholder::get();
        $types = ['Funder', 'Associate', 'Implementing_Partner', 'Supplier'];
        return view('projects.stakeholders.index',['stakeholders'=>$stakeholders, 'types'=>$types]);
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
    public function store(StoreStakeholderRequest $request)
    {
        $stakeholder= $request->validated();

        $stakeholder['created_by'] = Auth::id(); 
        $stakeholder['updated_by'] = Auth::id();

        if($request->hasFile('image')){
            $file=$request->file('image');
            $extension =$file->getClientOriginalExtension();
            $filename=$request->organisation.'.'.$extension;
            $path= 'uploads/stakeholders/'; 
            
            // Move file to the storage path
            $file->move($path, $filename);
            
            $stakeholder['logo']= $path. $filename;
        }
        Stakeholder::create($stakeholder);

        return redirect('stakeholders')->with('status', 'Stakeholder created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stakeholder $stakeholder)
    {
        
      
        $contactData = $stakeholder->contacts ?? collect(); // Ensure it's always a collection

        $createuser=$stakeholder->creator;
        $updateuser=$stakeholder->updater;

        return view('projects.stakeholders.show',
        [
                    'stakeholder'=>$stakeholder, 
                    'contactData'=>$contactData, 
                    'createuser'=>$createuser, 
                    'updateuser'=>$updateuser
              ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stakeholder $stakeholder)
    {

        $types = ['Funder', 'Associate', 'Implementing_Partner', 'Supplier'];
        return view('projects.stakeholders.edit',['types'=>$types,'stakeholder'=> $stakeholder]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStakeholderRequest $request, Stakeholder $stakeholder)
    {
        $validatedData = $request->validated();
        $validatedData['updated_by'] = Auth::id();
    
        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Store the old logo path before moving the new file
            $oldLogo = $stakeholder->logo;
    
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            // Use organisation name plus timestamp for uniqueness, if desired
            $filename = $request->organisation . '_' . time() . '.' . $extension;
            $path = 'uploads/stakeholders/';
    
            // Ensure the directory exists
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0777, true);
            }
    
            // Move file to the storage path
            $file->move(public_path($path), $filename);
    
            // Set new logo path in the validated data
            $validatedData['logo'] = $path . $filename;
    
            // Delete the old file if it exists and is different from the new file
            if ($oldLogo && File::exists(public_path($oldLogo))) {
                File::delete(public_path($oldLogo));
            }
        }
    
        // Update the stakeholder record with new data
        $stakeholder->update($validatedData);
    
        return redirect()->route('stakeholders.index')
                         ->with('status', 'Stakeholder updated successfully');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stakeholder $stakeholder)
    {
        $stakeholder->delete();

        return redirect('stakeholders')->with('status', 'stakeholder deleted successfully');
    }
}
