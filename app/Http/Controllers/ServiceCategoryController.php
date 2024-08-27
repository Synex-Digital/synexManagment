<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;

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
        $request->validate([
            'name' => 'required|unique:service_categories',
            'title'=>'required',
            'slug' => 'required|unique:service_categories',
        ]);

        ServiceCategory::create($request->all());
        return back()->with('success', 'Service Category created successfully.');
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
        return view('dashboard.service_category.edit', compact('serviceCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $request->validate([
            'name' => 'required|unique:service_categories,name,' . $serviceCategory->id,
            'slug' => 'required|unique:service_categories,slug,' . $serviceCategory->id,
        ]);

        $serviceCategory->update($request->all());
        return redirect()->route('service-categories.index')->with('success', 'Service Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();
        return redirect()->route('dashborad.service_category.index')->with('success', 'Service Category deleted successfully.');
    }
    public function toggleStatus($id)
    {
        $category = ServiceCategory::findOrFail($id);
        $category->is_active = !$category->is_active;
        $category->save();

        return response()->json(['status' => $category->is_active ? 'Yes' : 'No']);
    }

}
