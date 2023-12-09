<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('adminpanel.products.index',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminpanel.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
             'product_name'=>'required',
             'price'=>'required',
             'details'=>'required',
             'thumbnail_image'=>'required|image|mimes:png,jpg,jpeg',
            //  'image_path.*'=>'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        try {
            DB::beginTransaction();
            $product = new Product();
            $destination = public_path('images/products_images/');
            if (! File::exists($destination)) {
                File::makeDirectory($destination, 0755, true, true);
            }
             if ($request->thumbnail_image!= null){
                 $image = $request->file('thumbnail_image');
                 $imageName = rand(111111,999999).'.webp';;
                 $image->move($destination, $imageName);
                 $product->thumbnail_image = 'images/products_images/'.$imageName;
             }

            $product->product_name = $request->product_name;
            $product->price = $request->price;
             $product->details = $request->details;

            $product->save();
            if ($request->image_path != null){

                if (count($request->image_path) > 0 ){

                    foreach ($request->image_path as $key => $data){
                        $name = rand(10000,99999).'.webp';
                        $path = $destination.$name;
                        file_put_contents($path,file_get_contents($data));
                        $image_path2 = 'images/products_images/'.$name;
                        ProductImage::create([
                            'product_id'=>$product->id,
                            'image_path'=>$image_path2,

                        ]);
                    }
                }
            }

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

    public function view()
    {
        $products = ProductImage::get();
        return view('adminpanel.products.view',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('adminpanel.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name'=>'required',
            'price'=>'required',
            'details'=>'required',
            'thumbnail_image'=>'required|image|mimes:png,jpg,jpeg',
           //  'image_path.*'=>'required|image|mimes:png,jpg,jpeg|max:2048',
       ]);

       try {
           DB::beginTransaction();
           $product = Product::find($id);
           $destination = public_path('images/products_images/');
           if (! File::exists($destination)) {
               File::makeDirectory($destination, 0755, true, true);
           }
            if ($request->thumbnail_image!= null){
                $image = $request->file('thumbnail_image');
                $imageName = rand(111111,999999).'.webp';;
                $image->move($destination, $imageName);
                $product->thumbnail_image = 'images/products_images/'.$imageName;
            }
           $product->product_name = $request->product_name;
           $product->price = $request->price;
           $product->details = $request->details;
           $product->save();


           if ($request->image_path != null){
               if (count($request->image_path) > 0 ){
                $productimages = Productimage::where('product_id',$request->product_id)->get();
                    foreach ($productimages as $images){
                        unlink(public_path($images->image_path));
                        Productimage::find($images->id)->delete();
                    }


                   foreach ($request->image_path as $key => $data){
                       $name = rand(10000,99999).'.webp';
                       $path = $destination.$name;
                       file_put_contents($path,file_get_contents($data));
                       $image_path2 = 'images/products_images/'.$name;
                       ProductImage::create([
                           'product_id'=>$product->id,
                           'image_path'=>$image_path2,

                       ]);
                   }
               }
           }

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
        $product = Product::find($id);
        if ($product->thumbnail_image != null )
        {
            unlink(public_path($product->thumbnail_image));
        }
        $product->delete();
        // Alert::success("Product Deleted Successfully!.");
        return redirect()->back();
    }
}
