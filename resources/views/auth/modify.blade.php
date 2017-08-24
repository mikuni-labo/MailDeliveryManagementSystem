@extends('layouts.base')

@section('meta')
    <title>アカウント編集｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 8, 'offset' => 2])

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-warning">
                    <div class="panel-heading"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;アカウント編集</div>
                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['url' => route('modify'), 'method' => 'put', 'class' => 'form-horizontal', ]) !!}
                            @include('common.form.user', ['mode' => 'edit'])
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
