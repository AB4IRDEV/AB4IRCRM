<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Models\Locations;
use App\Models\Province;
use App\Models\Stakeholder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stakeholders=Stakeholder::get();
        $locations=Province::get();
        $programs= Project::get();
        $users=User::get();
        return view('projects.projects.index', ['stakeholders'=>$stakeholders,'programs'=>$programs, 'users'=>$users, 'locations'=>$locations]);
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
    public function store(StoreProjectRequest $request)
    {
        
        $Project = Project::create($request->validated() + [
            'created_by' => Auth::id(),
            'updated_by' => Auth::id()
        ]);
    
        // Attach provinces if any
        if ($request->has('stakeholder_id')) {
            $Project->stakeholders()->attach($request->stakeholder_id);
        }
        
        return redirect()->route('projects.index')->with('success', 'Project created successfully!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $Project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $Project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramRequest $request, Project $Project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $Project)
    {
        $Project->delete();

        return redirect('projects')->with('status ', 'Project deleted successfully');
    }
}
