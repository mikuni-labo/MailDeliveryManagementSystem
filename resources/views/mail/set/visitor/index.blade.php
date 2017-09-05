@extends('layouts.base')

@section('meta')
    <title>配信セット来場者一覧｜{{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="container">
        @include('common.parts.breadcrumb', ['width' => 12, 'offset' => 0])

        @include('common.parts.template')

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="lead"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;配信セット来場者一覧</div>

                @include('flash::message')

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;検索&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="dummy_link" id="search_toggle"><small><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;選択エリアを表示する</small></a>
                    </div>

                    <div class="panel-body" id="search_area">
                        {!! Form::open(['url' => route('mail.set.visitor', [$MailTemplate->id, $DeliverySet->id]), 'method' => 'get', 'class' => 'form-horizontal']) !!}
                            @include('common.form.visitor', ['mode' => 'delivery_set_search'])
                        {!! Form::close() !!}
                    </div>
                </div>

                @if( $result->count() )
                    {!! $result->render() !!}

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-condensed">
                            <colgroup>
                                <col width="5%">
                                <col width="5%">
                                <col width="23%">
                                <col width="11%">
                                <col width="12%">
                                <col width="11%">
                                <col width="11%">
                                <col width="4%">
                                <col width="4%">
                                <col width="14%">
                            </colgroup>

                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">配信</th>
                                <th class="text-center">メールアドレス</th>
                                <th class="text-center">氏名</th>
                                <th class="text-center">組織名</th>
                                <th class="text-center">部署名</th>
                                <th class="text-center">役職</th>
                                <th class="text-center">状態</th>
                                <th class="text-center">配信</th>
                                <th class="text-center">更新日時</th>
                            </tr>

                            @foreach( $result as $row )
                                <tr <?php if( $row->deleted_at || ! $row->status ) :?> style="background-color: #bbb;"<?php endif;?>>
                                    <td class="text-center">
                                        @if( $row->deleted_at )
                                            {{ $row->id }}
                                        @elseif( $row->id )
                                            <a href="{{ route('visitor.edit', $row->id) }}">{{ $row->id }}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {!! Form::checkbox("target[$row->id]", 1, in_array($row->id, $DeliverySet->data), []) !!}
                                    </td>
                                    <td class="text-center">
                                        @if( $row->deleted_at || ! $row->status )
                                            {{ $row->email }}
                                        @elseif( $row->email )
                                            <code>{{ $row->email }}</code>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $row->name }}</td>
                                    <td class="text-center">{{ $row->organization }}</td>
                                    <td class="text-center">{{ $row->department }}</td>
                                    <td class="text-center">{{ $row->position }}</td>
                                    <td class="text-center">
                                        @if( $row->status )
                                            <span class="text-success">有効</span>
                                        @else
                                            <span class="text-danger">無効</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( $row->possible_delivery_flag )
                                            <span class="text-success">可</span>
                                        @else
                                            <span class="text-danger">不可</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $row->updated_at }}</td>
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
    <script type="text/javascript" src="{{ mix('js/visitor.js') }}"></script>
    <script type="text/javascript">
        //
    </script>
@endsection
