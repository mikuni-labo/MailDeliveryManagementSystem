@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading"><span class="glyphicon glyphicon-plus"></span>&nbsp;アカウント登録</div>
                    <div class="panel-body">
                        @include('flash::message')

                        @include('common.form.user', ['mode' => 'register'])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
