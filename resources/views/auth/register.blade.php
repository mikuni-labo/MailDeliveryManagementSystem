@extends('layouts.base')

@section('meta')
    <title>アカウント登録｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 8, 'offset' => 2])

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading lead"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;アカウント登録</div>
                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['url' => route('register'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            @include('common.form.user', ['mode' => 'add'])
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
