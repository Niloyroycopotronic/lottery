<?php

namespace App\Http\Controllers;

use App\Models\OtherInput;
use App\Models\Reg;
use App\Models\RegItem;
use App\Models\RegItemSave;
use App\Models\RegOther;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RegController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reg = Reg::get();
        return view('reg.index', compact('reg'));
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
        $reg = new Reg();
        $reg->name = $request->item;
        // $reg->value = $request->value;
        $reg->save();
        return Redirect::back()->with('message', 'success|Reg Add.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reg $reg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reg $reg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reg $reg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reg $reg)
    {
        $reg->delete();
        return Redirect::back()->with('message', 'success|Reg Deleted.');
    }

    public function item_add()
    {
        $reg = RegItem::get();
        return view('reg.item_add', compact('reg'));
    }

    public function item_add_post(Request $request)
    {
        $reg = new RegItem();
        $reg->name = $request->item;
        $reg->value = $request->value;
        $reg->save();
        return Redirect::back()->with('message', 'success|Reg Add.');
    }

    public function item_add_delete($item)
    {
        RegItem::find($item)->delete();
        return Redirect::back()->with('message', 'success|Reg Item Deleted.');
    }

    public function reg_input()
    {
        $reg = Reg::get();
        $item = RegItem::get();
        return view('reg.reg_input', compact('reg', 'item'));
    }
    public function reg_input_post(Request $request)
    {

        foreach ($request->count as $key => $value) {

            foreach ($value as $keyi => $valuei) {

                $data = new RegItemSave();
                $data->reg_item_id = $key;
                $data->reg_id = $keyi;
                $data->amount = $valuei;
                $data->value = $request->value[$key];
                $data->year = date('Y');
                $data->month = date('m');
                $data->date = date('d');
                $data->user_id = Auth::id();
                $data->dates = date('Y-m-d');
                $data->save();
            }
        }

        return Redirect::route('reg.reg_item_list')->with('message', 'success|Reg Amount Inputed.');
    }

    public function reg_item_list()
    {
        $save = RegItemSave::select(DB::raw('MAX(id) as id'), 'dates', DB::raw('SUM(amount) as amount'))->groupBy('dates')->orderBy('id', 'desc')->get();
        return view('reg.reg_item_list', compact('save'));
    }

    public function item_view_edit($date)
    {
        $list = RegItemSave::where('dates', $date)->get();

        if (empty($list)) {
            return Redirect::back()->with('message', 'warning|Data Not Found.');
        }

        $reg = Reg::get();
        $item = RegItem::get();

        return view('reg.item_view_edit', compact('list', 'reg', 'item', 'date'));
    }

    public function item_view_edit_post(Request $request)
    {

        foreach ($request->id as $key => $value) {
            if ($value !== null) {

                $data = RegItemSave::find($value);
                $data->amount = $request->count[$key];
                $data->save();
            }
        }

        return Redirect::route('reg.reg_item_list')->with('message', 'sucess|Data Updated.');
    }

    public function add_other()
    {
        $reg = RegOther::get();
        return view('reg.add_other', compact('reg'));
    }

    public function add_other_post(Request $request)
    {
        $reg = new RegOther();
        $reg->name = $request->item;
        // $reg->value = $request->value;
        $reg->save();
        return Redirect::back()->with('message', 'success|Reg Specefic Item Added.');
    }

    public function destroy_other($id)
    {
        RegOther::where('id', $id)->delete();
        return Redirect::back()->with('message', 'success|Reg Specefic Item Deleted.');
    }

    public function other_data_input()
    {
        $reg = Reg::get();
        $other = RegOther::get();
        $save = OtherInput::select(DB::raw('MAX(id) as id'), 'dates', DB::raw('SUM(amount) as amount'))->groupBy('dates')->orderBy('id', 'desc')->get();
        return view('reg.other_data_input', compact('save', 'reg', 'other'));
    }

    public function other_data_input_post(Request $request)
    {

        if (OtherInput::where(['reg_id' => $request->register, 'other_id' => $request->category, 'dates' => date('Y-m-d')])->first()) {
            return Redirect::back()->with('message', 'success|Register, category and date already inputed. If want to change please Edit.');
        }

        $other = new OtherInput();
        $other->reg_id = $request->register;
        $other->other_id = $request->category;
        $other->today_qty = $request->today;
        $other->amount = $request->amount;
        $other->total_qty = $request->total;
        $other->year = date('Y');
        $other->month = date('m');
        $other->date = date('d');
        $other->dates = date('Y-m-d');
        $other->user = Auth::id();
        $other->save();

        return Redirect::back()->with('message', 'success|Data Inputed');
    }
}
