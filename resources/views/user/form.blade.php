@extends('layouts.app')


@section('content')
        
    <div class="container">
            @include('layouts.statusMessages')
            <form method="post" id="form">
                @csrf
                <div class="form-group row">
                    <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nome" required @isset($user) autofocus @endif value='@isset($user){{ $user->name }}@endif'>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" required value='@isset($user){{ $user->email }}@endif'>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tipo" class="col-sm-2 col-form-label">Função:</label>
                    <div class="col-sm-10">
                        <select class="custom-select @error('tipo') is-invalid @enderror" name="tipo" id="tipo">
                            <option value="1"  {{ old('funcao') == '1' ? 'selected' : '' }}>Coordenadoria</option>
                            <option value="2"  {{ old('funcao') == '2' ? 'selected' : '' }}>Administrador</option>
                            <option value="3"  {{ old('funcao') == '3' ? 'selected' : '' }}>Coordenador</option>
                            <option value="4"  {{ old('funcao') == '4' ? 'selected' : '' }}>Professor</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <input name="salvar" id="salvar" class="btn btn-primary col" type="submit" value="Salvar">
                    <a href=" {{route('user.index')}} " class="btn btn-danger col ml-1" > Cancelar </a>
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