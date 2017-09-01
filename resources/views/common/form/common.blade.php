<!-- Logout -->
{!! Form::open(['id' => 'logout-form', 'url' => route('logout'), 'method' => 'post', 'style' => 'display: none;']) !!}
{!! Form::close() !!}

<!-- Delete -->
{!! form::open(['id' => 'delete-form', 'url' => '', 'method' => 'delete', 'style' => 'display: none;']) !!}
{!! form::close() !!}

<!-- Restore -->
{!! Form::open(['id' => 'restore-form', 'url' => '', 'method' => 'patch', 'style' => 'display: none;']) !!}
{!! Form::close() !!}
