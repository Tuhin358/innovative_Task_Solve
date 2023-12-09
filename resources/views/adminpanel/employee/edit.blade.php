@extends('layouts.adminpanel.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Employee/ <a href="">Update</a></h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-md-12 col-lg-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Add New Employee</h5>
                        <a href="{{route('employee.index') }}" class="text-white bg-primary btn btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('employee.update',$employee->id)}}" method="post" enctype="multipart/form-data">
                          
                            @csrf
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="first_name">first_name<span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                      placeholder="first_name" value="{{ $employee->first_name }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="last_name">last_name<span class="text-danger">*</span></label>

                                    <input type="text"
                                        class="form-control" name="last_name" id="last_name" placeholder="last_name" value="{{ $employee->last_name }}">

                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="email">email<span class="text-danger">*</span></label>

                                    <input type="email"
                                        class="form-control" name="email" id="email" placeholder="email" value="{{ $employee->email }} ">

                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone">phone<span class="text-danger">*</span></label>

                                    <input type="text"
                                        class="form-control" name="phone" id="phone" placeholder="phone" value="{{ $employee->phone }} ">

                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="hire_date">hire_date<span class="text-danger">*</span></label>

                                    <input type="text"
                                        class="form-control" name="hire_date" id="hire_date" placeholder="hire_date" value="{{ $employee->hire_date }}">

                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="designation">designation<span class="text-danger">*</span></label>

                                    <input type="text"
                                        class="form-control" name="designation" id="designation" placeholder="designation" value="{{ $employee->designation }}">

                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="address">address<span class="text-danger">*</span></label>

                                    <input type="text"
                                        class="form-control" name="address" id="address" placeholder="address" value="{{ $employee->address }}">

                                </div>


                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="image">image<span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="form-control" id="image" placeholder="image...." />
                                    <img src="#" style="display:none;" id="image"  height="100px" width="200px" />

                                </div>



                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection


