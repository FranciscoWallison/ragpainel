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
            <h4 class="card-title">Database de Itens</h4>
            <div class="material-datatables tablecentericon color-{{$configs['color']}}">
                <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <div class="col-md-3 col-md-offset-9">
                            <div class="form-group label-floating">
                                <form method="post" action="{{route('database.search.item')}}">
                                    @csrf
                                    <label class="control-label">Pesquisar por Nome ou ID</label>
                                    <input type="text" name="itemSearch" class="form-control">
                                    <button type="submit" class="btn btn-{{$configs['color']}} btn-xs pull-right">Pesquisar</button>
                                </form>
                            </div>
                        </div>
                    <thead>
                    <tr>
                        @if($itens == '')
                            <p class="justify-content: text-center">Nenhum item encontrado.</p>
                        @else
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($itens as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td><img src="{{asset('assets/img/database/itens/icons')}}/{{$item->id}}.png"> {{$item->name_japanese}}</td>
                                <td>{{ empty($type_itens[$item->type]) ? $item->type : $type_itens[$item->type] }}</td>
                                <td><button class="btn btn-{{$configs['color']}} btn-xs" data-toggle="modal" data-target="#myModal{{$item->id}}">Visualizar</button></td>
                            </tr>

                            <!-- Modal Itens -->
                            <div class="modal fade" id="myModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                <i class="material-icons">clear</i>
                                            </button>
                                            <h4 class="modal-title">
                                                <b><img src="{{asset('assets/img/database/itens/images')}}/{{$item->id}}.png"> #{{$item->id}} - {{$item->name_japanese}}</b><hr>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><span>Nome:</span> {{$item->name_japanese}}</p>
                                            <p><span>Tipo:</span> {{( empty($type_itens[$item->type]) ? $item->type : $type_itens[$item->type] )}}</p>
                                            <p><span>Valor de Compra:</span> {{$item->price_buy}}</p>
                                            <p><span>Valor de Venda:</span> {{$item->price_sell}}</p>
                                            <p><span>Peso:</span> {{$item->weight}}</p>
                                            @if(
                                                ( empty($type_itens[$item->type]) ? $item->type : $type_itens[$item->type] ) == "Armadura" |
                                                ( empty($type_itens[$item->type]) ? $item->type : $type_itens[$item->type] ) == "Arma")  |
                                                ( empty($type_itens[$item->type]) ? $item->type : $type_itens[$item->type] ) == "Armor" |
                                                ( empty($type_itens[$item->type]) ? $item->type : $type_itens[$item->type] ) == "Weapon")  |

                                                <p><span>Defesa:</span> {{$item->defence}}</p>
                                                <p><span>ATK/MATK:</span> {{$item->atk}}/{{$item->matk}}</p>
                                                <p><span>Slots:</span> {{$item->slots}}</span></p>
                                                <p><span>Equipa em:</span> {{$equipIn[$item->equip_locations]}}</p>
                                            @endif

                                            @if(
                                                ( empty($type_itens[$item->type]) ? $item->type : $type_itens[$item->type] ) == "Arma" |
                                                ( empty($type_itens[$item->type]) ? $item->type : $type_itens[$item->type] ) == "Weapon"
                                            )
                                                <p><span>Nível da Arma:</span> {{$item->atk}}/{{$item->matk}}</p>
                                            @endif
                                            @if($item->equip_level_min != 0)
                                            <p><span>Nível mínimo para equipar:</span> {{$item->equip_level_min}}</p>
                                            @endif
                                            @if(!empty($item->script))
                                                <p><span>Script ao usar:</span> {{$item->script}}</p>
                                            @endif
                                            @if(!empty($item->equip_script))
                                                <p><span>Script ao equipar:</span> {{$item->equip_script}}</p>
                                            @endif
                                            @if(!empty($item->unequip_script))
                                                <p><span>Script ao desequipar:</span> {{$item->unequip_script}}</p>
                                            @endif



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
                <div class="text-right"> {{$itens->links("pagination::bootstrap-4")}} </div>
            </div>
        </div>
    </div>




@endsection
