<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lot;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lots=Lot::paginate(8);

        return view ('admin.lot_index', compact('lots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lot = new Lot;
        return view ('admin.lot_form', compact('lot'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|max:15',
            'size' => 'required|integer',
            'capacity'=> 'required|string|max:15',
            'facilities'=> 'required|array',
            'price' => 'required|integer',
            // 'photo'=> 'required|mimes:jpeg,jpg,png|max:10000', //10mb MAX
            'hex'=> 'required|in:008000,ff0000',
            'status'=> 'required|in:1,0',
            ]);

            $lot = new Lot();
            $lot->fill($request->all());
            $lot->facilities = $request['facilities'] ? json_encode($request['facilities']) : json_encode([]);
            $price =  $request->input('price');
            $lot->price = $price;

            $lot->save();
            
            // save photo, attachments like pdf excel
            if($request['photo']){
                $directory =  $_SERVER['DOCUMENT_ROOT']."/uploads/lots";
                if(!file_exists($directory)){
                    mkdir($directory, 0755, true);
                }
                $filename = "lot_".$lot->id."_".time().".".$request->photo->getClientOriginalExtension(); //RENAME TO NEW FILE
                $file = $request->file('photo');
                $file->move($directory, $filename);

                $lot->photo= $filename;
                $lot->save();

            }
            return redirect()->route('app.admin.lot.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lot $lot)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lot $lot)
    {
        return view ('admin.lot_form', compact('lot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lot $lot)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|max:15',
            'size' => 'required|integer',
            'capacity'=> 'required|string|max:15',
            'facilities'=> 'nullable|array',
            'photo'=> 'nullable|mimes:jpeg,jpg,png|max:10000', //10mb MAX
            'coordinates' => 'required|string',
            'hex' => 'required|string',
            'status'=> 'required|in:1,0',
            ]);

            $lot->fill($request->all());
            $lot->facilities = $request['facilities'] ? json_encode($request['facilities']) : json_encode([]);
            $price =  $request->input('price');
            $lot->price = $price;

            $lot->save();
            
            // save photo, attachments like pdf excel
            if($request['photo']){
                $directory =  $_SERVER['DOCUMENT_ROOT']."/uploads/lots";
                if(!file_exists($directory)){
                    mkdir($directory, 0755, true);
                }
                $filename = "lot_".$lot->id."_".time().".".$request->photo->getClientOriginalExtension(); //RENAME TO NEW FILE
                $file = $request->file('photo');
                $file->move($directory, $filename);

                $lot->photo= $filename;
                $lot->save();

            }
            return redirect()->route('app.admin.lot.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lot $lot)
    {
        //
        $lot->delete();
        return redirect()->route('app.admin.lot.index');
    }
}
