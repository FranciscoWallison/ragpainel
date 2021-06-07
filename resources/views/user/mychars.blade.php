@extends('layout')

@section('title', 'Meus Personagens')
@section('description', 'Meus Personagens')

@section('content')

    @if(Session::has('custom_alert'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
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

    @empty($chars)
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <span>Nenhum Personagem Encontrado</span>
                </div>
            </div>
        </div>
    @endempty

    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">supervisor_account</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Meus Personagens</h4>
                        <div class="table-responsive tablecenter">
                            <table class="table">
                                <thead class="text-primary">
                                <th>Nome</th>
                                <th>Level</th>
                                <th>Mapa</th>
                                <th>Clãn</th>
                                <th>Ações</th>
                                </thead>
                                <tbody>
                                @foreach($chars as $char)
                                <tr>

                                    <td>{{$char->char_name}}</td>
                                    <td>{{$char->base_level}}/{{$char->job_level}}</td>
                                    <td>{{$char->last_map}}</td>
                                    <td>{{$char->guild_name}}</td>
                                    <td>

                                        <form class="form-inline" action="{{route('user.resetposition', ['id' => $char->charid])}}" method="post">
                                            @csrf
                                        <button type="submit" class="btn btn-success block-inline">Resetar Posição</button>
                                        <button type=submit" class="btn btn-info" formaction="{{route('user.resetstyle', ['id' => $char->charid])}}">Resetar Aparência</button>
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

@endsection
