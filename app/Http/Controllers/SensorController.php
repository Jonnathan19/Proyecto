<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $sensors = Sensor::all();
        return view('crud.crudSensor')->with('sensors',$sensors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.crudCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $sensors = new Sensor();

        $sensors->name = $request->get('name');
        $sensors->location = $request->get('location');
        $sensors->description = $request->get('description');

        $sensors->save();
        
        return redirect('/sensors');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function show(Sensor $sensor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sensor = Sensor::find($id);
        
        return view('crud.crudEdit')->with('sensor',$sensor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sensors = Sensor::find($id);

        $sensors->name = $request->get('name');
        $sensors->location = $request->get('location');
        $sensors->description = $request->get('description');

        $sensors->save();
        
        return redirect('/sensors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sensor::find($id)->delete();
      
        return redirect('/sensors');
    }
}
