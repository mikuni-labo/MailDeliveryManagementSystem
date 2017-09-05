<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-3 control-label">名称<span class="attention">*</span></label>

    <div class="col-md-8 form-control-static">
        {!! Form::textarea('name', isset($row->name) ? $row->name : null, ['required', $mode === 'add' ? 'autofocus' : null, 'class' => 'form-control', 'id' => 'name', 'maxlength' => '191', 'placeholder' => '', 'rows' => '1']) !!}

        @if( $errors->has('name') )
            <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
        @endif
    </div>
</div>

@if(false)
    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
        <label for="status" class="col-md-3 control-label">ステータス
            @if( $mode === 'add' || $mode === 'edit' ) <span class="attention">*</span>@endif
        </label>

        <div class="col-md-4 form-control-static">
            <label>{!! Form::radio('status', 1, true, ['required', 'class' => '', 'id' => '', 'maxlength' => '1']) !!} <span class="text-success">有効</span></label>&nbsp;&nbsp;&nbsp;
            <label>{!! Form::radio('status', 0, isset($row->status) && ! $row->status , ['required', 'class' => '', 'id' => '', 'maxlength' => '1']) !!} <span class="text-danger">無効</span></label>

            @if( $errors->has('status') )
                <span class="help-block"><strong>{{ $errors->first('status') }}</strong></span>
            @endif
        </div>
    </div>
@endif

<div class="form-group">
    <div class="col-md-8 col-md-offset-3">
        <a href="javascript:history.back();" class="btn btn-default">戻る</a>
        <button type="submit" class="btn btn-primary">送信</button>

        @if( $mode === 'edit' )
            <a href="{{ route('mail.set.delete', [$MailTemplate->id, $row->id]) }}" class="btn btn-danger" onclick="deleteRecord('{{ route('mail.set.delete', [$MailTemplate->id, $row->id]) }}'); return false;">削除</a>
        @endif
    </div>
</div>
