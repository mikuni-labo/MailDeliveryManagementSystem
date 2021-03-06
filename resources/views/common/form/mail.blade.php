<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
    <label for="subject" class="col-md-2 control-label">題名<span class="attention">*</span></label>

    <div class="col-md-9 form-control-static">
        {!! Form::textarea('subject', isset($row->subject) ? $row->subject : null, ['required', $mode === 'add' ? 'autofocus' : null, 'class' => 'form-control', 'id' => 'subject', 'maxlength' => '191', 'placeholder' => '', 'rows' => '1']) !!}

        @if( $errors->has('subject') )
            <span class="help-block"><strong>{{ $errors->first('subject') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('from') ? ' has-error' : '' }}">
    <label for="from" class="col-md-2 control-label">差出人<span class="attention">*</span></label>

    <div class="col-md-9 form-control-static">
        <select name="from" class="form-control" id="from" required>
            <option value="1" selected>
                {{ $MailComposer['from']['name'] }} &lt;{{ $MailComposer['from']['address'] }}&gt;
            </option>
        </select>

        @if( $errors->has('from') )
            <span class="help-block"><strong>{{ $errors->first('from') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
    <label for="content" class="col-md-2 control-label">本文<span class="attention">*</span></label>

    <div class="col-md-9 form-control-static">
        @foreach( $MailComposer['template_tags'] as $key => $val )
            <button type="button" class="btn btn-light btn-xs" id="{{ $key }}" onclick="insertTemplateTag('content', '[##{{ $key }}##]');">[##{{ $val }}##]</button>
        @endforeach

        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="tooltip" title="挿入タグはメール送信時に来場者情報に置き替わります。<br>未設定の場合は表示されません。"></span>

        {!! Form::textarea('content', isset($row->content) ? $row->content : null, ['required', $mode === 'add' ? 'autofocus' : null, 'class' => 'form-control mt-5', 'id' => 'content', 'maxlength' => '191', 'placeholder' => '', 'rows' => '9']) !!}

        @if( $errors->has('content') )
            <span class="help-block"><strong>{{ $errors->first('content') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-9 col-md-offset-2">
        <a href="javascript:history.back();" class="btn btn-default">戻る</a>
        <button type="submit" class="btn btn-primary">登録</button>

        @if( $mode === 'edit' )
            <a href="{{ route('mail.set', $row->id) }}" class="btn btn-success">配信セット一覧</a>
            <a href="{{ route('mail.delete', $row->id) }}" class="btn btn-danger" onclick="deleteRecord('{{ route('mail.delete', $row->id) }}'); return false;">削除</a>
        @endif
    </div>
</div>
