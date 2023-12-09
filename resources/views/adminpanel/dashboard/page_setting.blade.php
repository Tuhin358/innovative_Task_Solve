@extends('layouts.adminpanel.master')

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Page Setting</h1>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                @php
                    Alert::toast($error,'error')
                @endphp
            @endforeach
        @endif
        <div class="text-end">
            <a href="{{ route('create.product') }}" class="btn btn-success">
                Add New pageSetting
            </a>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
               Product table
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Thumbnail</th>
                        <th>Category</th>
                        <th>Featured Product</th>
                        <th>Product Sheet</th>
                        <th>Customize</th>
                        <th>Download 3D </th>
                        <th>Assembly Scheme</th>
                        <th>Total Sell</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php
                    $i= 1;
                    @endphp

                    <tr>
                        <td>/td>


                        <td>
                            <a href=""> <i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>

                            {{--  $product->id  --}}
                        </td>




                        <td>
                            <a href="" class="btn-secondary btn">Edit</a>
                            <a href="" type="button" class="btn-danger btn onconfirmDelete" >Delete</a>
                        </td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>


@endsection
