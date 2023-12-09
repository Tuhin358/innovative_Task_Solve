@extends('layouts.adminpanel.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/ <a href="">Add</a></h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-md-12 col-lg-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Add New Project</h5>
                        <a href="{{route('products.index') }}" class="text-white bg-primary btn btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('product.update',$product->id)}} " method="post" enctype="multipart/form-data">
                          
                            @csrf
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="product_name">Product Name<span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="product_name" id="product_name"
                                      placeholder="product_name" value="{{ $product->product_name }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="price">price<span class="text-danger">*</span></label>

                                    <input type="text"
                                        class="form-control" name="price" id="price" placeholder="price" value="{{ $product->price }}">
                                        {{--  {{ old('title') }}  --}}
                                </div>


                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="details">Product details<span class="text-danger">*</span></label></label>

                                    <textarea name="details" id="details" class="form-control"
                                         placeholder="Enter Project details"  value=" ">{!! $product->details !!}</textarea>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="thumbnail_image">thumbnail_image<span class="text-danger">*</span></label>
                                    <input accept="image/*" type="file" name="thumbnail_image" class="form-control" id="thumbnail_image" placeholder="thumbnail_image...." />
                                    <img src="#" style="display:none;" id="thumbnail_image"  height="100px" width="200px" />

                                </div>



                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="image_path">product_images<span class="text-danger">*</span></label>
                                    <input type="file" name="image_path[]" class="form-control" multiple required />
                                    <img src="#" style="display:none;" id="image_path"  height="100px" width="200px" />

                                    <div class="upload_image_wrap">
                                        @foreach($product->images as $image)
                                            @php
                                                $path = public_path($image->image_path);
                                                    $source = file_get_contents($path);
                                                    $base64 = base64_encode($source);
                                                    $blob = 'data:image/png;base64,'.$base64;

                                            @endphp
                                        <div class='upload__img-box'>
                                            <div style='background-image: url({{asset($image->image_path)}})'  class='img-bg'>
                                                <input type='hidden' value='{{ $blob }}' name='images[]' >
                                                <div class='upload__img-close'></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>



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


