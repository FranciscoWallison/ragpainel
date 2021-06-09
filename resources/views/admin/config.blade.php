@extends('layout')

@section('title', 'Configurações do Painel')
@section('description', 'Configurações do Painel')

@section('content')

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

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">settings</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Configurações Gerais
                        </h4>
                        <form method="post" action="{{route('admin.config.savegeneral')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nome do Painel</label>
                                            <input type="text" name="title" value="{{$configs['title']}}" class="form-control" minlength="4" maxlength="100" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nome Mini (2 Letras)</label>
                                            <input type="text" name="title_mini" value="{{$configs['title_mini']}}" class="form-control" minlength="2" maxlength="2" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" name="email" value="{{$configs['email']}}" class="form-control" minlength="4" maxlength="100" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Discord</label>
                                            <input type="text" name="discord" value="{{$configs['discord']}}" class="form-control" maxlength="100" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Facebook</label>
                                            <input type="text" name="facebook" value="{{$configs['facebook']}}" class="form-control" maxlength="100" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">account_box</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Configurações de Conta
                        </h4>
                        <form method="post" action="{{route('admin.config.saveaccount')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="togglebutton">
                                                <label>
                                                    <input type="checkbox" name="notify_register" @if($configs['notify_register'] == 'on') checked @endif> <span class="text_config">Ativar notificação para o jogador quando realizar um registro.</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="togglebutton">
                                                <label>
                                                    <input type="checkbox" name="verify_register" @if($configs['verify_register'] == 'on') checked @endif> <span class="text_config">Ativar confirmação de e-mail para completar o registro.</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="orange">
                        <i class="material-icons">palette</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Cor do Painel
                        </h4>
                        <form method="post"">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" formaction="{{route('admin.config.savecolor', ['color' => 'purple'])}}">Roxo</button>
                                            <button type="submit" class="btn btn-success" formaction="{{route('admin.config.savecolor', ['color' => 'green'])}}">Verde</button>
                                            <button type="submit" class="btn btn-info" formaction="{{route('admin.config.savecolor', ['color' => 'blue'])}}">Azul</button>
                                            <button type="submit" class="btn btn-warning" formaction="{{route('admin.config.savecolor', ['color' => 'orange'])}}">Amarelo</button>
                                            <button type="submit" class="btn btn-danger" formaction="{{route('admin.config.savecolor', ['color' => 'red'])}}">Vermelho</button>
                                            <button type="submit" class="btn btn-rose" formaction="{{route('admin.config.savecolor', ['color' => 'rose'])}}">Rosa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">colorize</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Cor de Fundo
                        </h4>
                        <form method="post"">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default" formaction="{{route('admin.config.savecolorbg', ['colorbg' => 'white'])}}">Branco</button>
                                        <button type="submit" class="btn btn-github" formaction="{{route('admin.config.savecolorbg', ['colorbg' => 'black'])}}">Preto</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="green">
                        <i class="material-icons">psychology</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Configurações VIP
                        </h4>
                        <form method="post" action="{{route('admin.config.savevip')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Level do jogador VIP</label>
                                            <input type="text" name="levelvip" value="{{$configs['levelvip']}}" class="form-control" maxlength="2" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success pull-right">Salvar</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="red">
                        <i class="material-icons">manage_accounts</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Configurações Equipe
                        </h4>
                        <form method="post" action="{{route('admin.config.savestaff')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Level do Administrador</label>
                                            <input type="text" name="leveladm" value="{{$configs['leveladm']}}" class="form-control" maxlength="2" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Level do Game Master</label>
                                            <input type="text" name="levelgm" value="{{$configs['levelgm']}}" class="form-control" maxlength="2" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Level do Comunity Manager</label>
                                            <input type="text" name="levelcm" value="{{$configs['levelcm']}}" class="form-control" maxlength="2" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-danger pull-right">Salvar</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">cable</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Configurações de Tickets
                        </h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                                <input type="text" value="@foreach($categorys as $category) {{$category->name}}, @endforeach" class="tagsinput" data-role="tagsinput" data-color="blue" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <form method="post" action="{{route('admin.config.addcategory')}}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="control-label">Nova Categoria</label>
                                                <input type="text" name="addcategory" class="form-control" required>
                                                <button type="submit" class="btn btn-info pull-right">Adicionar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form method="post" action="{{route('admin.config.removecategory')}}">
                                            @csrf
                                                <div class="form-group">
                                                    <select class="selectpicker" name="removecategory" data-style="btn btn-danger btn-round" title="Selecione a Categoria" data-size="7">
                                                    @foreach($categorys as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                    </select>
                                                    <button type="submit" class="btn btn-danger pull-right">Remover</button>
                                                </div>
                                            </form>
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
