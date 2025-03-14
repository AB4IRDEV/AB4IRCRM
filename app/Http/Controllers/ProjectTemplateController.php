<?php

namespace App\Http\Controllers;

use App\Models\ProjectTemplate;
use Illuminate\Http\Request;

class ProjectTemplateController extends Controller
{
    public function getProjectTemplates(Request $request)
    {
        $templates = ProjectTemplate::where('program_id', $request->program_id)->get();
        return response()->json($templates);
    }
}
