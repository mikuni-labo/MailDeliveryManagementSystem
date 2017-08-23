@extends('layouts.base')

@section('meta')
    <title>ホーム｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="jumbotron">
                @include('flash::message')

                @if( session('status') )
                    <?php // パスワードリセット時などの組み込み機能等はFlashパッケージ非使用のため、ひとまずsessionのstatusを表示している ?>
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <h1>Hello, world!</h1>
                <p>
                    This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.
                </p>
                <p>
                    <span class="label label-default">Default <span class="badge">1</span></span>
                    <span class="label label-primary">Primary <span class="badge">2</span></span>
                    <span class="label label-success">Success <span class="badge">3</span></span>
                    <span class="label label-info">Info <span class="badge">4</span></span>
                    <span class="label label-warning">Warning <span class="badge">5</span></span>
                    <span class="label label-danger">Danger <span class="badge">6</span></span>
                </p>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                    <span class="sr-only">70% Complete</span>
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

