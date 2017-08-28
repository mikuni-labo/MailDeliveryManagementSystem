@extends('layouts.base')

@section('meta')
    <title>来場者編集｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 10, 'offset' => 1])

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading lead"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;来場者編集</div>
                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['url' => route('visitor.edit', [$row->id]), 'method' => 'put', 'class' => 'form-horizontal']) !!}
                            @include('common.form.visitor', ['mode' => 'edit'])
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
