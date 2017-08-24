@extends('layouts.base')

@section('meta')
    <title>メールテンプレート一覧｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 10, 'offset' => 1])

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2 class="h2"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;メールテンプレート一覧</h2>

                @include('flash::message')

                @if(false){!! $results->render() !!}@endif

                @if( $results->count() )
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-condensed">
                            <colgroup>
                                <col width="10%">
                                <col width="20%">
                                <col width="20%">
                                <col width="30%">
                                <col width="10%">
                                <col width="10%">
                            </colgroup>

                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">題名</th>
                                <th class="text-center">差出人</th>
                                <th class="text-center">本文</th>
                                <th class="text-center">編集</th>
                                <th class="text-center">削除</th>
                            </tr>

                            @foreach($results as $result)
                                <tr <?php if( $result->deleted_at ) :?> style="background-color: #bbb;"<?php endif;?>>
                                    <td class="text-center">{{ $result->id }}</td>
                                    <td class="text-center">{{ $result->subject }}</td>
                                    <td class="text-center">{{ $result->from }}</td>
                                    <td class="text-left">{{ $result->content }}</td>
                                    <td class="text-center">
                                        @if( ! $result->deleted_at )
                                            <a href="{{ route('mail.edit', $result->id) }}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="編集"></span></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( $result->deleted_at )
                                            <a href="{{ route('mail.restore', $result->id) }}" class="btn btn-sm btn-info" data-toggle="confirmation" onclick="if(!confirm('復旧させますか?')) return false;">
                                            <span class="glyphicon glyphicon-repeat" data-toggle="tooltip" title="復旧"></span></a>
                                        @else
                                            <a href="{{ route('mail.delete', $result->id) }}" class="btn btn-sm btn-danger" data-toggle="confirmation" onclick="if(!confirm('本当に削除しますか?')) return false;">
                                            <span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="論理削除"></span></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @else
                    <p>条件に一致するデータがありません...</p>
                @endif

                @if(false){!! $results->render() !!}@endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        //
    </script>
@endsection
