<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Http\Requests\StoreBeneficiaryRequest;
use App\Http\Requests\UpdateBeneficiaryRequest;
use App\Models\Locations;
use App\Models\NextOfKin;
use App\Models\Program;
use App\Models\Project;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $beneficiaries = Beneficiary::with(['projects', 'province'])->get();
       
        return view('projects.beneficiaries.index', ['beneficiaries'=>$beneficiaries]);
    }

    public function edit(Beneficiary $beneficiary){
        $createuser = $beneficiary->creator; // Use the relationship
        $updateuser = $beneficiary->updater; // Use the relationship
        $projects=Project::get();
        $locations=Locations::get();
        $nextOfKin = $beneficiary->nextOfKin; // Use the relationship
       
        return view('projects.beneficiaries.edit', 
        [ 'beneficiary'=>$beneficiary, 
                'nextOfKin'=>$nextOfKin, 
                'createuser'=>$createuser, 
                'updateuser'=>$updateuser, 
                'projects' => $projects , 
                'locations' => $locations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects=Project::get();
        $locations=Locations::get();
        
        return view('projects.beneficiaries.create', [ 'projects' => $projects , 'locations' => $locations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBeneficiaryRequest $request)
    {
        // Validate input
        $beneficiaryData = $request->validated();
        
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->name . '.' . time() . '.' . $extension; // Correct concatenation
            $path = 'uploads/beneficiary_photos/';
    
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0777, true);
            }
    
            $file->move(public_path($path), $filename);
            $beneficiaryData['photo'] = $path . $filename;  // Storing path in session
        }
        
        // Store data in session
        Session::put('beneficiary_data', $beneficiaryData);
        
        return redirect()->back()->with('status', 'Beneficiary saved successfully.');
    }
    
    
    

    public function finalize()
    {
        $data = Session::get('beneficiary_data');
        $userId = Auth::id();
   
        if (!$data) {
            return redirect()->back()->withErrors(['error' => 'No data found in session']);
        }
    
        // Begin transaction
        DB::beginTransaction();
    
        try {
            // Save Next of Kin first
            $nextOfKin = NextOfKin::create([
                'first_name' => $data['next_of_kin_name'] ?? null,
                'last_name' => $data['next_of_kin_last_name'] ?? null,
                'relationship' => $data['relationship'] ?? null,
                'phone' => $data['next_of_kin_phone'] ?? null,
                'email' => $data['next_of_kin_email'] ?? null,
            ]);
    
            if (!$nextOfKin) {
                throw new \Exception('Failed to save Next of Kin.');
            }
    
            $data['next_of_kin_id'] = $nextOfKin->id;
          
            // Save Beneficiary and link Next of Kin
            $beneficiary = Beneficiary::create([
                'name' => $data['name'] ?? null,
                'surname' => $data['surname'] ?? null,
                'phone' => $data['phone'] ?? null,
                'email' => $data['email'] ?? null,
                'dob' => $data['dob'] ?? null,
                'id_number' => $data['id_number'] ?? null,
                'age' => $data['age'] ?? null,
                'gender' => $data['gender'] ?? null,
                'location_id' => $data['location_id'] ?? null,
                'highest_qualification' => $data['highest_qualification'] ?? null,
                'photo' => $data['photo'] ?? null, 
                'next_of_kin_id' => $nextOfKin->id,
                'created_by' => $userId,
                'updated_by' => $userId,
            ]);

    
            if (!$beneficiary) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Failed to save Beneficiary.']);
            }

            if (isset($data['project_id']) && isset($data['location_id'])) {
                $beneficiary->projects()->attach($data['project_id'], [
                    'location_id' => $data['location_id'],
                    'enrolment_date' => now(),
                ]);
            }
   
            
    
            DB::commit();
            Session::forget('beneficiary_data');
    
            return redirect()->route('projects.beneficiaries.index')->with('success', 'Beneficiary and Next of Kin saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
    

   

    public function update(Request $request, Beneficiary $beneficiary)
    {
        // Validate the input. Note that next-of-kin fields are included in the validation,
        // but they are not part of the beneficiaries table.
        $validatedData = $request->validate([
            'name'                      => 'required|string|max:255',
            'surname'                   => 'required|string|max:255',
            'phone'                     => 'nullable|string|max:20',
            'email'                     => 'nullable|email|max:255',
            'dob'                       => 'required|date',
            'id_number'                 => 'required|string|max:20|unique:beneficiaries,id_number,' . $beneficiary->id,
            'age'                       => 'required|integer',
            'gender'                    => 'required|string',
            'highest_qualification'     => 'nullable|string|max:255',
            'photo'                     => 'nullable|mimes:jpg,png,jpeg',
            'location_id'               => 'required',
            'project_id'                => 'required',

            
            // Next of Kin Fields (not part of the beneficiaries table)
            'next_of_kin_name'          => 'required|string|max:255',
            'next_of_kin_last_name'     => 'required|string|max:255',
            'relationship'              => 'required|in:Parent,Sibling,Spouse,Guardian,Relative,Friend,Other',
            'next_of_kin_phone'         => 'required|string|max:15',
            'next_of_kin_email'         => 'nullable|email|max:255',
        ]);
    
        // Extract Next of Kin data and remove them from the beneficiary data array
        $nextOfKinData = [
            'first_name'  => $validatedData['next_of_kin_name'],
            'last_name'   => $validatedData['next_of_kin_last_name'],
            'phone'       => $validatedData['next_of_kin_phone'],
            'email'       => $validatedData['next_of_kin_email'],
            'relationship'=> $validatedData['relationship'],
        ];
    
        // Remove Next of Kin fields from validatedData as they don't belong to beneficiaries
        unset(
            $validatedData['next_of_kin_name'],
            $validatedData['next_of_kin_last_name'],
            $validatedData['relationship'],
            $validatedData['next_of_kin_phone'],
            $validatedData['next_of_kin_email']
        );
    
        // Handle file upload if a new photo is provided
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->name . '_' . time() . '.' . $extension;
            $path = 'uploads/beneficiary_photos/';
    
            // Ensure directory exists
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0777, true);
            }
    
            // Move the new file
            $file->move(public_path($path), $filename);
    
            // Delete the old photo if it exists
            if ($beneficiary->photo && file_exists(public_path($beneficiary->photo))) {
                unlink(public_path($beneficiary->photo));
            }
    
            // Set the new photo path in the beneficiary data
            $validatedData['photo'] = $path . $filename;
        }

       

        if (isset($validatedData['project_id']) && isset($validatedData['province_id'])) {
            $beneficiary->projects()->attach($validatedData['project_id'], [
                'location_id' => $validatedData['location_id'], 
                'enrollment_date' => now(), // Set enrollment date to current time
            ]);

        }
    

        // Set the updated_by field
        $validatedData['updated_by'] = Auth::id();
    
        // Update the beneficiary record with its own fields only
        $beneficiary->update($validatedData);
    
        // Update or create the Next of Kin record associated with this beneficiary
        if ($beneficiary->nextOfKin) {
            $beneficiary->nextOfKin->update($nextOfKinData);
        } else {
            $beneficiary->nextOfKin()->create($nextOfKinData);
        }
    
        return redirect('beneficiaries')->with('status', 'Beneficiary and Next of Kin updated successfully.');
    }
    
    


    public function show(Beneficiary $beneficiary){
        $beneficiary->with(['projects'])->get();
        $nextOfKin = $beneficiary->nextOfKin;
        $createuser = $beneficiary->creator; // Use the relationship
        $updateuser = $beneficiary->updater; // Use the relationship
        return view('projects.beneficiaries.show',['beneficiary'=> $beneficiary,'nextOfKin'=>$nextOfKin, 'createuser'=>$createuser,'updateuser'=>$updateuser]);
    }
    
    
    public function destroy(Beneficiary $beneficiary) 
    {
        // Delete the beneficiary's photo if it exists
        if ($beneficiary->photo && File::exists(public_path($beneficiary->photo))) {
            File::delete(public_path($beneficiary->photo));
        }
        
        // Check if the beneficiary has a Next of Kin and delete it
        if ($beneficiary->nextOfKin) {
            $beneficiary->nextOfKin->delete();
        }
        
        // Delete the beneficiary record
        $beneficiary->delete();
        
        return redirect('beneficiaries')->with('status', 'Beneficiary and Next of Kin deleted successfully');
    }
    


    
}