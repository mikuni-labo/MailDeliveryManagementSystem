@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;アカウント編集</div>
                    <div class="panel-body">
                        @include('flash::message')

                        @include('common.form.user', ['mode' => 'modify'])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
