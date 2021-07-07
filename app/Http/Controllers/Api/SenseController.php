<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sense;
use Illuminate\Http\Request;
use DateTime;
use Alert;

class SenseController extends Controller
{

    public function index()
    {
        return Sense::all();
    }

    public function chart(Request $request, Sense $sense, $id)
    {   
        if($request->initialDate > $request->finalDate){
            //Alert::message('this is a test message', 'info');
            return 0;
        }
        else{
            $rawdata = Sense::select('val', 'date')
            ->where('date', '>=', $request->initialDate)
            ->where('date', '<=', $request->finalDate)
            ->get();
            return view('charts.filter', compact('rawdata'));       
        } 
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return view('historicChart');
        return Sense::create($data);
               
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Sense $sense)
    {
        $rawdata = Sense::select('val', 'date')->get();
        return view('charts.historicChart',compact('rawdata'));
    }

    public function event(Sense $sense,$id)
    {
        $rawdata = Sense::select('val', 'date')
        ->where('event','=',1)
        ->get();
        return view('charts.eventChart',compact('rawdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sense $sense)
    {
        $data = $request->all();
         
        $sense->fill($data);
        $sense->save($data);

        return $sense;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sense $sense)
    {
        $sense->delete();
        
        return $sense;
    }
}
