<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Http\Requests\Admin\Ticket\TicketRequest;


class TicketController extends Controller
{

    public function newTickets()
    {
		$tickets=Ticket::where('seen',0)->get();
		
		foreach($tickets as $ticket){
			$ticket->seen=1;
			$res=$ticket->save();
		}
		
        return view('admin.ticket.index',compact('tickets'));
    }

    public function openTickets()
    {
	    $tickets=Ticket::where('status',0)->get();
        return view('admin.ticket.index',compact('tickets'));
    }

    public function closeTickets()
    {
        $tickets=Ticket::where('status',1)->get();
        return view('admin.ticket.index',compact('tickets'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$tickets=Ticket::whereNull('ticket_id')->get();
        return view('admin.ticket.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
		//dd(auth()->user()->ticketAdmin);
        return view('admin.ticket.show',compact('ticket'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
	
	
	public function change(Ticket $ticket)
	{
		$ticket->status=$ticket->status == 0 ? 1 : 0;
		$ticket->save();
		return redirect()->back()->with('swal-success', 'تغییر شما با موفقیت انجام شد');
	}
	
	
	public function answer(TicketRequest $request, Ticket $ticket)
	{
		if($ticket->parent == null){
		$user=auth()->user();
		$inputs=$request->all();
		$inputs['subject']=$ticket->subject;
		$inputs['seen']=1;
		$inputs['reference_id']=$user->ticketAdmin->id;
		$inputs['category_id']=$ticket->category_id;
		$inputs['user_id']=$ticket->user_id;
		$inputs['priority_id']=$ticket->priority_id;
		$inputs['ticket_id']=$ticket->id;
		$inputs['description']=$request->description;
		
		Ticket::create($inputs);
	    return redirect()->back();
		//->with('swal-success', '  پاسخ شما با موفقیت ثبت شد');

		}else{
			
		return redirect()->back()->with('swal-error', 'خطایی رخ داد');
		}
	}
		
		
}






