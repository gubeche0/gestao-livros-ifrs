@extends('layouts.app')


@section('content')
        
    <div class="container">
            @include('layouts.statusMessages')
            <form method="post" id="form">
                    @csrf
            
                    <div class="form-group row">
        
                        <label for="name" class="col-sm-2 col-form-label">Nome:</label>
                        <div class="col-sm-10">
        
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nome" required>
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" required>
                        </div>
                    </div>
                    @isset($user)
                    @else
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Senha:</label>
                            <div class="col-sm-10">
                                <input type="text" name="password" id="password" placeholder="Senha" class="form-control @error('password') is-invalid @enderror" required>
                            </div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <input name="salvar" id="salvar" class="btn btn-primary col" type="submit" value="Salvar">
                        <input name="cancelar" id="cancelar" class="btn btn-danger col ml-1" type="reset" value="Cancelar">
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