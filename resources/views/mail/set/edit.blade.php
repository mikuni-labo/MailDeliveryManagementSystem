@extends('layouts.base')

@section('meta')
    <title>配信セット編集｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 8, 'offset' => 2])

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-warning">
                    <div class="panel-heading lead"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;配信セット編集</div>
                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['url' => route('mail.set.edit', [$templateId, $row->id]), 'method' => 'put', 'class' => 'form-horizontal']) !!}
                            {!! Form::hidden('mail_template_id', $templateId) !!}
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
