@extends('layouts.base')

@section('meta')
    <title>ログイン｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 8, 'offset' => 2])

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;ログイン</div>
                    <div class="panel-body">
                        {!! Form::open(['class' => 'form-horizontal', 'url' => route('login')]) !!}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">メールアドレス</label>

                                <div class="col-md-6">
                                    {!! Form::email('email', null, ['required', 'autofocus', 'class' => 'form-control', 'id' => 'email', 'maxlength' => '255', 'placeholder' => '']) !!}

                                    @if( $errors->has('email') )
                                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">パスワード</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" maxlength="255" placeholder="" required />

                                    @if( $errors->has('password') )
                                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4 form-control-static">
                                    <label>{!! Form::checkbox('remember', 1, []) !!} ログイン状態を保存する</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">送信</button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;パスワードをお忘れの方
                                    </a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        //
    </script>
@endsection
