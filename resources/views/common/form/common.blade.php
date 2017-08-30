<!-- Logout -->
{!! Form::open(['id' => 'logout-form', 'url' => route('logout'), 'method' => 'POST', 'style' => 'display: none;']) !!}{!! Form::close() !!}

<!-- Delete -->
{!! Form::open(['id' => 'delete-form', 'url' => '', 'method' => 'post', 'style' => 'display: none;']) !!}
    {!! Form::hidden('_method', 'DELETE', []) !!}
{!! Form::close() !!}

<!-- Restore -->
{!! Form::open(['id' => 'restore-form', 'url' => '', 'method' => 'post', 'style' => 'display: none;']) !!}
    {!! Form::hidden('_method', 'PATCH', []) !!}
{!! Form::close() !!}
