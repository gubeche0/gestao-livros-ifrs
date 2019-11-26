@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="panel-heading">
            <h1 class="panel-title text-center my-3">Mude sua senha</h1>
        </div>
        <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.senhaNova') }}" autocomplete="off">
                            @csrf
                            <center>
                                @if (Session::has('message_success_senha'))
                                    <div class="alert alert-success" style="width:60%">{{ Session::get('message_success_senha') }}</div>
                                @endif
                            </center>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Nova senha') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Nova senha') }}" value="">
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirmar nova senha') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirmar nova senha') }}" value="">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Mudar senha') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/additional-methods.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/localization/messages_pt_BR.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/validacao.js') }}"></script>
@endsection