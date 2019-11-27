@extends('layouts.app')


@section('content')
        
    <div class="container">
        <div class="panel-heading">
            <h1 class="panel-title text-center my-3">Cadastro de Professores</h1>
        </div>
            @include('layouts.statusMessages')
            <form method="post" id="form">
                @csrf

                <input type="hidden" name="id" value='@isset($user){{ $user->id }}@endif'>
                <div class="form-group row">
                    <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="name"  class="form-control @error('name') is-invalid @enderror" placeholder="Nome" required value='@isset($user){{ $user->name }}@endif'>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" required value='@isset($user){{ $user->email }}@endif'>
                    </div>
                </div> 

                <div class="form-group row">
                    <input name="salvar" id="salvar" class="btn btn-primary col" type="submit" value="Salvar">
                    <a href=" {{route('professor.index')}} " class="btn btn-danger col ml-1" > Cancelar </a>
                </div>
            </form>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/additional-methods.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/localization/messages_pt_BR.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/validacao.js') }}"></script>
@endsection