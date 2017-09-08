@extends('layouts.base')

@section('meta')
    <title>配信対象者一覧｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 12, 'offset' => 0])

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="lead"><span class="glyphicon glyphicon-time" aria-hidden="true"></span>&nbsp;配信対象者一覧</div>

                @include('flash::message')

                @if( $result->count() )
                    {!! $result->render() !!}

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-condensed">
                            <colgroup>
                                <col width="6%">
                                <col width="15%">
                                <col width="30%">
                                <col width="30%">
                                <col width="4%">
                                <col width="15%">
                            </colgroup>

                            <tr>
                                <th class="text-center">ログID</th>
                                <th class="text-center">配信日時</th>
                                <th class="text-center">配信先</th>
                                <th class="text-center">本文</th>
                                <th class="text-center">結果</th>
                                <th class="text-center">メッセージ</th>
                            </tr>

                            @foreach( $result as $row )
                                <tr>
                                    <td class="text-center">{{ $row->delivery_mail_log_id }}</td>
                                    <td class="text-center">{{ $row->created_at }}</td>
                                    <td class="text-center"><code>{{ $row->to }}</code></td>
                                    <td class="text-center">{{ $row->content }}</td>
                                    <td class="text-center">
                                        @if( $row->result )
                                            <span class="text-success">成功</span>
                                        @else
                                            <span class="text-danger">失敗</span>
                                        @endif
                                    <td class="text-center">{{ $row->message }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    {!! $result->render() !!}
                @else
                    <p>条件に一致するデータがありません...</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        //
    </script>
@endsection
