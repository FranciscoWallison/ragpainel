@extends('layout')

@section('title', 'Início')
@section('description', 'Painel de Controle')

@section('content')

    <div class="col-lg-3 col-md-6 col-sm-6 spacing-top">
        <div class="card card-stats">
            <div class="card-header" data-background-color="green">
                <i class="material-icons">supervisor_account</i>
            </div>
            <div class="card-content">
                <p class="category">Jogadores Online</p>
                <h3 class="card-title">{{$charsOnline}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> atualizado a cada 5 minutos
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 spacing-top">
        <div class="card card-stats">
            <div class="card-header" data-background-color="orange">
                <i class="material-icons">account_box</i>
            </div>
            <div class="card-content">
                <p class="category">Total de Contas</p>
                <h3 class="card-title">{{$userCount}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> atualizado em tempo real
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 spacing-top">
        <div class="card card-stats">
            <div class="card-header" data-background-color="blue">
                <i class="material-icons">group_add</i>
            </div>
            <div class="card-content">
                <p class="category">Total de Personagens</p>
                <h3 class="card-title">{{$charCount}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> atualizado em tempo real
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 spacing-top">
        <div class="card card-stats">
            <div class="card-header" data-background-color="red">
                <i class="material-icons">group_add</i>
            </div>
            <div class="card-content">
                <p class="category">Total de Clãns</p>
                <h3 class="card-title">{{$guildCount}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> atualizado em tempo real
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-header card-header-text" data-background-color="{{$configs['color']}}">
                <h4 class="card-title">TOP PVP</h4>
                <p class="category">Os 3 melhores jogadores do pvp.</p>
            </div>
            <div class="card-content table-responsive tablecenter color-{{$configs['color']}}">
                <table class="table table-hover">
                    <thead class="text-warning">
                    <th>Posição</th>
                    <th>Nome</th>
                    <th>Pontos</th>
                    </thead>
                    <tbody>

                        @foreach($topPVP as $top)
                        <tr>
                            <td><img src="assets/img/top/{{$np}}.png"></td>
                            <td>{{$top->char_name}}</td>
                            <td>{{$top->point}}</td>
                            @php $np++; @endphp
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-header card-header-text" data-background-color="{{$configs['color']}}">
                <h4 class="card-title">TOP WOE</h4>
                <p class="category">Os 3 melhores jogadores da woe.</p>
            </div>
            <div class="card-content table-responsive tablecenter color-{{$configs['color']}}">
                <table class="table table-hover">
                    <thead class="text-warning">
                    <th>Posição</th>
                    <th>Nome</th>
                    <th>Pontos</th>
                    </thead>
                    <tbody>
                    @foreach($topGVG as $top)
                        <tr>
                            <td><img src="assets/img/top/{{$nw}}.png"></td>
                            <td>{{$top->guild_name}}</td>
                            <td>{{$top->point}}</td>
                            @php $nw++; @endphp
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-header card-header-text" data-background-color="{{$configs['color']}}">
                <h4 class="card-title">TOP MVP</h4>
                <p class="category">Os 3 melhores jogadores.</p>
            </div>
            <div class="card-content table-responsive tablecenter color-{{$configs['color']}}">
                <table class="table table-hover">
                    <thead class="text-warning">
                    <th>Posição</th>
                    <th>Nome</th>
                    <th>Pontos</th>
                    </thead>
                    <tbody>
                    @foreach($topMVP as $top)
                        <tr>
                            <td><img src="assets/img/top/{{$nm}}.png"></td>
                            <td>{{$top->name}}</td>
                            <td>{{$top->mvps}}</td>
                            @php $nm++; @endphp
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
