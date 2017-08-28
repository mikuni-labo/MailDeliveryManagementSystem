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
                                <col width="7%">
                                <col width="30%">
                                <col width="38%">
                                <col width="15%">
                                <col width="5%">
                                <col width="5%">
                            </colgroup>

                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">題名</th>
                                <th class="text-center">差出人</th>
                                <th class="text-center">更新日時</th>
                                <th class="text-center">編集</th>
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
                                    <td class="text-center">{{ $result->updated_at }}</td>
                                    <td class="text-center">
                                        @if( ! $result->deleted_at )
                                            <a href="{{ route('mail.edit', $result->id) }}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="編集"></span></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( $result->deleted_at )
                                            <a href="{{ route('mail.restore', $result->id) }}" onclick="event.preventDefault();" class="btn btn-sm btn-info" id="restoreBtn">
                                                <span class="glyphicon glyphicon-repeat" data-toggle="tooltip" title="復旧"></span>
                                            </a>
                                        @else
                                            <a href="{{ route('mail.delete', $result->id) }}" onclick="event.preventDefault();" class="btn btn-sm btn-danger" id="deleteBtn">
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
    @if(false)<script type="text/javascript" src="{{ mix('js/mail.js') }}"></script>@endif
    <script type="text/javascript">
        //
    </script>
@endsection
