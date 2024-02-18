<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; //To Encrypt Password

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = null;
        $search1 = null;

        if(isset($_GET["search"])){
            $search = $_GET['search'];

            $campers = User::where('name', 'LIKE','%'.$_GET['search'].'%')->paginate(5);
        }elseif(isset($_GET["search1"]) && !empty($_GET["search1"])){
            // INPUT TYPE DATE
            $search1 = isset($_GET['search1']) ? Carbon::createFromFormat('Y-m-d', $_GET['search1'])->toDateString() : null;

            $campers = User::whereDate('created_at', [$search1])->paginate(5);
        }else{
            //list all campers
            $campers=User::paginate(5);
        }
        return view ('admin.camper_index', compact('campers', 'search','search1'));
    }

    /**
     * Delete camper with usertype==0
     */
    public function deleteuser($campid)
    {
        $campers=user::find($campid);
        $campers->delete();
        return redirect()->back();
    }

    public function complaint()
    {
	    $data=user::all();
        return view ("admin.complaints", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $camper=new User;
        return view ("admin.camper_form", compact("camper"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required|string|max:255',
        'address'=> 'required|string|max:255',
        'phonenum'=> 'required|string|unique:users,phonenum',
        'email'=> 'required|string|email|unique:users,email',
        'password'=> 'required|string|min:8|confirmed',
        'usertype'=> 'required|in:0,1',
        ]);

       
        $camper = new User();
        $camper->fill($request->except('password'));
        $camper->password = Hash::make($request['password']);
        $camper->usertype = $request['usertype'];
        $camper->save();
        return redirect()->route('app.admin.camper.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $camper)
    {
        return view ("admin.camper_form", compact('camper'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $camper)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address'=> 'required|string|max:255',
            // 'phonenum'=> 'required|string|unique:users,phonenum',
            // 'email'=> 'required|string|email|unique:users,email',
            'password'=> 'nullable|string|min:8|confirmed', //OPTIONAL TO CHANGE PASSWORD OR MAINTAIN
            'usertype'=> 'required|in:0,1',
            ]);
     
            $camper->fill($request->except('password'));
            if($request['password']){
                $camper->password = Hash::make($request['password']);
            }
            $camper->usertype = $request['usertype'];
            $camper->save();
            return redirect()->route('app.admin.camper.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $camper)
    {
        $camper->delete(); //HARD DELETE
        return redirect()->route('app.admin.camper.index');
    }
}
