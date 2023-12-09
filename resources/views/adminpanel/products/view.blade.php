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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/ <a href="">View</a></h4>

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
                                             <th class="text-white">Product ID</th>
                                            <th class="text-white">Product Image</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">

                                        {{--  @foreach ($products as $product)
                                        <tr>
                                          @if ($product->images)

                                            <td >
                                                @foreach ($product->images as $image)
                                                    <img src="{{ asset('images/products_images/'.$image->image_path) }}" alt="Product Image"  style="width:60px; height:60px">
                                                @endforeach
                                            </td>
                                          @else
                                            <p>No images available for this product.</p>
                                        @endif
                                    </tr>
                                    @endforeach  --}}

                                              @foreach ($products as $key =>$product)
                                              @php
                                            $product['images']=explode("|",$product->images);
                                             @endphp
                                              <tr>
                                                  <td>{{ $product->product_id }}</td>
                                                <td>
                                                    @foreach ($product->images as $images )
                                                    <img src="{{asset('images/products_images/'.$images)}}" style="width:60px; height:60px">

                                                        {{--  <img src="{{asset($product->images)}} " style="width:60px; height:60px">  --}}
                                                       @endforeach

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


