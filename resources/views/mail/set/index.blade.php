@extends('layouts.base')

@section('meta')
    <title>配信セット一覧｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 12, 'offset' => 0])

        @include('common.parts.template')

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
                                <col width="10%">
                                <col width="40%">
                                <col width="15%">
                                <col width="10%">
                                <col width="4%">
                                <col width="4%">
                                <col width="4%">
                                <col width="4%">
                            </colgroup>

                            <tr>
                                <th class="text-center">セットID</th>
                                <th class="text-center">テンプレートID</th>
                                <th class="text-center">名称</th>
                                <th class="text-center">更新日時</th>
                                <th class="text-center">来場者</th>
                                <th class="text-center">配信</th>
                                <th class="text-center">編集</th>
                                <th class="text-center">履歴</th>
                                <th class="text-center">削除</th>
                            </tr>

                            @foreach( $result as $row )
                                <tr <?php if( $row->deleted_at ) :?> style="background-color: #bbb;"<?php endif;?>>
                                    <td class="text-center">
                                        @if( $row->deleted_at )
                                            {{ $row->id }}
                                        @else
                                            <a href="{{ route('mail.set.edit', [$row->mail_template_id, $row->id]) }}">{{ $row->id }}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( $MailTemplate->deleted_at )
                                            {{ $MailTemplate->id }}
                                        @else
                                            <a href="{{ route('mail.edit', $MailTemplate->id) }}">{{ $MailTemplate->id }}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $row->name }}</td>
                                    @if(false)
                                        <td class="text-center">
                                            @if( $row->status )
                                                <span class="text-success">有効</span>
                                            @else
                                                <span class="text-danger">無効</span>
                                            @endif
                                        </td>
                                    @endif
                                    <td class="text-center">{{ $row->updated_at }}</td>
                                    <td class="text-center">
                                        @if( ! $row->deleted_at )
                                            <a href="{{ route('mail.set.visitor', [$MailTemplate->id, $row->id]) }}" class="btn btn-sm btn-default">
                                                </span>&nbsp;<span class="badge">{{ $row->deliverySetVisitors()->count() }}</span>&nbsp;名
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( ! $row->deleted_at )
                                            <a href="{{ route('mail.set.delivery', [$MailTemplate->id, $row->id]) }}" class="btn btn-sm btn-primary" <?php if( $row->deliverySetVisitors()->count() ):?>onclick="deliveryMail('{{ route('mail.set.delivery', [$MailTemplate->id, $row->id]) }}'); return false;"<?php else:?>onclick="return false;" disabled<?php endif;?>>
                                                <span class="glyphicon glyphicon-send" data-toggle="tooltip" title="メール配信"></span>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( ! $row->deleted_at )
                                            <a href="{{ route('mail.set.edit', [$MailTemplate->id, $row->id]) }}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="編集"></span></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-warning" <?php if( ! $row->deliveryMailLogs->count() ):?>onclick="return false;" disabled<?php endif;?>>
                                            <span class="glyphicon glyphicon-time" data-toggle="tooltip" title="配信履歴"></span>
                                        </a>
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
         function deliveryMail(url) {
             if( confirm('本当に送信しますか？') ) {
                 var form = document.getElementById('post-form');
                 form.action = url;
                 form.submit();
             }
         }

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
                var form = document.getElementById('patch-form');
                form.action = url;
                form.submit();
            }
        }
    </script>
@endsection
