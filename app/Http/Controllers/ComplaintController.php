<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $camper = Auth::user();
        $complaints = Complaint::where('user_id', $camper->id)->get();
        return view('camper.complaint_index', compact('complaints'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $complaint = new Complaint();
        return view('camper.complaint_form', compact('complaint'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=> 'required',
            'description'=> 'required|string|max:255',
            'suggestion'=> 'required|string|max:255',
            'photo'=> 'nullable|mimes:jpeg,jpg,png|max:10000', //10mb MAX
        ]);

        $complaint = new Complaint();
        $complaint->fill($request->all());
        $complaint->user_id = $request->user_id ?? auth()->user()->id;
        $complaint->title = $request['title'] ? json_encode($request['title']) : json_encode([]);

        $complaint->save();
        
        // save photo, attachments like pdf excel
        if($request['photo']){
            $directory =  $_SERVER['DOCUMENT_ROOT']."/uploads/complaints";
            if(!file_exists($directory)){
                mkdir($directory, 0755, true);
            }
            $filename = "complaint_".$complaint->id."_".time().".".$request->photo->getClientOriginalExtension(); //RENAME TO NEW FILE
            $file = $request->file('photo');
            $file->move($directory, $filename);

            $complaint->photo= $filename;
            $complaint->save();
        }
        return redirect()->route('app.complaint.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        //CHECK STATUS COMPLAINT & OTHER COMPLAINT ID
        if($complaint->status > 0 && Auth()->user()->id){
            abort(404);
        }
        else{
            return view ('camper.complaint_form', compact('complaint'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Complaint $complaint)
    {
        $this->validate($request, [
            'title'=> 'required',
            'description'=> 'required|string|max:255',
            'suggestion'=> 'required|string|max:255',
            'photo'=> 'nullable|mimes:jpeg,jpg,png|max:10000', //10mb MAX
            ]);

            $complaint->fill($request->all());
            $complaint->title = $request['title'] ? json_encode($request['title']) : json_encode([]);

            $complaint->save();
            
            // save photo, attachments like pdf excel
            if($request['photo']){
                $directory =  $_SERVER['DOCUMENT_ROOT']."/uploads/complaints";
                if(!file_exists($directory)){
                    mkdir($directory, 0755, true);
                }
                $filename = "complaint_".$complaint->id."_".time().".".$request->photo->getClientOriginalExtension(); //RENAME TO NEW FILE
                $file = $request->file('photo');
                $file->move($directory, $filename);

                $complaint->photo= $filename;
                $complaint->save();

            }
            return redirect()->route('app.complaint.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        
        return redirect()->route('app.complaint.index');
    }
}
