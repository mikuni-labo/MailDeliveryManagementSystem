@extends('layouts.base')

@section('meta')
    <title>ホーム｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">ホーム</div>

                    <div class="panel-body">
                        @include('flash::message')

                        @if( session('status') )
                            <?php // パスワードリセット時などの組み込み機能等はFlashパッケージ非使用のため、ひとまずsessionのstatusを表示している ?>
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        ダッシュボード
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

