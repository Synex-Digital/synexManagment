<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Validator;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ServiceCategory::latest()->paginate(2);
        return view('dashboard.service_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.service_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'name' => 'required|unique:service_categories',
            'title'=>'required',
            'slug' => 'required|unique:service_categories',
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

        ServiceCategory::create($request->all());
        flash()->options([ 'position' => 'bottom-right', ])->success('Category Created successfully');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceCategory $serviceCategory)
    {
        return view('dashboard.service_category.show', compact('serviceCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceCategory $serviceCategory)
    {
        return view('dashboard.service_project.category_edit', compact('serviceCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:service_categories',
           'slug' => 'required|unique:service_categories',
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

        $serviceCategory->update($request->all());
        flash()->options([ 'position' => 'bottom-right', ])->success('Category Updated successfully');
        return redirect()->route('service-projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();
        flash()->options([ 'position' => 'bottom-right', ])->success('Category Deleted successfully');
        return  back();
    }
    public function toggleStatus($id)
    {
        $category = ServiceCategory::findOrFail($id);
        $category->is_active = !$category->is_active;
        $category->save();

        return response()->json(['status' => $category->is_active ? 'active' : 'inactive']);
    }

}
