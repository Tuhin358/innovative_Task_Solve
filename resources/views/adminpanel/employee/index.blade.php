@extends('layouts.adminpanel.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Employee/ <a href="">List</a></h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-md-12 col-lg-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Project</h5>
                        <a href="{{route('employee.create')}} " class="text-white bg-primary btn btn-sm">Add New
                            Employee</a>

                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="table-responsive text-nowrap">
                                <table class="table" id="dTable">
                                    <thead class="table-dark" id="Dtable">
                                        <tr>
                                            <th class="text-white">SL No</th>
                                            <th class="text-white">first_name</th>
                                            <th class="text-white">last_name</th>
                                            <th class="text-white">email</th>
                                            <th class="text-white">phone</th>
                                            <th class="text-white">hire_date</th>
                                            <th class="text-white">designation</th>
                                            <th class="text-white">address</th>
                                            <th class="text-white">image</th>
                                            <th class="text-white">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                           @foreach ($employees as $key =>$employee)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{$employee->first_name}}</td>
                                                <td>{{$employee->last_name}} </td>
                                                <td>{{$employee->email}} </td>
                                                <td>{{$employee->phone}} </td>
                                                <td>{{$employee->hire_date}} </td>
                                                <td>{{$employee->address}} </td>
                                                <td>{{$employee->first_name}} </td>
                                                <td>
                                                    <img src="{{ asset($employee->image)}}" width="50px" height="50px">

                                                </td>

                                                    <td>
                                                        <a href="{{route('employee.edit',$employee->id) }} " class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                                        
                                                      <a href="{{route('employee.destroy',$employee->id) }}" type="button" class="btn-danger btn onconfirmDelete"onclick="return confirm('Are you sure?')" ><i class="fa fa-trash"></i></a>

                                                </td>
                                            </tr>
                                           @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
 @endsection


