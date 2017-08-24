<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">ログイン名</label>

    <div class="col-md-6">
        {!! Form::text('name', isset($row->name) ? $row->name : null, ['required', $mode === 'add' ? 'autofocus' : null, 'class' => 'form-control', 'id' => 'name', 'maxlength' => '255', 'placeholder' => '']) !!}

        @if( $errors->has('name') )
            <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-4 control-label">メールアドレス</label>

    <div class="col-md-6">
        {!! Form::email('email', isset($row->email) ? $row->email : null, ['required', 'class' => 'form-control', 'id' => 'email', 'maxlength' => '255', 'placeholder' => '']) !!}

        @if( $errors->has('email') )
            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="col-md-4 control-label">パスワード</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control" name="password" maxlength="255" placeholder="{{ $mode === 'edit' ? '変更する場合のみ入力してください。' : '' }}" {{ $mode === 'add' ? 'required' : '' }} />

        @if( $errors->has('password') )
            <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="password-confirm" class="col-md-4 control-label">パスワード（確認）</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" maxlength="255" placeholder="{{ $mode === 'edit' ? '変更する場合のみ入力してください。' : '' }}" {{ $mode === 'add' ? 'required' : '' }} />

        @if( $errors->has('password_confirmation') )
            <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">送信</button>
    </div>
</div>
