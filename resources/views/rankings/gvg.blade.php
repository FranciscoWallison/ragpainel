@extends('layout')

@section('title', 'Ranking da Guerra do Emperium')
@section('description', 'Ranking da Guerra do Emperium')

@section('content')

    <div class="card">
        <div class="card-header card-header-icon" data-background-color="{{$configs['color']}}">
            <i class="material-icons">emoji_events</i>
        </div>
        <div class="card-content">
            <h4 class="card-title">TOP <b>50</b> melhores clãns da guerra do emperium</h4>
            <div class="table-responsive tablecenter color-{{$configs['color']}}">
                @if(count($rankingGVG) == 0)
                    <p class="justify-content: text-center">Nenhum jogador encontrado.</p>
                @else
                    <table class="table">
                        <thead class="text-primary">
                        <th>Posição</th>
                        <th>Clãn</th>
                        <th>Matou</th>
                        <th>Morreu</th>
                        <th>Pontos</th>
                        </thead>
                        <tbody>

                        @foreach($rankingGVG as $data)
                        <tr>
                            <td>{{$n}}</td>
                            <td>{{$data->guild_name}}</td>
                            <td>{{$data->killed}}</td>
                            <td>{{$data->died}}</td>
                            <td class="text-primary">{{$data->point}}</td>
                        </tr>
                        @php $n++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

@endsection
