<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/users/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //      
        $user = new User();

        return view('admin/users/create',[
            'user_types' => $user->userTypes()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'type' => 'required',
            'password' => 'required|min:6|max:30|confirmed',
        ]);

        $user = new User();
        $user->name = $request->get('name'); 
        $user->email = $request->get('email'); 
        $user->type = $request->get('type'); 
        $user->password = Hash::make($request->get('password')); 
        $user->image = 'default_user.png';
        $user->save();

        return redirect('/users/'.$user->id.'/edit')->with('global_success', 'New user added, Update image!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('admin/users/edit',[
            'user' => $user,
            'user_types' => $user->userTypes()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $upload_profile_image = $request->upload_profile_image;

        if($upload_profile_image == 'Upload'){

            request()->validate([
                'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:512',
            ]);

            $profile_image = $request->file('profile_image');
            $destination_path = 'uploads';
            $file_name = time().'_'.$profile_image->getClientOriginalName();
            $profile_image->move($destination_path,$file_name);

            $user->image = $file_name;
            $user->update();

            return redirect('/users/'.$user->id.'/edit')->with('global_success', 'Image Uploaded!');
        }


        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'type' => 'required'
        ]);

        $user->name = $request->get('name'); 
        $user->email = $request->get('email'); 
        $user->type = $request->get('type'); 
        $user->save();

        return redirect('/users/'.$user->id.'/edit')->with('global_success', 'User Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function gridData()
    {
        return Datatables::of(User::query())->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function changePassword($id)
    {
        
        $user = User::find($id);

        return view('admin/users/change-password',[
            'user' => $user,
            'user_types' => $user->userTypes()
        ]);
    }


    /**
     * Update the specified User password.
     *
     * @param  $id , User id     
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword($id,Request $request)
    {

        $user = User::find($id);

        $validatedData = $request->validate([
            'password' => 'required|min:6|max:30|confirmed',
        ]);

        $user->password = Hash::make($validatedData['password']); 
        $user->save();

        return redirect()->back()->with('global_success', 'Password Updated!');
    }


}
