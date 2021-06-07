@extends('layout')

@section('title', 'Logs')
@section('description', 'Logs')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <ul class="nav nav-pills nav-pills-{{$configs['color']}}">
                            <li class="active" >
                                <a href="#pill1" data-toggle="tab">PvP</a>
                            </li>
                            <li>
                                <a href="#pill2" data-toggle="tab">Comandos</a>
                            </li>
                            <li>
                                <a href="#pill3" data-toggle="tab">Chat</a>
                            </li>
                            <li>
                                <a href="#pill4" data-toggle="tab">Clãns</a>
                            </li>
                            <li>
                                <a href="#pill5" data-toggle="tab">Login</a>
                            </li>
                            <li>
                                <a href="#pill6" data-toggle="tab">Drops</a>
                            </li>
                        </ul>

                        {{--PVP--}}
                        <div class="tab-content">
                            <div class="tab-pane active" id="pill1">

                                <div class="material-datatables tablecenter color-{{$configs['color']}}">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Assassino</th>
                                            <th>Alvo</th>
                                            <th>Data e Hora</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pvplogs as $pvp)
                                        <tr>
                                            <td>{{$pvp->ID}}</td>
                                            <td>{{$pvp->assassino}}</td>
                                            <td>{{$pvp->alvo}}</td>
                                            <td>{{$pvp->data}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="pill2">
                                {{--COMANDOS--}}
                                <div class="tab-content">
                                    <div class="tab-pane active" id="pill1">

                                        <div class="material-datatables tablecenter">
                                            <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Personagem</th>
                                                    <th>Mapa</th>
                                                    <th>Comando</th>
                                                    <th>Data</th>
                                                    <th>Hora</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($commandslogs as $commandlog)
                                                    <tr>
                                                        <td>{{$commandlog->atcommand_id}}</td>
                                                        <td>{{$commandlog->char_name}}</td>
                                                        <td>{{$commandlog->map}}</td>
                                                        <td>{{$commandlog->command}}</td>
                                                        <td>{{date('d-m-Y', strtotime($commandlog->atcommand_date))}}</td>
                                                        <td>{{date('H:m:i', strtotime($commandlog->atcommand_date))}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="pill3">
                                {{--COMANDOS--}}
                                <div class="tab-content">
                                    <div class="tab-pane active" id="pill1">

                                        <div class="material-datatables tablecenter">
                                            <table id="datatables3" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Personagem</th>
                                                    <th>Mapa</th>
                                                    <th>Mensagem</th>
                                                    <th>Data</th>
                                                    <th>Hora</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($chatlogs as $chatlog)
                                                    <tr>
                                                        <td>{{$chatlog->id}}</td>
                                                        <td>{{$chatlog->dst_charname}}</td>
                                                        <td>{{$chatlog->src_map}} ({{$chatlog->src_map_x}},{{$chatlog->src_map_y}})</td>
                                                        <td>{{$chatlog->message}}</td>
                                                        <td>{{date('d-m-Y', strtotime($chatlog->time))}}</td>
                                                        <td>{{date('H:m:i', strtotime($chatlog->time))}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="pill4">
                                {{--GUILD--}}
                                <div class="tab-content">
                                    <div class="tab-pane active" id="pill1">

                                        <div class="material-datatables tablecenter">
                                            <table id="datatables4" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>LOG</th>
                                                    <th>Data</th>
                                                    <th>Hora</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($guildlogs as $guildlog)
                                                    <tr>
                                                        <td>{{$guildlog->id}}</td>
                                                        <td>{{$guildlog->log}}</td>
                                                        <td>{{date('d-m-Y', strtotime($guildlog->time))}}</td>
                                                        <td>{{date('H:m:i', strtotime($guildlog->time))}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="pill5">
                                {{--LOGIN--}}
                                <div class="tab-content">
                                    <div class="tab-pane active" id="pill1">

                                        <div class="material-datatables tablecenter">
                                            <table id="datatables6" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>IP</th>
                                                    <th>Usuário</th>
                                                    <th>LOG</th>
                                                    <th>Data</th>
                                                    <th>Hora</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($loginlogs as $loginlog)
                                                    <tr>
                                                        <td>{{$loginlog->ip}}</td>
                                                        <td>{{$loginlog->user}}</td>
                                                        <td>{{$loginlog->log}}</td>
                                                        <td>{{date('d-m-Y', strtotime($loginlog->time))}}</td>
                                                        <td>{{date('H:m:i', strtotime($loginlog->time))}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="pill6">
                                {{--DROPS--}}
                                <div class="tab-content">
                                    <div class="tab-pane active" id="pill1">

                                        <div class="material-datatables tablecenter">
                                            <table id="datatables5" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>ID do Item</th>
                                                    <th>Quantidade do Item</th>
                                                    <th>Data</th>
                                                    <th>Hora</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($dropslogs as $droplog)
                                                    <tr>
                                                        <td>{{$droplog->id}}</td>
                                                        <td>{{$droplog->nameid}}</td>
                                                        <td>{{$droplog->amount}}</td>
                                                        <td>{{date('d-m-Y', strtotime($guildlog->time))}}</td>
                                                        <td>{{date('H:m:i', strtotime($guildlog->time))}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
