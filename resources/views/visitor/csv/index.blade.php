@extends('layouts.base')

@section('meta')
    <title>来場者CSVアップロード｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 10, 'offset' => 1])

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading lead"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>&nbsp;来場者CSVアップロード</div>
                    <div class="panel-body">
                        @include('flash::message')

                        @if( $errors->count() && ! $errors->has('upload_csv') )
                            <div class="alert alert-danger">
                                @foreach( $errors->all() as $key => $error )
                                    @unless( $errors->has('valid_comuns') )
                                        <strong>{{ $key + 1 }}行目の{{ $error }}</strong><br>
                                    @else
                                        <strong>{{ $error }}</strong><br>
                                    @endunless
                                @endforeach
                            </div>
                        @endif

                        {!! Form::open(['url' => route('visitor.csv.upload'), 'files' => true, 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            <div class="form-group{{ $errors->has('upload_csv') ? ' has-error' : '' }}">
                                <label for="upload_csv" class="col-md-4 control-label">一括登録用CSV<span class="attention">*</span></label>

                                <div class="col-md-6 form-control-static">
                                    {!! Form::file('upload_csv', null, ['required', 'class' => 'form-control', 'id' => 'upload_csv']) !!}

                                    @if( $errors->has('upload_csv') )
                                        <span class="help-block"><strong>{{ $errors->first('upload_csv') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="javascript:history.back();" class="btn btn-default">戻る</a>
                                    <button type="submit" class="btn btn-primary">送信</button>
                                    @if(false)<button type="button" class="btn btn-warning" id="dl_sample_csv">雛形CSVダウンロード</button>@endif
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
