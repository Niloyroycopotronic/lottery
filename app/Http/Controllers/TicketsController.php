<?php

namespace App\Http\Controllers;

use App\Models\TicketName;
use App\Models\Tickets;
use App\StatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Tickets::where('status', StatusEnum::ACTIVE->value)->get();
        return view('ticket.index', compact('tickets'));
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
        $reg = new Tickets();
        $reg->name = $request->item;
        $reg->value = $request->value;
        $reg->save();
        return Redirect::back()->with('message', 'success|Tickets created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tickets $ticket)
    {
        $ticketname = TicketName::with('ticket')->where('ticket_id', $ticket->id)->get();
        $all_ticket = Tickets::orderBy('id', 'desc')->get();
        return view('ticket.show', compact('ticket', 'all_ticket', 'ticketname'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tickets $ticket)
    {
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tickets $ticket)
    {
        $ticket->name = $request->item;
        $ticket->value = $request->value;
        $ticket->save();
        return Redirect::route('ticket.index')->with('message', 'success|Tickets updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tickets $ticket)
    {
        $ticket->delete();
        return Redirect::back()->with('message', 'success|Tickets Deleted.');
    }
    public function filter(Request $request)
    {

        $ticket = Tickets::find($request->ticket_id);
        $ticketname = TicketName::with('ticket')->where('ticket_id', $ticket->id)->get();
        $all_ticket = Tickets::orderBy('id', 'desc')->get();
        return view('ticket.show', compact('ticket', 'all_ticket', 'ticketname'));
    }
}
