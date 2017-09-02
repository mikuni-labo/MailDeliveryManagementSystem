@extends('layouts.base')

@section('meta')
    <title>配信セット登録｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 12, 'offset' => 0])

        @include('common.parts.template')

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-info">
                    <div class="panel-heading lead"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;配信セット登録</div>
                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['url' => route('mail.set.add', $MailTemplate->id), 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            {!! Form::hidden('mail_template_id', $MailTemplate->id) !!}

                            @include('common.form.delivery_set', ['mode' => 'add'])
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
