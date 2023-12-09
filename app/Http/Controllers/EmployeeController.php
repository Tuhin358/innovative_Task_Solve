<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::latest()->get();
        return view('adminpanel.employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminpanel.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'phone'=>'required',
       ]);

       try {
        DB::beginTransaction();
        $employee = new Employee();
        $destination = public_path('images/employee_imaes/');
        if (! File::exists($destination)) {
            File::makeDirectory($destination, 0755, true, true);
        }
         if ($request->image!= null){
             $image = $request->file('image');
             $imageName = rand(111111,999999).'.webp';;
             $image->move($destination, $imageName);
             $employee->image = 'images/employee_imaes/'.$imageName;
         }

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->hire_date = $request->hire_date;
        $employee->designation = $request->designation;
        $employee->address = $request->address;

        $employee->save();


        DB::commit();
        // Alert::success('New Product Added Succeesfully!.');

        return back();

    } catch (\Exception $e) {
        DB::rollback();
        return $e->getMessage();
}



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
        $employee=Employee::find($id);
        return view('adminpanel.employee.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name'=>'required',
            'phone'=>'required',
       ]);

       try {
        DB::beginTransaction();
        $employee = Employee::find($id);
        $destination = public_path('images/employee_imaes/');
        if (! File::exists($destination)) {
            File::makeDirectory($destination, 0755, true, true);
        }
         if ($request->image!= null){
             $image = $request->file('image');
             $imageName = rand(111111,999999).'.webp';;
             $image->move($destination, $imageName);
             $employee->image = 'images/employee_imaes/'.$imageName;
         }
        

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->hire_date = $request->hire_date;
        $employee->designation = $request->designation;
        $employee->address = $request->address;
        $employee->save();

        DB::commit();
        // Alert::success('New Product Added Succeesfully!.');

        return back();

    } catch (\Exception $e) {
        DB::rollback();
        return $e->getMessage();
}

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Employee::find($id);
        if ($product->image != null )
        {
            unlink(public_path($product->image));
        }
        $product->delete();
        // Alert::success("Product Deleted Successfully!.");
        return redirect()->back();
    }
}
