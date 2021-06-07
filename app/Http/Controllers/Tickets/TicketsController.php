<?php

namespace App\Http\Controllers\Tickets;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\User\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database;
use App\Models\Char;
use App\Models\Guild;
use App\Models\RankingPVP;
use App\Models\RankingGVG;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;
use App\Models\Item;
use App\Models\Monster;
use App\Models\TicketsCategory;
use App\Models\Ticket;
use App\Models\Reply;

class TicketsController extends Controller
{
    public function index(Request $request)
    {

            return view('tickets.index', [
                'categorys' => $this->category()
            ]);
    }

    public function category(){

        $categorys = TicketsCategory::all();

        return $categorys;
    }

    public function imageupload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png'
        ]);
        $imageName = time().'.'.$request->file->extension();
        $request->file->move(public_path('assets/img/tickets'), $imageName);
        return [
            'location' => asset('assets/img/tickets/'.$imageName),
        ];
    }

    public function send(Request $request)
    {

        $validator = Validator::make($request->only('title', 'body'), [
            'title' => 'required|min:4|max:24',
            'body' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return redirect('tickets')
                ->withErrors($validator)
                ->withInput();
        }

        if($request->input('category') == null){

            return back()->with('custom_alert', 'Selecione uma categoria.');
        }

        $ticket = new Ticket;
        $ticket->title = $request->title;
        $ticket->login = $request->user()->userid;

        $ticket->email = $request->user()->email;

        $ticket->body = nl2br($request->body);
        $ticket->category = $request->category;

        $ticket->save();

        return back()->with('custom_alert_success', 'Ticket enviado com sucesso.');
    }

    public function myTickets(Request $request)
    {

        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;

        $tickets = Ticket::where('login', $request->user()->userid)->limit($limit)->offset(($page - 1) * $limit)->paginate();

        return view('tickets.mytickets', [
            'tickets' => $tickets
        ]);

    }

    public function ticketView(Request $request, $id)
    {
        $view = Ticket::find($id);

        $replys = DB::select("SELECT l.photo, t.ticket_id, t.login as ticket_login, t.body, t.created_at, t.updated_at FROM `login` AS l LEFT JOIN tickets_replys AS t ON l.userid = t.login  WHERE t.ticket_id=$id ORDER BY created_at ASC");

        if($view->login != $request->user()->userid){
            return redirect(route('tickets.mytickets'));
        }

        return view('tickets.ticketview', [
            'replys' => $replys,
            'view' => $view,

        ]);
    }

    public function reply(Request $request)
    {
        $validator = Validator::make($request->only('body'), [
            'body' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return redirect('tickets/view/'.$request->query('id'))
                ->withErrors($validator)
                ->withInput();
        }

        $reply = new Reply;
        $reply->ticket_id = $request->query('id');
        $reply->login = $request->user()->userid;
        $reply->body = nl2br($request->body);
        $reply->save();

        return redirect('tickets/view/'.$request->query('id'));
    }
}
