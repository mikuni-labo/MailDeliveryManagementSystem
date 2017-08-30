@if( $mode === 'edit' )
    {!! Form::hidden('id', $row->id, ['id' => 'id']) !!}
@endif

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">氏名</label>

    <div class="col-md-9 form-control-static">
        {!! Form::text('name', isset($row->name) ? $row->name : null, [$mode === 'add' ? 'autofocus' : null, 'class' => 'form-control', 'id' => 'name', 'maxlength' => '255', 'placeholder' => '']) !!}

        @if( $errors->has('name') )
            <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('organization') ? ' has-error' : '' }}">
    <label for="organization" class="col-md-2 control-label">組織名</label>

    <div class="col-md-9 form-control-static">
        {!! Form::textarea('organization', isset($row->organization) ? $row->organization : null, ['class' => 'form-control', 'id' => 'organization', 'maxlength' => '255', 'placeholder' => '', 'rows' => '1']) !!}

        @if( $errors->has('organization') )
            <span class="help-block"><strong>{{ $errors->first('organization') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
    <label for="department" class="col-md-2 control-label">部署名</label>

    <div class="col-md-9 form-control-static">
        {!! Form::text('department', isset($row->department) ? $row->department : null, ['class' => 'form-control', 'id' => 'department', 'maxlength' => '255', 'placeholder' => '']) !!}

        @if( $errors->has('department') )
            <span class="help-block"><strong>{{ $errors->first('department') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
    <label for="position" class="col-md-2 control-label">役職</label>

    <div class="col-md-9 form-control-static">
        {!! Form::text('position', isset($row->position) ? $row->position : null, ['class' => 'form-control', 'id' => 'position', 'maxlength' => '255', 'placeholder' => '']) !!}

        @if( $errors->has('position') )
            <span class="help-block"><strong>{{ $errors->first('position') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">メールアドレス
        @if( $mode === 'add' || $mode === 'edit' ) <span class="attention">*</span>@endif
    </label>

    <div class="col-md-9">
        @if( $mode === 'search' )
            {!! Form::tel('email', isset($row->email) ? $row->email : null, ['class' => 'form-control', 'id' => 'email', 'maxlength' => '255', 'placeholder' => '']) !!}
        @else
            {!! Form::email('email', isset($row->email) ? $row->email : null, ['required', 'class' => 'form-control', 'id' => 'email', 'maxlength' => '255', 'placeholder' => '']) !!}
        @endif

        @if( $errors->has('email') )
            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('postcode') ? ' has-error' : '' }}">
    <label for="postcode" class="col-md-2 control-label">郵便番号</label>

    <div class="col-md-3 form-control-static">
        {!! Form::tel('postcode', isset($row->postcode) ? $row->postcode : null, ['class' => 'form-control', 'id' => 'postcode', 'maxlength' => '7', 'placeholder' => 'ハイフンは省略']) !!}

        @if( $errors->has('postcode') )
            <span class="help-block"><strong>{{ $errors->first('postcode') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
    <label for="address" class="col-md-2 control-label">住所</label>

    <div class="col-md-9 form-control-static">
        {!! Form::textarea('address', isset($row->address) ? $row->address : null, ['class' => 'form-control', 'id' => 'address', 'maxlength' => '255', 'placeholder' => '', 'rows' => '2']) !!}

        @if( $errors->has('address') )
            <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
    <label for="tel" class="col-md-2 control-label">TEL</label>

    <div class="col-md-4 form-control-static">
        {!! Form::tel('tel', isset($row->tel) ? $row->tel : null, ['class' => 'form-control', 'id' => 'tel', 'maxlength' => '15', 'placeholder' => 'ハイフンは省略']) !!}

        @if( $errors->has('tel') )
            <span class="help-block"><strong>{{ $errors->first('tel') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
    <label for="fax" class="col-md-2 control-label">FAX</label>

    <div class="col-md-4 form-control-static">
        {!! Form::tel('fax', isset($row->fax) ? $row->fax : null, ['class' => 'form-control', 'id' => 'fax', 'maxlength' => '15', 'placeholder' => 'ハイフンは省略']) !!}

        @if( $errors->has('fax') )
            <span class="help-block"><strong>{{ $errors->first('fax') }}</strong></span>
        @endif
    </div>
</div>

@if( $mode === 'search' )
    <div class="form-group">
        <div class="col-md-4 col-md-offset-2 form-control-static">
            <label>{!! Form::checkbox('with_trashed', 1, isset($row->with_trashed), []) !!} 削除済みデータを表示</label>
        </div>
    </div>
@endif

<div class="form-group">
    <div class="col-md-9 col-md-offset-2">
        <a href="javascript:history.back();" class="btn btn-default">戻る</a>
        <button type="submit" class="btn btn-primary">送信</button>

        @if( $mode === 'search' )
            <a href="{{ route('visitor.search.reset') }}" class="btn btn-danger" data-toggle="confirmation" onclick="if(!confirm('検索条件をリセットしますか?')) return false;">検索条件リセット</a>
        @endif
    </div>
</div>
