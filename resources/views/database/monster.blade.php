@extends('layout')

@section('title', 'Database de Itens')
@section('description', 'Database de Itens')

@section('content')

    @if($errors->any())

        <div class="row">
            <div class="col-md-4">

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

    <div class="card">
        <div class="card-header card-header-icon" data-background-color="{{$configs['color']}}">
            <i class="material-icons">dns</i>
        </div>
        <div class="card-content">
            <h4 class="card-title">Database de Monstros</h4>
            <div class="material-datatables tablecentericon">
                @if($monsters == null)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <span>Tabela <strong>mob_db</strong> não foi encontrada, importe em seu banco de dados para visualizar os monstros.</span>
                            </div>
                        </div>
                    </div>
                @else
                <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <div class="col-md-3 col-md-offset-9">
                        <div class="form-group label-floating">
                            <form method="post" action="{{route('database.search.monster')}}">
                                @csrf
                                <label class="control-label">Pesquisar por Nome ou ID</label>
                                <input type="text" name="monsterSearch" class="form-control">
                                <button type="submit" class="btn btn-{{$configs['color']}} btn-xs pull-right">Pesquisar</button>
                            </form>
                        </div>
                    </div>
                    <thead>
                    <tr>
                        @if($monsters == '')
                            <p class="justify-content: text-center">Nenhum monstro encontrado.</p>
                        @else
                        <th>ID</th>
                        <th>Monstro</th>
                        <th>Tamanho</th>
                        <th>Elemento</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($monsters as $monster)
                            <tr>
                                <td>{{$monster->ID}}</td>
                                <td>{{$monster->iName}}</td>
                                <td>{{$monster_size[$monster->Scale]}}</td>
                                <td>{{$monster_element[substr($monster->Element, 1, 1)]}}</td>
                                <td><button class="btn btn-{{$configs['color']}} btn-xs" data-toggle="modal" data-target="#myModal{{$monster->ID}}">Visualizar</button></td>
                            </tr>

                            <!-- Modal Itens -->
                            <div class="modal fade" id="myModal{{$monster->ID}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                <i class="material-icons">clear</i>
                                            </button>
                                            <h4 class="modal-title">
                                                <b><img src="{{asset('assets/img/database/monsters')}}/{{$monster->ID}}.gif"> #{{$monster->ID}} - {{$monster->iName}}</b><hr>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><span>Nome:</span> {{$monster->iName}}</p>
                                            <p><span>Tamanho:</span> {{$monster_size[$monster->Scale]}}</p>
                                            <p><span>Raça:</span> {{$monster_race[$monster->Race]}}</p>
                                            <p><span>Level:</span> {{$monster->LV}}</p>
                                            <p><span>Elemento:</span> {{$monster_element[substr($monster->Element, 1, 1)]}}</p>
                                            <p><span>Velocidade:</span> {{$monster->Speed}}</p>
                                            <p><span>Experiência de MVP:</span> {{$monster->MEXP}}</p>
                                            <p><span>Experiência de Base e Job:</span> {{$monster->EXP}}/{{$monster->JEXP}}</p>
                                            <p><span>Ataque:</span> {{$monster->ATK1}}~{{$monster->ATK2}}</p>
                                            <p><span>DEF e MDEF:</span> {{$monster->DEF}}~{{$monster->MDEF}}</p>
                                            <p><span>HP e SP:</span> {{$monster->HP}}/{{$monster->SP}}</p>
                                            <p><span>Atributos:</span> <span>STR:</span> {{$monster->STR}} <span>AGI:</span> {{$monster->AGI}} <span>VIT:</span> {{$monster->VIT}} <span>INT:</span> {{$monster->INT}} <span>DEX</span> {{$monster->DEX}} <span>LUK</span> {{$monster->LUK}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @endif

                    </tbody>

                </table>
                @endif
                <div class="text-right">@if($monsters != null) {{$monsters->links("pagination::bootstrap-4")}} @endif</div>
            </div>
        </div>
    </div>




@endsection
