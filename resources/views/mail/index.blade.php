@extends('layouts.base')

@section('meta')
    <title>テンプレート一覧｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 12, 'offset' => 0])

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="lead"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;テンプレート一覧</div>

                @include('flash::message')

                {!! $results->render() !!}

                @if( $results->count() )
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-condensed">
                            <colgroup>
                                <col width="8%">
                                <col width="27%">
                                <col width="34%">
                                <col width="4%">
                                <col width="15%">
                                <col width="4%">
                                <col width="4%">
                                <col width="4%">
                            </colgroup>

                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">題名</th>
                                <th class="text-center">差出人</th>
                                <th class="text-center">状態</th>
                                <th class="text-center">更新日時</th>
                                <th class="text-center">編集</th>
                                <th class="text-center">配信</th>
                                <th class="text-center">削除</th>
                            </tr>

                            @foreach($results as $result)
                                <tr <?php if( $result->deleted_at ) :?> style="background-color: #bbb;"<?php endif;?>>
                                    <td class="text-center">{{ $result->id }}</td>
                                    <td class="text-center">
                                        @if( $result->deleted_at )
                                            {{ $result->subject }}
                                        @else
                                            <a href="{{ route('mail.edit', $result->id) }}">{{ $result->subject }}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( ! $result->deleted_at ) <code> @endif
                                            {{ $MailComposer['from']['name'] }} &lt;{{ $MailComposer['from']['address'] }}&gt;
                                        @if( ! $result->deleted_at ) </code> @endif
                                    </td>
                                    <td class="text-center">
                                        @if( $result->status )
                                            <span class="text-success">有効</span>
                                        @else
                                            <span class="text-danger">無効</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $result->updated_at }}</td>
                                    <td class="text-center">
                                        @if( ! $result->deleted_at )
                                            <a href="{{ route('mail.edit', $result->id) }}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="編集"></span></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('mail.set', $result->id) }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-inbox" data-toggle="tooltip" title="配信セット"></span></a>
                                    </td>
                                    <td class="text-center">
                                        @if( $result->deleted_at )
                                            <a href="{{ route('mail.restore', $result->id) }}" class="btn btn-sm btn-info" onclick="restoreRecord('{{ route('mail.restore', $result->id) }}'); return false;">
                                                <span class="glyphicon glyphicon-repeat" aria-hidden="true" data-toggle="tooltip" title="復旧"></span>
                                            </a>
                                        @else
                                            <a href="{{ route('mail.delete', $result->id) }}" class="btn btn-sm btn-danger" onclick="deleteRecord('{{ route('mail.delete', $result->id) }}'); return false;">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="削除"></span>
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
    <script type="text/javascript" src="{{ mix('js/mail.js') }}"></script>
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

        /**
         * Restore a record.
         */
        function restoreRecord(url) {
            if( confirm('本当に復旧しますか？') ) {
                var form = document.getElementById('restore-form');
                form.action = url;
                form.submit();
            }
        }
    </script>
@endsection
