<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Programs;
use App\Models\Project;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Models\Beneficiary;
use App\Models\Locations;

use App\Models\ProjectTemplate;
use App\Models\Stakeholder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stakeholders=Stakeholder::get();
        $locations=Locations::get();
        $programs= Programs::all();
        $projectTemplates = ProjectTemplate::get();
        $projects=Project::with(['programs','provinces', 'stakeholders'])->get();
        $users=User::get();
        return view('projects.projects.index', 
        [
            'projects'=>$projects,
               'stakeholders'=>$stakeholders,
               'programs'=>$programs, 
               'users'=>$users, 
               'locations'=>$locations,
               'projectTemplates'=>$projectTemplates]);
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

        
        DB::beginTransaction();
        
        try {
            // Create the project
            $Project = Project::create($request->validated() + [
                'created_by' => Auth::id(),
                'updated_by' => Auth::id()
            ]);
    
            // Attach stakeholders (single stakeholder or multiple stakeholders)
            if ($request->has('stakeholder_id')) {
                // Check if it is an array (in case there are multiple stakeholders)
                $stakeholderIds = is_array($request->stakeholder_id) 
                    ? $request->stakeholder_id 
                    : [$request->stakeholder_id];
                $Project->stakeholders()->attach($stakeholderIds);
            }
    
            // Attach program and project template together
            if ($request->has('program_id') && $request->has('project_template_id')) {
                $Project->programs()->attach($request->program_id, [
                    'project_template_id' => $request->project_template_id
                ]);
            }
    
            // Attach locations (since it's an array of location_ids)
            if ($request->has('location_id')) {
                $Project->provinces()->attach($request->location_id);
            }

        
    
            DB::commit();
    
            return redirect()->route('projects.index')->with('status', 'Project created successfully!');
        
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());  // Log for debugging
            return redirect()->back()->with('error', 'An error occurred while creating the project: ' . $e->getMessage());
        }
    }
    
    public function getSharedBeneficiaries($beneficiaryId)
    {
        // Find the projects the beneficiary is enrolled in
        $projectIds = DB::table('project_beneficiary')
            ->where('beneficiary_id', $beneficiaryId)
            ->pluck('project_id');

        // Find beneficiaries who are also enrolled in those projects, excluding the given beneficiary
        $sharedBeneficiaries = Beneficiary::whereHas('projects', function ($query) use ($projectIds) {
            $query->whereIn('project_id', $projectIds);
        })->where('id', '!=', $beneficiaryId)->get();

        return $sharedBeneficiaries;
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // Load related models
        $project->load('beneficiaries', 'stakeholders', 'provinces', 'manager');
    
        return view('projects.projects.show', [
            'project' => $project,
            'managers' => $project->manager,
            'createuser' => $project->creator,
            'updateuser' => $project->updater,
            'beneficiaries' => $project->beneficiaries // Send beneficiaries to the view
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $project->load('stakeholders', 'provinces','manager');
        $createuser = $project->creator; 
        $updateuser = $project->updater; 
        $programs= Programs::get();
        $projectTemplates = ProjectTemplate::get();
        $locations= Locations::get();
        $stakeholders= Stakeholder::get();
        $users=User::get();
        return view('projects.projects.edit',
        [ 'project'=>$project, 
                'createuser'=>$createuser, 
                'updateuser'=>$updateuser,
                'programs'=>$programs,
                'locations'=>$locations,
                'projectTemplates'=>$projectTemplates,
                'stakeholders'=>$stakeholders,
                'users'=>$users,
                'managers'=>$project->manager
              ] );

              return redirect()->route('projects.index')->with('status', ' Project updated successfully!');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        DB::beginTransaction();
    
        try {
            $project->update($request->validated() + [
                'updated_by' => Auth::id(),
            ]);
    
            // Attach stakeholders
            if ($request->has('stakeholder_id')) {
                $project->stakeholders()->sync($request->stakeholder_id);
            }
    
            // Attach program and project template together
            if ($request->has('program_id') && $request->has('project_template_id')) {
                $project->programs()->sync([$request->program_id => [
                    'project_template_id' => $request->project_template_id
                ]]);
            }
    
            // Attach locations
            if ($request->has('location_id')) {
                $project->provinces()->sync($request->location_id);
            }
    
            DB::commit();
    
            return redirect()->route('projects.index')->with('status', 'Project updated successfully!');
        
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
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
