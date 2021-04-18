@extends('layout')

@section('title', 'Gerenciar Tickets')
@section('description', 'Gerenciar Tickets')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <ul class="nav nav-pills nav-pills-{{$configs['color']}}">
                            <li class="active">
                                <a href="#pill1" data-toggle="tab">Abertos</a>
                            </li>
                            <li>
                                <a href="#pill2" data-toggle="tab">Atendimento</a>
                            </li>
                            <li>
                                <a href="#pill3" data-toggle="tab">Resolvidos</a>
                            </li>
                        </ul>

                        {{--Abertos--}}
                        <div class="tab-content">
                            <div class="tab-pane active" id="pill1">

                                <div class="material-datatables tablecenter color-{{$configs['color']}}">
                                    <table id="tickets" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Título</th>
                                            <th>Categoria</th>
                                            <th>Status</th>
                                            <th>Criado em</th>
                                            <th>Atualizado em</th>
                                            <th>Ações</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ticketsOpen as $open)
                                                <tr>
                                                    <td>{{$open->id}}</td>
                                                    <td>{{$open->title}}</td>
                                                    <td>{{$open->category}}</td>
                                                    <td><button class="btn btn-info btn-xs">{{$open->status}}</button></td>
                                                    <td>{{date('d-m-Y', strtotime($open->created_at))}} às {{date('H:m:i', strtotime($open->created_at))}}</td>
                                                    <td>{{date('d-m-Y', strtotime($open->updated_at))}} às {{date('H:m:i', strtotime($open->updated_at))}}</td>
                                                    <td>
                                                        <form method="get" action="{{route('admin.managertickets.view', ['id' => $open->id])}}">
                                                            <button type="submit" class="btn btn-{{$configs['color']}} btn-xs">Visualizar</button>
                                                            <button type="submit" class="btn btn-danger btn-xs" formaction="{{route('admin.managertickets.close', ['id' => $open->id])}}">Fechar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="pill2">
                                {{--Atendimento--}}
                                <div class="tab-content">
                                    <div class="tab-pane active" id="pill1">

                                        <div class="material-datatables tablecenter color-{{$configs['color']}}">
                                            <table id="tickets2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Título</th>
                                                    <th>Categoria</th>
                                                    <th>Status</th>
                                                    <th>Criado em</th>
                                                    <th>Atualizado em</th>
                                                    <th>Ações</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ticketsatt as $att)
                                                    <tr>
                                                        <td>{{$att->id}}</td>
                                                        <td>{{$att->title}}</td>
                                                        <td>{{$att->category}}</td>
                                                        <td><button class="btn btn-success btn-xs">{{$att->status}}</button></td>
                                                        <td>{{date('d-m-Y', strtotime($att->created_at))}} às {{date('H:i:s', strtotime($att->created_at))}}</td>
                                                        <td>{{date('d-m-Y', strtotime($att->updated_at))}} às {{date('H:i:s', strtotime($att->updated_at))}}</td>
                                                        <td>
                                                            <form method="get" action="{{route('admin.managertickets.view', ['id' => $att->id])}}">
                                                                <button type="submit" class="btn btn-{{$configs['color']}} btn-xs">Visualizar</button>
                                                                <button type="submit" class="btn btn-danger btn-xs" formaction="{{route('admin.managertickets.close', ['id' => $att->id])}}">Fechar</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="pill3">
                                {{--Resolvido--}}
                                <div class="tab-content">
                                    <div class="tab-pane active" id="pill1">

                                        <div class="material-datatables tablecenter color-{{$configs['color']}}">
                                            <table id="tickets3" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Título</th>
                                                    <th>Categoria</th>
                                                    <th>Status</th>
                                                    <th>Criado em</th>
                                                    <th>Atualizado em</th>
                                                    <th>Ações</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ticketsclose as $close)
                                                    <tr>
                                                        <td>{{$close->id}}</td>
                                                        <td>{{$close->title}}</td>
                                                        <td>{{$close->category}}</td>
                                                        <td><button class="btn btn-danger btn-xs">{{$close->status}}</button></td>
                                                        <td>{{date('d-m-Y', strtotime($close->created_at))}} às {{date('H:m:i', strtotime($close->created_at))}}</td>
                                                        <td>{{date('d-m-Y', strtotime($close->updated_at))}} às {{date('H:m:i', strtotime($close->updated_at))}}</td>
                                                        <td>
                                                            <form method="get" action="{{route('admin.managertickets.view', ['id' => $close->id])}}">
                                                                <button type="submit" class="btn btn-{{$configs['color']}} btn-xs">Visualizar</button>
                                                                <button type="submit" class="btn btn-info btn-xs" formaction="{{route('admin.managertickets.open', ['id' => $close->id])}}">Abrir</button>
                                                            </form>
                                                        </td>
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
