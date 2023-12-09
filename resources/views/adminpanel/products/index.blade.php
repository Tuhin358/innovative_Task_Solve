@extends('layouts.adminpanel.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- @if (\Session::has('success'))
        <div class="row">
            <div class="col-md-12">
                <div id="notificationAlert" style="display: block;">

                    <div class="alert alert-warning">
                        <span style="color:black;">
                            {!! \Session::get('success') !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endif --}}
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/ <a href="">List</a></h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-md-12 col-lg-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Project</h5>
                        <a href="{{route('products.create')}}" class="text-white bg-primary btn btn-sm">Add New
                            Product</a>
                            {{--  {{route('products.create')}}  --}}
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="table-responsive text-nowrap">
                                <table class="table" id="dTable">
                                    <thead class="table-dark" id="Dtable">
                                        <tr>
                                            <th class="text-white">SL No</th>
                                            <th class="text-white">Name</th>
                                            <th class="text-white">Price</th>
                                            <th class="text-white">Details</th>
                                            <th class="text-white">Thubnail Image</th>
                                            <th class="text-white">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                          @foreach ($products as $key =>$product)
                                            <tr>
                                                <td>{{ $key+1 }} </td>
                                                <td>{{$product->product_name}} </td>
                                                <td>{{$product->price}}</td>
                                                <td>{{$product->details}}</td>
                                                <td>
                                                    <img src="{{ asset($product->thumbnail_image)}}" width="50px" height="50px">
                                                </td>

                                                    <td>
                                                        <a href="{{route('product.edit',$product->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                                        <a href="{{ route('view.product') }} " class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a>

                                                      <a href="{{ route('product.destroy',$product->id) }}" type="button" class="btn-danger btn onconfirmDelete"onclick="return confirm('Are you sure?')" ><i class="fa fa-trash"></i></a>

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


