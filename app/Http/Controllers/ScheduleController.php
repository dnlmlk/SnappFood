<?php

namespace App\Http\Controllers;

use App\Http\Requests\updateScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant = \App\Models\Restaurant::where('user_id', auth()->user()->id)->first();
        $schedule = Schedule::where('restaurant_id', $restaurant->id)->first();
        return view('schedule', ['schedule' => $schedule]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurant = \App\Models\Restaurant::where('user_id', auth()->user()->id)->first();
        $schedule = Schedule::where('restaurant_id', $restaurant->id)->first();
        return view('editSchedule', ['schedule' => $schedule]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(updateScheduleRequest $request)
    {
        $validated = $request->validated();

        $restaurant = \App\Models\Restaurant::where('user_id', auth()->user()->id)->first();
        $schedule = Schedule::where('restaurant_id', $restaurant->id)->first();

        $validated['saturday'] = $validated['saturday1'] . ',' . $validated['saturday2'];
        $validated['sunday'] = $validated['sunday1'] . ',' . $validated['sunday2'];
        $validated['monday'] = $validated['monday1'] . ',' . $validated['monday2'];
        $validated['tuesday'] = $validated['tuesday1'] . ',' . $validated['tuesday2'];
        $validated['wednesday'] = $validated['wednesday1'] . ',' . $validated['wednesday2'];
        $validated['thursday'] = $validated['thursday1'] . ',' . $validated['thursday2'];
        $validated['friday'] = $validated['friday1'] . ',' . $validated['friday2'];

        $schedule->update($validated);
        return redirect()->route('dashboard');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateScheduleRequest $request)
    {
        $validated = $request->validated();

        $restaurant = \App\Models\Restaurant::where('user_id', auth()->user()->id)->first();
        $schedule = Schedule::where('restaurant_id', $restaurant->id)->first();

        $validated['saturday'] = $validated['saturday1'] . ',' . $validated['saturday2'];
        $validated['sunday'] = $validated['sunday1'] . ',' . $validated['sunday2'];
        $validated['monday'] = $validated['monday1'] . ',' . $validated['monday2'];
        $validated['tuesday'] = $validated['tuesday1'] . ',' . $validated['tuesday2'];
        $validated['wednesday'] = $validated['wednesday1'] . ',' . $validated['wednesday2'];
        $validated['thursday'] = $validated['thursday1'] . ',' . $validated['thursday2'];
        $validated['friday'] = $validated['friday1'] . ',' . $validated['friday2'];

        $schedule->update($validated);
        return redirect()->route('Schedule.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
