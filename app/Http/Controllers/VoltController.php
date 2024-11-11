<?php

namespace App\Http\Controllers;

use App\Models\RollAmount;
use App\Models\Volt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class VoltController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $volts  = Volt::get();
        return view('volt.create', compact('volts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $volt = new Volt();
        $volt->name = $request->volt;
        $volt->value = $request->value;
        $volt->save();
        return Redirect::back()->with('message', 'success|Volt Item Add.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Volt $volt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Volt $volt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Volt $volt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Volt $volt)
    {
        $volt->delete();
        return Redirect::back()->with('message', 'success|Volt Item Deleted.');
    }

    public function roll_input()
    {
        $volts = Volt::get();
        return view('volt.roll_input', compact('volts'));
    }

    public function roll_input_post(Request $request)
    {

        foreach ($request->id as $key => $value) {

            $roll = new RollAmount();
            $roll->volt_id = $value;
            $roll->value = $request->value[$key];;
            $roll->count = $request->count[$key];
            $roll->amount = $request->amount[$key];
            $roll->user_id = Auth::id();
            $roll->date = date('Y-m-d');
            $roll->save();
        }

        return Redirect::route('volt.roll_list')->with('message', 'success|Roll Inputed');
    }

    public function roll_list()
    {
        $volts = RollAmount::select(DB::raw('MAX(id) as id'), 'date', DB::raw('SUM(amount) as amount'))->groupBy('date')->orderBy('id', 'desc')->get();
        return view('volt.roll_list', compact('volts'));
    }

    public function roll_list_edit($id)
    {

        $volts = RollAmount::with('volt')->where('date', $id)->get();
        return view('volt.roll_list_edit', compact('volts'));
    }

    public function roll_input_edit(Request $request)
    {

        foreach ($request->id as $key => $value) {

            $roll = RollAmount::find($value);
            $roll->count = $request->count[$key];
            $roll->amount = $request->amount[$key];
            $roll->user_id = Auth::id();
            $roll->save();
        }

        return Redirect::route('volt.roll_list')->with('message', 'success|Roll Inputed');
    }
}
