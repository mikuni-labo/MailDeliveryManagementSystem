@if( $mode === 'edit' )
    {!! Form::hidden('id', $row->id, ['id' => 'id']) !!}
@endif

<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
    <label for="subject" class="col-md-4 control-label">題名</label>

    <div class="col-md-6 form-control-static">
        {!! Form::textarea('subject', isset($row->subject) ? $row->subject : null, ['required', $mode === 'add' ? 'autofocus' : null, 'class' => 'form-control', 'id' => 'subject', 'maxlength' => '255', 'placeholder' => '', 'rows' => '2']) !!}

        @if( $errors->has('subject') )
            <span class="help-block"><strong>{{ $errors->first('subject') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('from') ? ' has-error' : '' }}">
    <label for="from" class="col-md-4 control-label">差出人</label>

    <div class="col-md-6 form-control-static">
        調整中
        @if(false)
            {!! Form::from('from', isset($row->from) ? $row->from : null, ['required', 'class' => 'form-control', 'id' => 'from', 'maxlength' => '255', 'placeholder' => '']) !!}
        @endif

        @if( $errors->has('from') )
            <span class="help-block"><strong>{{ $errors->first('from') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
    <label for="content" class="col-md-4 control-label">本文</label>

    <div class="col-md-6 form-control-static">
        {!! Form::textarea('content', isset($row->content) ? $row->content : null, ['required', $mode === 'add' ? 'autofocus' : null, 'class' => 'form-control', 'id' => 'content', 'maxlength' => '255', 'placeholder' => '', 'rows' => '9']) !!}

        @if( $errors->has('content') )
            <span class="help-block"><strong>{{ $errors->first('content') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">送信</button>
    </div>
</div>
