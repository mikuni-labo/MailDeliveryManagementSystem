@extends('layouts.base')

@section('meta')
    <title>配信セット一覧｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 12, 'offset' => 0])

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;テンプレート情報</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-condensed">
                                <colgroup>
                                    <col width="10%">
                                    <col width="23%">
                                    <col width="30%">
                                    <col width="4%">
                                    <col width="15%">
                                </colgroup>

                                <tr>
                                    <th class="text-center">テンプレートID</th>
                                    <th class="text-center">題名</th>
                                    <th class="text-center">差出人</th>
                                    <th class="text-center">状態</th>
                                    <th class="text-center">更新日時</th>
                                </tr>

                                <tr <?php if( $MailTemplate->deleted_at || ! $MailTemplate->status ) :?> style="background-color: #bbb;"<?php endif;?>>
                                    <td class="text-center">{{ $MailTemplate->id }}</td>
                                    <td class="text-center">
                                        @if( $MailTemplate->deleted_at )
                                            {{ $MailTemplate->subject }}
                                        @else
                                            <a href="{{ route('mail.edit', $MailTemplate->id) }}">{{ $MailTemplate->subject }}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( ! $MailTemplate->deleted_at && $MailTemplate->status ) <code> @endif
                                            {{ $MailComposer['from']['name'] }} &lt;{{ $MailComposer['from']['address'] }}&gt;
                                        @if( ! $MailTemplate->deleted_at ) </code> @endif
                                    </td>
                                    <td class="text-center">
                                        @if( $MailTemplate->status )
                                            <span class="text-success">有効</span>
                                        @else
                                            <span class="text-danger">無効</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $MailTemplate->updated_at }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="lead"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>&nbsp;配信セット一覧</div>

                @include('flash::message')

                @if( $result->count() )
                    {!! $result->render() !!}

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

                            @foreach( $result as $row )
                                <tr <?php if( $row->deleted_at || ! $row->status ) :?> style="background-color: #bbb;"<?php endif;?>>
                                    <td class="text-center">{{ $row->id }}</td>
                                    <td class="text-center">
                                        {{ $row->mail_template_id }}
                                    </td>
                                    <td class="text-center">
                                        @if( $row->deleted_at )
                                            {{ $row->name }}
                                        @else
                                            <a href="{{ route('mail.set.edit', [$row->mail_template_id, $row->id]) }}">{{ $row->name }}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( $row->status )
                                            <span class="text-success">有効</span>
                                        @else
                                            <span class="text-danger">無効</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $row->updated_at }}</td>
                                    <td class="text-center">
                                        @if( ! $row->deleted_at )
                                            <a href="{{ route('mail.set.edit', [$MailTemplate->id, $row->id]) }}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="編集"></span></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-send" data-toggle="tooltip" title="履歴"></span></a>
                                    </td>
                                    <td class="text-center">
                                        @if( $row->deleted_at )
                                            <a href="{{ route('mail.set.restore', [$MailTemplate->id, $row->id]) }}" class="btn btn-sm btn-info" onclick="restoreRecord('{{ route('mail.set.restore', [$MailTemplate->id, $row->id]) }}'); return false;">
                                                <span class="glyphicon glyphicon-repeat" aria-hidden="true" data-toggle="tooltip" title="復旧"></span>
                                            </a>
                                        @else
                                            <a href="{{ route('mail.set.delete', [$MailTemplate->id, $row->id]) }}" class="btn btn-sm btn-danger" onclick="deleteRecord('{{ route('mail.set.delete', [$MailTemplate->id, $row->id]) }}'); return false;">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="削除"></span>
                                            </a>
                                        @endif
                                    </td>
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
