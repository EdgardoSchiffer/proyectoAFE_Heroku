<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::OrderBy('id', 'ASC')->paginate(10);
        return [
            
            'pagination' => [
                'total' => $departments->total(),
                'current_page' => $departments->currentPage(),
                'per_page' => $departments->perPage(),
                'last_page' => $departments->lastPage(),
                'from' => $departments->firstItem(),
                'to' => $departments->lastPage(),
            ],
            'departments' => $departments
        ];
    }

    public function listar()
    {
        
        return Department::orderBy('id', 'ASC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newDepartment = new Department();
        $newDepartment->department_name = $request->department["department_name"];
        $newDepartment->save();
        return $newDepartment;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department, $id)
    {
        $department = Department::find($id);
        if($department){
        $department->department_name = $request->department["department_name"];
        $department->save();
        return $department;
        }
        return "Departamento no encontrado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department, $id)
    {
        $department = Department::find($id);
        if($department){
            $department->delete();
            return "Departamento eliminado";
        }
        return "Departamento no encontrado";
    }
}
