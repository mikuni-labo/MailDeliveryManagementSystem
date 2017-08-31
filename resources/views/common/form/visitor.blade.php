@if( $mode === 'edit' )
    {!! Form::hidden('id', $row->id, ['id' => 'id']) !!}
@endif

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">メールアドレス
        @if( $mode === 'add' || $mode === 'edit' ) <span class="attention">*</span>@endif
    </label>

    <div class="col-md-9">
        @if( $mode === 'search' )
            {!! Form::tel('email', isset($row->email) ? $row->email : null, ['class' => 'form-control', 'id' => 'email', 'maxlength' => '191', 'placeholder' => '']) !!}
        @else
            {!! Form::email('email', isset($row->email) ? $row->email : null, ['required', 'class' => 'form-control', 'id' => 'email', 'maxlength' => '191', 'placeholder' => '']) !!}
        @endif

        @if( $errors->has('email') )
            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">氏名</label>

    <div class="col-md-5 form-control-static">
        {!! Form::text('name', isset($row->name) ? $row->name : null, [$mode === 'add' ? 'autofocus' : null, 'class' => 'form-control', 'id' => 'name', 'maxlength' => '191', 'placeholder' => '']) !!}

        @if( $errors->has('name') )
            <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('organization') ? ' has-error' : '' }}">
    <label for="organization" class="col-md-2 control-label">組織名</label>

    <div class="col-md-9 form-control-static">
        {!! Form::textarea('organization', isset($row->organization) ? $row->organization : null, ['class' => 'form-control', 'id' => 'organization', 'maxlength' => '191', 'placeholder' => '', 'rows' => '1']) !!}

        @if( $errors->has('organization') )
            <span class="help-block"><strong>{{ $errors->first('organization') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
    <label for="department" class="col-md-2 control-label">部署名</label>

    <div class="col-md-7 form-control-static">
        {!! Form::text('department', isset($row->department) ? $row->department : null, ['class' => 'form-control', 'id' => 'department', 'maxlength' => '191', 'placeholder' => '']) !!}

        @if( $errors->has('department') )
            <span class="help-block"><strong>{{ $errors->first('department') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
    <label for="position" class="col-md-2 control-label">役職</label>

    <div class="col-md-5 form-control-static">
        {!! Form::text('position', isset($row->position) ? $row->position : null, ['class' => 'form-control', 'id' => 'position', 'maxlength' => '191', 'placeholder' => '']) !!}

        @if( $errors->has('position') )
            <span class="help-block"><strong>{{ $errors->first('position') }}</strong></span>
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
        {!! Form::textarea('address', isset($row->address) ? $row->address : null, ['class' => 'form-control', 'id' => 'address', 'maxlength' => '191', 'placeholder' => '', 'rows' => '2']) !!}

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

<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">ステータス
        @if( $mode === 'add' || $mode === 'edit' ) <span class="attention">*</span>@endif
    </label>

    <div class="col-md-4 form-control-static">
        @if( $mode === 'search' )
            <label for="status_on">{!! Form::checkbox('status_on', 1, isset($row->status_on), ['class' => '', 'id' => 'status_on', 'maxlength' => '1']) !!} <span class="text-success">有効</span></label>&nbsp;&nbsp;&nbsp;
            <label for="status_off">{!! Form::checkbox('status_off', 1, isset($row->status_off), ['class' => '', 'id' => 'status_off', 'maxlength' => '1']) !!} <span class="text-danger">無効</span></label>
        @else
            <label>{!! Form::radio('status', 1, true, ['required', 'class' => '', 'id' => '', 'maxlength' => '1']) !!} <span class="text-success">有効</span></label>&nbsp;&nbsp;&nbsp;
            <label>{!! Form::radio('status', 0, isset($row->status) && ! $row->status , ['required', 'class' => '', 'id' => '', 'maxlength' => '1']) !!} <span class="text-danger">無効</span></label>
        @endif

        @if( $errors->has('status') )
            <span class="help-block"><strong>{{ $errors->first('status') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('possible_delivery_flag') ? ' has-error' : '' }}">
    <label for="possible_delivery_flag" class="col-md-2 control-label">配信可否フラグ
        @if( $mode === 'add' || $mode === 'edit' ) <span class="attention">*</span>@endif
    </label>

    <div class="col-md-4 form-control-static">
        @if( $mode === 'search' )
            <label for="possible_delivery_flag_on">{!! Form::checkbox('possible_delivery_flag_on', 1, isset($row->possible_delivery_flag_on), ['class' => '', 'id' => 'possible_delivery_flag_on', 'maxlength' => '1']) !!} <span class="text-success">有効</span></label>&nbsp;&nbsp;&nbsp;
            <label for="possible_delivery_flag_off">{!! Form::checkbox('possible_delivery_flag_off', 1, isset($row->possible_delivery_flag_off), ['class' => '', 'id' => 'possible_delivery_flag_off', 'maxlength' => '1']) !!} <span class="text-danger">無効</span></label>
        @else
            <label>{!! Form::radio('possible_delivery_flag', 1, true, ['required', 'class' => '', 'id' => '', 'maxlength' => '1']) !!} <span class="text-success">有効</span></label>&nbsp;&nbsp;&nbsp;
            <label>{!! Form::radio('possible_delivery_flag', 0, isset($row->possible_delivery_flag) && ! $row->possible_delivery_flag , ['required', 'class' => '', 'id' => '', 'maxlength' => '1']) !!} <span class="text-danger">無効</span></label>
        @endif

        @if( $errors->has('possible_delivery_flag') )
            <span class="help-block"><strong>{{ $errors->first('possible_delivery_flag') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('exhibitor_type') ? ' has-error' : '' }}">
    <label for="exhibitor_type" class="col-md-2 control-label">出展者タイプ</label>

    <div class="col-md-5 form-control-static">
        <?php array_unshift( $FixtureComposer['visitor']['exhibitor_type'], '選択してください' ); ?>
        {!! Form::select('exhibitor_type', $FixtureComposer['visitor']['exhibitor_type'], isset($row->exhibitor_type) ? $row->exhibitor_type : null, ['class' => 'form-control', 'id' => 'exhibitor_type', 'maxlength' => '4']) !!}

        @if( $errors->has('exhibitor_type') )
            <span class="help-block"><strong>{{ $errors->first('exhibitor_type') }}</strong></span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('enterprise_type') ? ' has-error' : '' }}">
    <label for="enterprise_type" class="col-md-2 control-label">企業タイプ</label>

    <div class="col-md-5 form-control-static">
        <?php array_unshift( $FixtureComposer['visitor']['enterprise_type'], '選択してください' ); ?>
        {!! Form::select('enterprise_type', $FixtureComposer['visitor']['enterprise_type'], isset($row->enterprise_type) ? $row->enterprise_type : null, ['class' => 'form-control', 'id' => 'enterprise_type', 'maxlength' => '4']) !!}

        @if( $errors->has('enterprise_type') )
            <span class="help-block"><strong>{{ $errors->first('enterprise_type') }}</strong></span>
        @endif
    </div>
</div>

@if( $mode === 'search' && App::isLocal() )
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

        @if( $mode === 'edit' )
            <a href="#" class="btn btn-warning">配信履歴</a>
            <a href="{{ route('visitor.delete', $row->id) }}" class="btn btn-danger" onclick="deleteRecord('{{ route('visitor.delete', $row->id) }}'); return false;">削除</a>
        @endif

        @if( $mode === 'search' )
            <a href="{{ route('visitor.search.reset') }}" class="btn btn-danger" data-toggle="confirmation" onclick="if(!confirm('検索条件をリセットしますか?')) return false;">検索条件リセット</a>
        @endif
    </div>
</div>
