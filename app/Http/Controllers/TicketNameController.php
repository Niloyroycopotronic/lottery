<?php

namespace App\Http\Controllers;

use App\Models\LastData;
use App\Models\LotteryCount;
use App\Models\TicketName;
use App\Models\Tickets;
use App\StatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TicketNameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticketname = TicketName::with('ticket')->get();
        $tickets = Tickets::orderBy('id', 'desc')->get();

        return view('ticket.ticket_name', compact('tickets', 'ticketname'));
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
        $ticket = new TicketName();
        $ticket->ticket_id = $request->ticket_id;
        $ticket->name = $request->name;
        $ticket->value = $request->value;
        $ticket->page = $request->page;
        $ticket->save();

        $last = new LastData();
        $last->ticket_id = $request->ticket_id;
        $last->lottery_id = $ticket->id;
        $last->amount = 0;
        $last->date = date('d');
        $last->month = date('m');
        $last->year = date('Y');
        $last->save();

        return Redirect::back()->with('message', 'success|Ticket Name Set.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketName $ticketName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketName $ticketName)
    {
        $tickets = Tickets::orderBy('id', 'desc')->get();
        return view('ticket.edit_name', compact('tickets', 'ticketName'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketName $ticketName)
    {
        $ticketName->ticket_id = $request->ticket_id;
        $ticketName->name = $request->name;
        $ticketName->value = $request->value;
        $ticketName->page = $request->page;
        $ticketName->save();



        return Redirect::route('ticket_name.index')->with('message', 'success|Ticket Name Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketName $ticketName)
    {
        $ticketName->delete();
        return Redirect::back()->with('message', 'success|Tickets Deleted.');
    }

    public function status_change(TicketName $ticketName)
    {
        if ($ticketName->status->isActive()) {

            $ticketName->status = StatusEnum::DEACTIVE->value;
            $ticketName->save();
        } else {

            $ticketName->status = StatusEnum::ACTIVE->value;
            $ticketName->save();
        }

        return Redirect::back()->with('message', 'success|Lottery Status Changed.');
    }

    public function counting()
    {

        $tickets = Tickets::where('status', StatusEnum::ACTIVE->value)->get();
        $lottery = TicketName::where('status', StatusEnum::ACTIVE->value)->get();

        return view('ticket.counting', compact('tickets', 'lottery'));
    }

    public function counting_post(Request $request)
    {

        if (LotteryCount::where('dates', date('Y-m-d'))->first()) {
            return Redirect::back()->with('message', 'error|Today Lottery Already Counted.');
        }

        foreach ($request->ticket as $key => $value) {
            $lottery = new LotteryCount();

            $lottery->ticket_id = $value;
            $lottery->lottery_id = $request->lottery[$key];
            $lottery->old_id = $request->old[$key];
            $lottery->today = $request->today[$key];
            $lottery->old = $request->last[$key];
            $lottery->total = $request->total[$key];
            $lottery->amount = $request->value[$key] * $request->total[$key];
            $lottery->date = date('d');
            $lottery->month = date('m');
            $lottery->year = date('Y');
            $lottery->dates = date('Y-m-d');
            $lottery->save();

            $last = new LastData();
            $last->ticket_id = $value;
            $last->lottery_id = $request->lottery[$key];
            $last->amount = $request->today[$key];
            $last->date = date('d');
            $last->month = date('m');
            $last->year = date('Y');
            $last->save();
        }

        return Redirect::route('ticket.count_list')->with('message', 'success|Today Lottery Counted.');
    }

    public function count_list()
    {

        $list = LotteryCount::select(DB::raw('SUM(total) as total_amount'), DB::raw('SUM(amount) as amount'),  'dates')->groupBy('dates')->orderBy('id', 'desc')->get();
        return view('ticket.count_list', compact('list'));
    }

    public function list_edit($id)
    {
        $list = LotteryCount::where('dates', $id)->get();
        $tickets = Tickets::where('status', StatusEnum::ACTIVE->value)->get();
        $lottery = TicketName::where('status', StatusEnum::ACTIVE->value)->get();
        $date = $id;

        return view('ticket.list_edit', compact('tickets', 'lottery', 'list', 'date'));
    }

    public function list_edit_post(Request $request)
    {
        $date = explode('-', $request->date);

        foreach ($request->id as $key => $value) {

            $lottery = LotteryCount::find($value);
            $lottery->today = $request->today[$key];
            $lottery->old = $request->last[$key];
            $lottery->total = $request->total[$key];
            $lottery->amount = $request->value[$key] * $request->total[$key];
            $lottery->save();

            $last = LastData::where([
                'ticket_id' => $lottery->ticket_id,
                'lottery_id' => $lottery->lottery_id,
                'year' => $date[0],
                'month' => $date[1],
                'date' => $date[2],
            ])->first();
            $last->amount = $request->today[$key];
            $last->save();
        }

        return Redirect::route('ticket.count_list')->with('message', 'success|Today Lottery Updated.');
    }
}
