<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\User\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database;
use App\Models\Char;
use App\Models\Guild;
use App\Models\RankingPVP;
use App\Models\RankingGVG;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\Validator;
use App\Models\Reply;

class ManagerTicketController extends Controller
{
    public function index(Request $request)
    {

        $ticketsOpen = Ticket::select()->where('status', "Aberto")->get();
        $ticketsclose = Ticket::select()->where('status', "Resolvido")->get();
        $ticketsatt = Ticket::select()->where('status', "Atendimento")->get();

        return view('admin.managerticket', [
            'ticketsOpen' => $ticketsOpen,
            'ticketsclose' => $ticketsclose,
            'ticketsatt' => $ticketsatt
        ]);
    }

    public function view(Request $request, $id)
    {
        $ticket = DB::select("SELECT l.photo, t.id, t.login as ticket_login, t.body, t.title, t.status, t.created_at, t.updated_at FROM `login` AS l LEFT JOIN tickets AS t ON l.userid = t.login  WHERE t.id=$id");

        $replys = DB::select("SELECT l.photo, t.ticket_id, t.login as ticket_login, t.body, t.created_at, t.updated_at FROM `login` AS l LEFT JOIN tickets_replys AS t ON l.userid = t.login  WHERE t.ticket_id=$id ORDER BY created_at ASC");

        return view('admin.managerticketview', [
            'ticket' => $ticket,
            'replys' => $replys
        ]);

    }

    public function close($id){

        $ticket = Ticket::find($id);
        $ticket->status = 'Resolvido';
        $ticket->save();

        return redirect()->route('admin.managertickets');
    }

    public function open($id){

        $ticket = Ticket::find($id);
        $ticket->status = 'Atendimento';
        $ticket->save();

        return redirect()->route('admin.managertickets');
    }

    public function reply(Request $request){
        $validator = Validator::make($request->only('body'), [
            'body' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return redirect('admin/managertickets/view/'.$request->query('id'))
                ->withErrors($validator)
                ->withInput();
        }

        $ticket = Ticket::find($request->query('id'));
        $ticket->status = 'Atendimento';
        $ticket->save();

        $reply = new Reply;
        $reply->ticket_id = $request->query('id');
        $reply->login = $request->user()->userid;
        $reply->body = nl2br($request->body);
        $reply->save();

        return redirect('admin/managertickets/view/'.$request->query('id'));
    }
}
