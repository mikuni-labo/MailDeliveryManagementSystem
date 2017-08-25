@if( $mode === 'edit' )
    {!! Form::hidden('id', $row->id, ['id' => 'id']) !!}
@endif

<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
    <label for="subject" class="col-md-2 control-label">題名</label>

    <div class="col-md-9 form-control-static">
        {!! Form::textarea('subject', isset($row->subject) ? $row->subject : null, ['required', $mode === 'add' ? 'autofocus' : null, 'class' => 'form-control', 'id' => 'subject', 'maxlength' => '255', 'placeholder' => '', 'rows' => '1']) !!}

        @if( $errors->has('subject') )
            <span class="help-block"><strong>{{ $errors->first('subject') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('from') ? ' has-error' : '' }}">
    <label for="from" class="col-md-2 control-label">差出人</label>

    <div class="col-md-9 form-control-static">
        <select name="from" class="form-control" id="from">
            <option value="1"<?php if($mode === 'edit'): ?> selected="selected"<?php endif; ?>>
                <code>{{ $MailComposer['from']['name'] }} &lt;{{ $MailComposer['from']['address'] }}&gt;</code>
            </option>
        </select>

        @if(false)
            // 調整中
            {!! Form::select('from', isset($row->from) ? $row->from : null, ['required', 'class' => 'form-control', 'id' => 'from', 'maxlength' => '255', 'placeholder' => '']) !!}
        @endif

        @if( $errors->has('from') )
            <span class="help-block"><strong>{{ $errors->first('from') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
    <label for="content" class="col-md-2 control-label">本文</label>

    <div class="col-md-9 form-control-static">
        {!! Form::textarea('content', isset($row->content) ? $row->content : null, ['required', $mode === 'add' ? 'autofocus' : null, 'class' => 'form-control', 'id' => 'content', 'maxlength' => '255', 'placeholder' => '', 'rows' => '9']) !!}

        @if( $errors->has('content') )
            <span class="help-block"><strong>{{ $errors->first('content') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-9 col-md-offset-2">
        <a href="javascript:history.back();" class="btn btn-default">戻る</a>
        <button type="submit" class="btn btn-primary">送信</button>
    </div>
</div>
