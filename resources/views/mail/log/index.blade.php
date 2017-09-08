@extends('layouts.base')

@section('meta')
    <title>配信履歴一覧｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 12, 'offset' => 0])

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="lead"><span class="glyphicon glyphicon-time" aria-hidden="true"></span>&nbsp;配信履歴一覧</div>

                @include('flash::message')

                @if( $result->count() )
                    {!! $result->render() !!}

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-condensed">
                            <colgroup>
                                <col width="6%">
                                <col width="15%">
                                <col width="10%">
                                <col width="8%">
                                <col width="32%">
                                <col width="25%">
                                <col width="4%">
                            </colgroup>

                            <tr>
                                <th class="text-center">ログID</th>
                                <th class="text-center">処理日時</th>
                                <th class="text-center">テンプレートID</th>
                                <th class="text-center">セットID</th>
                                <th class="text-center">題名</th>
                                <th class="text-center">差出人</th>
                                <th class="text-center">対象</th>
                            </tr>

                            @foreach( $result as $row )
                                <tr>
                                    <td class="text-center">{{ $row->id }}</td>
                                    <td class="text-center">{{ $row->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('mail.edit', $row->mail_template_id) }}">{{ $row->mail_template_id }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('mail.set.edit', [$row->mail_template_id, $row->delivery_set_id]) }}">{{ $row->delivery_set_id }}</a>
                                    </td>
                                    <td class="text-center">{{ $row->subject }}</td>
                                    <td class="text-center">
                                        <code>{{ $MailComposer['from']['name'] }} &lt;{{ $MailComposer['from']['address'] }}&gt;</code>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('mail.log.visitor', $row->id) }}" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-th-list" data-toggle="tooltip" title="配信対象"></span></a>
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
    <script type="text/javascript">
        //
    </script>
@endsection
