@extends('layouts.base')

@section('meta')
    <title>配信セット一覧｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 10, 'offset' => 1])

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="lead"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>&nbsp;配信セット一覧</div>

                @include('flash::message')

                @if( $results->count() )
                    {!! $results->render() !!}

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-condensed">
                            <colgroup>
                                <col width="9%">
                                <col width="12%">
                                <col width="44%">
                                <col width="6%">
                                <col width="17%">
                                <col width="4%">
                                <col width="4%">
                                <col width="4%">
                            </colgroup>

                            <tr>
                                <th class="text-center">セットID</th>
                                <th class="text-center">テンプレートID</th>
                                <th class="text-center">名称</th>
                                <th class="text-center">状態</th>
                                <th class="text-center">更新日時</th>
                                <th class="text-center">編集</th>
                                <th class="text-center">履歴</th>
                                <th class="text-center">削除</th>
                            </tr>

                            @foreach($results as $result)
                                <tr <?php if( $result->deleted_at || ! $result->status ) :?> style="background-color: #bbb;"<?php endif;?>>
                                    <td class="text-center">{{ $result->id }}</td>
                                    <td class="text-center">
                                        {{ $result->mail_template_id }}
                                    </td>
                                    <td class="text-center">
                                        @if( $result->deleted_at )
                                            {{ $result->name }}
                                        @else
                                            <a href="{{ route('mail.set.edit', [$result->mail_template_id, $result->id]) }}">{{ $result->name }}</a>
                                        @endif
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
                                            <a href="{{ route('mail.set.edit', [$templateId, $result->id]) }}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="編集"></span></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-send" data-toggle="tooltip" title="履歴"></span></a>
                                    </td>
                                    <td class="text-center">
                                        @if( $result->deleted_at )
                                            <a href="{{ route('mail.set.restore', [$templateId, $result->id]) }}" class="btn btn-sm btn-info" onclick="restoreRecord('{{ route('mail.set.restore', [$templateId, $result->id]) }}'); return false;">
                                                <span class="glyphicon glyphicon-repeat" aria-hidden="true" data-toggle="tooltip" title="復旧"></span>
                                            </a>
                                        @else
                                            <a href="{{ route('mail.set.delete', [$templateId, $result->id]) }}" class="btn btn-sm btn-danger" onclick="deleteRecord('{{ route('mail.set.delete', [$templateId, $result->id]) }}'); return false;">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="削除"></span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    {!! $results->render() !!}
                @else
                    <p>条件に一致するデータがありません...</p>
                @endif
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
