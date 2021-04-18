@extends('layout')

@section('title', 'Meus Tickets')
@section('description', 'Meus Tickets')

@section('content')

    @if(Session::has('custom_alert'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                                <span>
                                {{ Session::get('custom_alert') }}
                                    @php
                                        Session::forget('custom_alert');
                                    @endphp
                                </span>
                </div>
            </div>
        </div>
    @endif

    @if(Session::has('custom_alert_success'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                                <span>
                                {{ Session::get('custom_alert_success') }}
                                    @php
                                        Session::forget('custom_alert_success');
                                    @endphp
                                </span>
                </div>
            </div>
        </div>
    @endif

    @if($errors->any())

        <div class="row">
            <div class="col-md-12">

                <div class="alert alert-danger">
                            <span>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach</span>
                    </span>
                </div>

            </div>
        </div>

    @endif

    @if(!count($tickets))

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <span>Nenhum ticket encontrado</span>
                </div>
            </div>
        </div>

    @endif

    <div class="card">
        <div class="card-header card-header-icon" data-background-color="{{$configs['color']}}">
            <i class="material-icons">support_agent</i>
        </div>
        <div class="card-content">
            <h4 class="card-title">Meus Tickets</h4>
            <div class="material-datatables tablecentericon">
                <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Categoria</th>
                        <th>Status</th>
                        <th>Criado em</th>
                        <th>Atualizado em</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)

                            <td>{{$ticket->id}}</td>
                            <td>{{$ticket->title}}</td>
                            <td>{{$ticket->category}}</td>
                            @if($ticket->status == "Aberto")
                                <td><button class="btn btn-info btn-xs">{{$ticket->status}}</button></td>
                            @elseif($ticket->status == "Atendimento")
                                <td><button class="btn btn-success btn-xs">{{$ticket->status}}</button></td>
                            @elseif($ticket->status == "Resolvido")
                                <td><button class="btn btn-danger btn-xs">{{$ticket->status}}</button></td>
                            @endif
                            <td>{{date('d-m-Y', strtotime($ticket->created_at))}} às {{date('H:i:s', strtotime($ticket->created_at))}}</td>
                            <td>{{date('d-m-Y', strtotime($ticket->updated_at))}} às {{date('H:i:s', strtotime($ticket->updated_at))}}</td>
                            <form method="get" action="{{route('tickets.ticketview', ['id' => $ticket->id])}}">
                                @csrf
                            <td><button type="submit" class="btn btn-{{$configs['color']}} btn-xs">Visualizar</button></td>
                            </form>

                        </tr>

                    @endforeach
                    </tbody>

                </table>
                <div class="text-right"> {{$tickets->links("pagination::bootstrap-4")}} </div>
            </div>
        </div>
    </div>

@endsection
