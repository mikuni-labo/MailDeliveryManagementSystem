<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;テンプレート情報</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-condensed">
                        <colgroup>
                            <col width="10%">
                            <col width="28%">
                            <col width="34%">
                            <col width="16%">
                            <col width="12%">
                        </colgroup>

                        <tr>
                            <th class="text-center">テンプレートID</th>
                            <th class="text-center">題名</th>
                            <th class="text-center">差出人</th>
                            <th class="text-center">更新日時</th>
                            <th class="text-center">配信セット登録</th>
                        </tr>

                        <tr <?php if( $MailTemplate->deleted_at ) :?> style="background-color: #bbb;"<?php endif;?>>
                            <td class="text-center">
                                @if( $MailTemplate->deleted_at )
                                    {{ $MailTemplate->id }}
                                @else
                                    <a href="{{ route('mail.edit', $MailTemplate->id) }}">{{ $MailTemplate->id }}</a>
                                @endif
                            </td>
                            <td class="text-center">{{ $MailTemplate->subject }}</td>
                            <td class="text-center">
                                @if( ! $MailTemplate->deleted_at ) <code> @endif
                                    {{ $MailComposer['from']['name'] }} &lt;{{ $MailComposer['from']['address'] }}&gt;
                                @if( ! $MailTemplate->deleted_at ) </code> @endif
                            </td>
                            <td class="text-center">{{ $MailTemplate->updated_at }}</td>
                            <td class="text-center">
                                <a href="{{ route('mail.set.add', $MailTemplate->id) }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus" data-toggle="tooltip" title="登録"></span></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
