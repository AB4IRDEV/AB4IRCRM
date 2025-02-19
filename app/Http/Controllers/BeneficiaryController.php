<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Http\Requests\StoreBeneficiaryRequest;
use App\Http\Requests\UpdateBeneficiaryRequest;
use App\Models\NextOfKin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; 


class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beneficiaries=Beneficiary::get();
        return view('projects.beneficiaries.index', ['beneficiaries'=>$beneficiaries]);
    }

    public function edit(Beneficiary $beneficiary){

        $nextOfKin = $beneficiary->nextOfKin; // Use the relationship
       
        return view('projects.beneficiaries.edit', ['beneficiary'=>$beneficiary, 'nextOfKin'=>$nextOfKin]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $beneficiaries=Beneficiary::get();
        return view('projects.beneficiaries.create', ['beneficiaries'=>$beneficiaries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBeneficiaryRequest $request)
    {
        // Validate input
        $beneficiaryData = $request->validated();
    
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
    
            // Ensure correct key usage
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
                'location' => $data['location'] ?? null,
                'highest_qualification' => $data['highest_qualification'] ?? null,
                'next_of_kin_id' => $nextOfKin->id, // Corrected key
                'created_by' => $userId,
                'updated_by' => $userId,
            ]);
    
            if (!$beneficiary) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Failed to save Beneficiary.']);
            }
    
            // Commit transaction
            DB::commit();
    
            // Clear session
            Session::forget('beneficiary_data');
    
            return redirect()->route('projects.beneficiaries.index')->with('success', 'Beneficiary and Next of Kin saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

   

    public function update(Request $request, Beneficiary $beneficiary)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'dob' => 'required|date',
            'id_number' => 'required|string|max:20|unique:beneficiaries,id_number,' . $beneficiary->id,
            'age' => 'required|integer',
            'gender' => 'required|string',
            'location' => 'required|string|max:255',
            'highest_qualification' => 'nullable|string|max:255',
       
    
            // Next of Kin Fields
            'next_of_kin_name' => 'required|string|max:255',
            'next_of_kin_last_name' => 'required|string|max:255',
            'relationship' => 'required|in:Parent,Sibling,Spouse,Guardian,Relative,Friend,Other',
            'next_of_kin_phone' => 'required|string|max:15',
            'next_of_kin_email' => 'nullable|email|max:255'
        ]);
    
        // Update Beneficiary Data
        $beneficiary->update($request->only([
            'name', 'surname', 'phone', 'email', 'dob', 'id_number', 
            'age', 'gender', 'location', 'highest_qualification'
            ]) + [
                'updated_by' => Auth::id() // Store the currently logged-in user
            ]);
    
        // Check if Next of Kin exists for this Beneficiary
        if ($beneficiary->nextOfKin) {
            // Update existing Next of Kin record
            $beneficiary->nextOfKin->update([
                'first_name' => $request->next_of_kin_name,
                'last_name' => $request->next_of_kin_last_name, 
                'phone' => $request->next_of_kin_phone,
                'email' => $request->next_of_kin_email,
                'relationship' => $request->relationship, 
            ]);
        } else {
            // Create new Next of Kin record if not found
            $beneficiary->nextOfKin()->create([
                'first_name' => $request->next_of_kin_name,
                'last_name' => $request->next_of_kin_last_name, 
                'phone' => $request->next_of_kin_phone,
                'email' => $request->next_of_kin_email,
                'relationship' => $request->relationship, 
            ]);
        }
    
        return redirect('beneficiaries')->with('status', 'Beneficiary and Next of Kin updated successfully.');
    }


    public function show(Beneficiary $beneficiary){

        $nextOfKin = $beneficiary->nextOfKin;
        $createuser = $beneficiary->creator; // Use the relationship
        $updateuser = $beneficiary->updater; // Use the relationship
        return view('projects.beneficiaries.show',['beneficiary'=> $beneficiary,'nextOfKin'=>$nextOfKin, 'createuser'=>$createuser,'updateuser'=>$updateuser]);
    }
    
    
    public function destroy(Beneficiary $beneficiary)
    {
        // Check if the beneficiary has a Next of Kin and delete it
        if ($beneficiary->nextOfKin) {
            $beneficiary->nextOfKin->delete();
        }
    
        // Delete the beneficiary
        $beneficiary->delete();
    
        return redirect('beneficiaries')->with('status', 'Beneficiary and Next of Kin deleted successfully');
    }
    


    
}