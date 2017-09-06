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

                @if( $result->count() )
                    {!! $result->render() !!}

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-condensed">
                            <colgroup>
                                <col width="10%">
                                <col width="24%">
                                <col width="33%">
                                <col width="15%">
                                <col width="10%">
                                <col width="4%">
                                <col width="4%">
                            </colgroup>

                            <tr>
                                <th class="text-center">テンプレートID</th>
                                <th class="text-center">題名</th>
                                <th class="text-center">差出人</th>
                                <th class="text-center">更新日時</th>
                                <th class="text-center">配信セット</th>
                                <th class="text-center">編集</th>
                                <th class="text-center">削除</th>
                            </tr>

                            @foreach( $result as $row )
                                <tr <?php if( $row->deleted_at ) :?> style="background-color: #bbb;"<?php endif;?>>
                                    <td class="text-center">
                                        @if( $row->deleted_at )
                                            {{ $row->id }}
                                        @else
                                            <a href="{{ route('mail.edit', $row->id) }}">{{ $row->id }}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $row->subject }}</td>
                                    <td class="text-center">
                                        @if( ! $row->deleted_at ) <code> @endif
                                            {{ $MailComposer['from']['name'] }} &lt;{{ $MailComposer['from']['address'] }}&gt;
                                        @if( ! $row->deleted_at ) </code> @endif
                                    </td>
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
                                            <a href="{{ route('mail.set', $row->id) }}" class="btn btn-sm btn-default">
                                                </span>&nbsp;<span class="badge">{{ $row->deliverySets()->count() }}</span>&nbsp;セット
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( ! $row->deleted_at )
                                            <a href="{{ route('mail.edit', $row->id) }}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="編集"></span></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( $row->deleted_at )
                                            <a href="{{ route('mail.restore', $row->id) }}" class="btn btn-sm btn-info" onclick="restoreRecord('{{ route('mail.restore', $row->id) }}'); return false;">
                                                <span class="glyphicon glyphicon-repeat" aria-hidden="true" data-toggle="tooltip" title="復旧"></span>
                                            </a>
                                        @else
                                            <a href="{{ route('mail.delete', $row->id) }}" class="btn btn-sm btn-danger" onclick="deleteRecord('{{ route('mail.delete', $row->id) }}'); return false;">
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
                var form = document.getElementById('patch-form');
                form.action = url;
                form.submit();
            }
        }
    </script>
@endsection
