@extends('layouts.base')

@section('meta')
    <title>メールテンプレート一覧｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 10, 'offset' => 1])

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="lead"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;テンプレート一覧</div>

                @include('flash::message')

                {!! $results->render() !!}

                @if( $results->count() )
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-condensed">
                            <colgroup>
                                <col width="8%">
                                <col width="25%">
                                <col width="25%">
                                <col width="15%">
                                <col width="15%">
                                <col width="6%">
                                <col width="6%">
                            </colgroup>

                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">題名</th>
                                <th class="text-center">差出人</th>
                                <th class="text-center">登録日時</th>
                                <th class="text-center">更新日時</th>
                                <th class="text-center">編集</th>
                                <th class="text-center">削除</th>
                            </tr>

                            @foreach($results as $result)
                                <tr <?php if( $result->deleted_at ) :?> style="background-color: #bbb;"<?php endif;?>>
                                    <td class="text-center">{{ $result->id }}</td>
                                    <td class="text-center">
                                        @if( ! $result->deleted_at )
                                            <a href="{{ route('mail.edit', $result->id) }}">{{ $result->subject }}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $result->from }}</td>
                                    <td class="text-center">{{ $result->created_at }}</td>
                                    <td class="text-center">{{ $result->updated_at }}</td>
                                    <td class="text-center">
                                        @if( $result->deleted_at )
                                            <a href="{{ route('mail.edit', $result->id) }}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="編集"></span></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( ! $result->deleted_at )
                                            <a href="{{ route('mail.restore', $result->id) }}" class="btn btn-sm btn-info" onclick="event.preventDefault(); restoreForm('{{ route('mail.restore', $result->id) }}');">
                                                <span class="glyphicon glyphicon-repeat" data-toggle="tooltip" title="復旧"></span>
                                            </a>
                                        @else
                                            <a href="{{ route('mail.delete', $result->id) }}" class="btn btn-sm btn-danger" onclick="event.preventDefault(); deleteForm('{{ route('mail.delete', $result->id) }}');">
                                                <span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="削除"></span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @else
                    <p>条件に一致するデータがありません...</p>
                @endif

                {!! $results->render() !!}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        /**
         * レコード削除
         */
        function deleteForm(url, form, msg){
            if( confirm('本当に削除しますか？') ) {
                var form = document.getElementById('');
                form.action = url;
                form.submit();
            }
        };

        /**
         * レコード復旧
         */
        function restoreForm(url){
            if( confirm('本当に復旧させますか？') ) {
                var form = document.getElementById('restore-form');
                form.action = url;
                form.submit();
            }
        };
    </script>
@endsection
