<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles','image')->orderBy('id', 'ASC')->get();
        return view('adminpanel.users.index', compact('users'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('adminpanel.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|string',
            'password' => 'required|string', 
            'file' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',   
            'role' => 'required'       
        ]);

        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();


        // using Morph Relation for image with IMAGE Model
        if ($request->hasFile('file')) {
            
            $location_name = 'images/users/'; //change folder name according to the MODEL

            $file = $request->file('file');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../'.$location_name ) : public_path($location_name );
            $file->move($destinationPath, $name);
            $location = $location_name . $name;

            $image = new Image();
            $image->url = $location;
            $image->type = $file->getClientOriginalExtension();
            $image->parentable_id = $user->id;     //change varibale according to the MODEL
            $image->parentable_type = User::class; //change class name according to the MODEL
            $image->save();
            
        }
        
        $user->assignRole($request->role);
        return back()->with('success', 'You have successfully added user!');       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('image','roles')->find($id);
        return view('adminpanel.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string',
            'file' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',   
        ]);

        
        $user = User::with('images')->find($id);
        $user->name = $request->name;
        $user->email = $request->email;
      

        if(isset($request->password)){
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('file')) {

            $location_name = 'images/users/'; //change folder name according to the MODEL

            $file = $request->file('file');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../'.$location_name) : public_path($location_name);
            $file->move($destinationPath, $name);
            $location = $location_name . $name;
            
            if ($user->image) {
                
                if (file_exists(public_path($user->image->url))) {
                    unlink(public_path($user->image->url));
                }
                
                $user->image->url = $location;
                $user->image->save();
            } else {
                $image = new Image();
                $image->url = $location;
                $image->type = $file->getClientOriginalExtension();
                $image->parentable_id = $user->id;
                $image->parentable_type = User::class;
                $image->save();
            }
        }

        $user->save();

        $user->assignRole($request->role);
        return back()->with('success', 'You have successfully added user!');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::find($id);
        $user->delete();
        return back()->with('success', 'You have successfully deleted user!');
    }
}
