<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplaintController extends Controller
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

            $complaints = Complaint::whereHas('user', function($q) use ($search) {
                // QUERY USERS TABLE
                $q->where('name', 'LIKE','%'.$search.'%');
            })->paginate(5);
        }elseif(isset($_GET["search1"]) && !empty($_GET["search1"])){
            // INPUT TYPE DATE
            $search1 = isset($_GET['search1']) ? Carbon::createFromFormat('Y-m-d', $_GET['search1'])->toDateString() : null;

            $complaints = Complaint::whereDate('created_at', [$search1])->paginate(5);
        }else{
            $complaints=Complaint::paginate(5);
        }
        return view("admin.complaint_index", compact('complaints', 'search', 'search1'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint)
    {
        if($request['action'] == 'solve'){
            $complaint->status='1';
        }elseif( $request['action'] == 'reject'){
            $complaint->status='2';
        }
        $complaint->save();
        return redirect()->route('app.admin.complaint.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        
        return redirect()->route('app.admin.complaint.index');
    }
}
