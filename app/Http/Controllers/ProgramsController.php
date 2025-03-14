<?php

namespace App\Http\Controllers;

use App\Models\Programs;
use App\Http\Requests\StoreProgramsRequest;
use App\Http\Requests\UpdateProgramsRequest;
use App\Models\ProjectTemplate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs=Programs::get();
        return view('projects.programs.index', ['programs'=> $programs]);
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
    public function store(StoreProgramsRequest $request)
    {
        $program= $request->validated();
        Programs::create($program);
        
        return redirect('programs')->with('status', 'Program created successuflly');   
    }

    /**
     * Display the specified resource.
     */
    public function show(Programs $programs, $id)
    {

        // Retrieve the current program
        $program = Programs::findOrFail($id);
        
        // Load all programs for the dropdown (if you allow changing selection)
        $programs = Programs::all();
        
        // Load existing subcategories (project templates) for the current program
        $projectTemplates = ProjectTemplate::where('program_id', $program->id)
                                            ->latest()
                                            ->get();

        return view('projects.programs.show', compact('program', 'programs', 'projectTemplates'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Programs $programs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramsRequest $request, Programs $programs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programs $programs)
    {
        //
    }

    public function storeSubcategory(Request $request){

            // Validate the request data
            $validatedData = $request->validate([
                'program_id'  => 'required|exists:programs,id',
                'title'       => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            // Create and save the new subcategory (project template)
            $subcategory = new ProjectTemplate();
            $subcategory->program_id = $validatedData['program_id'];
            $subcategory->title = $validatedData['title'];
            $subcategory->description = $validatedData['description'] ?? null;
            $subcategory->save();

            // Redirect back with a success message so the user sees the updated list
            return redirect()->back()->with('status', 'Subcategory added successfully!');
    }
}
