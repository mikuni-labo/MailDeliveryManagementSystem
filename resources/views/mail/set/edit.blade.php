@extends('layouts.base')

@section('meta')
    <title>配信セット編集｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 12, 'offset' => 0])

        @include('common.parts.template')

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-warning">
                    <div class="panel-heading lead"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;配信セット編集</div>
                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['url' => route('mail.set.edit', [$MailTemplate->id, $row->id]), 'method' => 'put', 'class' => 'form-horizontal']) !!}
                            {!! Form::hidden('mail_template_id', $MailTemplate->id) !!}
                            {!! Form::hidden('id', $row->id) !!}

                            @include('common.form.delivery_set', ['mode' => 'edit'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        /**
         * Delete a record.
         */
         function deleteRecord(url) {
             if( confirm('本当に削除しますか？') ) {
                 var form = document.getElementById('delete-form');
                 form.action = url;
                 form.submit();
             }
         }
    </script>
@endsection
