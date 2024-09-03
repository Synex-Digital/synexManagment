<?php

namespace App\Http\Controllers;

use App\Helpers\Photo;
use Illuminate\Http\Request;
use App\Models\ServiceProject;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Validator;

class ServiceProjectController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::latest()->paginate(2);
        $projects = ServiceProject::with('serviceCategory')->latest()->paginate(2);
        return view('dashboard.service_project.index', compact('projects', 'categories'));
    }

    public function create()
    {
        $categories = ServiceCategory::all();
        return view('dashboard.service_project.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_name' => 'required|string',
            'title' => 'required|string',
            'short_description' => 'required|string',
            'slug' => 'nullable|unique:service_projects',
            'project_url' => 'nullable|url',
            'service_category_id' => 'required|exists:service_categories,id',
        ]);

       if ($validator->fails()) {
           $errors = $validator->errors();
           foreach ($errors->messages() as  $messages) {
               foreach ($messages as $message) {
                   flash()->options([
                       'position' => 'bottom-right',
                   ])->error($message);
               }
           }
           return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('thumbnail_image')) {
            Photo::upload($request->file('thumbnail_image'), 'uploads/service_project/photo', 'PROJECT', [640, 420]);
        }
        $data = $request->all();
        $data['thumbnail_image'] = Photo::$name;
        ServiceProject::create($data);
        flash()->options([ 'position' => 'bottom-right', ])->success('Project Created successfully');
        return back();
    }

    public function show(ServiceProject $project)
    {
        return view('dashboard.service_project.show', compact('project'));
    }

    public function edit(ServiceProject $project)
    {
        $categories = ServiceCategory::all();
        return view('dashboard.service_project.edit', compact('project', 'categories'));
    }

    public function update(Request $request, ServiceProject $project)
    {
        $request->validate([
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_name' => 'required|string',
            'title' => 'required|string',
            'short_description' => 'required|string',
            'slug' => 'nullable|unique:service_projects,slug,' . $project->id,
            'project_url' => 'nullable|url',
            'service_category_id' => 'required|exists:service_categories,id',
        ]);

        if ($request->hasFile('thumbnail_image')) {
            if ($project->thumbnail_image) {
                Photo::delete($project->thumbnail_image);
            }

            // Upload new file
            Photo::upload($request->file('thumbnail_image'), 'uploads/service_project/photo', 'PROJECT', [640, 420]);
            $filePath = Photo::$name;
        } else {
            $filePath = $project->thumbnail_image;
        }

        // Prepare data for update
        $data = $request->all();
        $data['thumbnail_image'] = $filePath;

        // Update the existing project
        $project->update($data);
        return back()->with('success', 'Project updated successfully.');
    }

    public function destroy(ServiceProject $project)
    {
        if ($project->thumbnail_image) {
            Photo::delete($project->thumbnail_image);
        }
        $project->delete();
        return back()->with('success', 'Project deleted successfully.');
    }
    public function toggleStatus($id)
    {
        $project = ServiceProject::findOrFail($id);
        $project->is_active = !$project->is_active;  // Toggle the status
        $project->save();

        // Return the new status as a JSON response
        return response()->json(['status' => $project->is_active ? 'Yes' : 'No']);
    }
}
