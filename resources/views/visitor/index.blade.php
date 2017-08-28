@extends('layouts.base')

@section('meta')
    <title>来場者一覧｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 12, 'offset' => 0])

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="lead"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;来場者一覧</div>

                @include('flash::message')

                {!! $results->render() !!}

                @if( $results->count() )
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-condensed">
                            <colgroup>
                                <col width="5%">
                                <col width="23%">
                                <col width="10%">
                                <col width="15%">
                                <col width="11%">
                                <col width="11%">
                                <col width="15%">
                                <col width="5%">
                                <col width="5%">
                            </colgroup>

                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">メールアドレス</th>
                                <th class="text-center">氏名</th>
                                <th class="text-center">組織名</th>
                                <th class="text-center">部署名</th>
                                <th class="text-center">役職</th>
                                <th class="text-center">更新日時</th>
                                <th class="text-center">編集</th>
                                <th class="text-center">削除</th>
                            </tr>

                            @foreach($results as $result)
                                <tr <?php if( $result->deleted_at ) :?> style="background-color: #bbb;"<?php endif;?>>
                                    <td class="text-center">{{ $result->id }}</td>
                                    <td class="text-center">
                                        @if( $result->deleted_at )
                                            {{ $result->email }}
                                        @elseif( $result->email )
                                            <code>{{ $result->email }}</code>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( $result->deleted_at )
                                            {{ $result->name }}
                                        @elseif( $result->name )
                                            <a href="{{ route('visitor.edit', $result->id) }}">{{ $result->name }}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $result->organization }}</td>
                                    <td class="text-center">{{ $result->department }}</td>
                                    <td class="text-center">{{ $result->position }}</td>
                                    <td class="text-center">{{ $result->updated_at }}</td>
                                    <td class="text-center">
                                        @if( ! $result->deleted_at )
                                            <a href="{{ route('visitor.edit', $result->id) }}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="編集"></span></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( $result->deleted_at )
                                            <a href="{{ route('visitor.restore', $result->id) }}" class="btn btn-sm btn-info" onclick="restoreRecord('{{ route('visitor.restore', $result->id) }}'); return false;">
                                                <span class="glyphicon glyphicon-repeat" aria-hidden="true" data-toggle="tooltip" title="復旧"></span>
                                            </a>
                                        @else
                                            <a href="{{ route('visitor.delete', $result->id) }}" class="btn btn-sm btn-danger" onclick="deleteRecord('{{ route('visitor.delete', $result->id) }}'); return false;">
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
