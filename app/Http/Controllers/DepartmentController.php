<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::aLL();
        $designations = Designation::all();

            if(Auth::user()->can('department.view')){
            return view('dashboard.department.index',['departments' => $departments,'designations' => $designations,]);
            }else{return redirect(route('dashboard')) ;}


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
    public function store(Request $request)
    {

        try {
            // Validate the request
            $request->validate([
                'department' =>'required',
            ]);
            Department::create($request->all());
            flash()->options([
                'position' => 'bottom-right',
            ])->success('Department Added successfully!');
        } catch (ValidationException $e) {
            flash()->options([
                'position' => 'bottom-right',
            ])->error('Department Name Required!');
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data = Department::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Validate the request
            $request->validate([
                'department' =>'required',
            ]);
            Department::find($id)->update([
                'department' => $request->department,
            ]);
            flash()->options([
                'position' => 'bottom-right',
            ])->success('Department Updated successfully!');
        } catch (ValidationException $e) {
            flash()->options([
                'position' => 'bottom-right',
            ])->error('Department Name Required!');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Department::find($id)->delete();
        flash()->options([
            'position' => 'bottom-right',
        ])->success('Deparment Deleted!');
        return back();
    }
}
