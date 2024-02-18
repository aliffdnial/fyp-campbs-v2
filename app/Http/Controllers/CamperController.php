<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash; //To Encrypt Password

use App\Models\User;

class CamperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Auth::user();
        $profiles = User::where("id", $profile->id)->get();
        return view('camper.profile_index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(User $profile)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $profile)
    {
        //CHECK STATUS COMPLAINT & OTHER COMPLAINT ID
        if($profile->usertype > 0 && Auth()->user()->id){
            abort(404);
        }else{
            return view ("camper.profile_form", compact('profile'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $profile)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address'=> 'required|string|max:255',
            // 'phonenum'=> 'required|string|unique:users,phonenum',
            // 'email'=> 'required|string|email|unique:users,email',
            'phonenum'=> 'required|string',
            'email'=> 'required|string|email',
            'password'=> 'nullable|string|min:8|confirmed', //OPTIONAL TO CHANGE PASSWORD OR MAINTAIN
            ]);
     
            $profile->fill($request->except('password'));
            if($request['password']){
                $profile->password = Hash::make($request['password']);
            }
            $profile->save();
            return redirect()->route('app.profile.index');
    }

    public function description()
    {
        $data=user::all();
        return view ("camper.description", compact("data"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $profile)
    {
        $profile->delete();
        return redirect()->route('app.profile.index');
    }
}
