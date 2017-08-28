@extends('layouts.base')

@section('meta')
    <title>テンプレート登録｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 10, 'offset' => 1])

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading lead"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;テンプレート登録</div>
                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['url' => route('mail.add'), 'method' => 'post', 'class' => 'form-horizontal', ]) !!}
                            @include('common.form.mail', ['mode' => 'add'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ mix('js/mail.js') }}"></script>
    <script type="text/javascript">
        /**
         * テンプレートタグを挿入
         *
         * @param string fieldtId
         * @param string tag
         */
        function insertTemplateTag(fieldtId, tag) {
            	var fieldt   = document.getElementById(fieldtId);

            	var sentence = fieldt.value;
            	var len      = sentence.length;
            	var pos      = fieldt.selectionStart;

            	var before   = sentence.substr(0, pos);
            	var word     = tag;
            	var after    = sentence.substr(pos, len);

            	sentence     = before + word + after;

            	fieldt.value = sentence;
            	fieldt.focus();
        }
    </script>
@endsection
