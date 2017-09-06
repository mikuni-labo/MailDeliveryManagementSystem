<!-- Logout -->
{!! Form::open(['id' => 'logout-form', 'url' => route('logout'), 'method' => 'post', 'style' => 'display: none;']) !!}
{!! Form::close() !!}

<!-- GET -->
{!! form::open(['id' => 'get-form', 'url' => '', 'method' => 'get', 'style' => 'display: none;']) !!}
{!! form::close() !!}

<!-- POST -->
{!! form::open(['id' => 'post-form', 'url' => '', 'method' => 'post', 'style' => 'display: none;']) !!}
{!! form::close() !!}

<!-- PUT -->
{!! Form::open(['id' => 'put-form', 'url' => '', 'method' => 'put', 'style' => 'display: none;']) !!}
{!! Form::close() !!}

<!-- DELETE -->
{!! form::open(['id' => 'delete-form', 'url' => '', 'method' => 'delete', 'style' => 'display: none;']) !!}
{!! form::close() !!}

<!-- PATCH -->
{!! Form::open(['id' => 'patch-form', 'url' => '', 'method' => 'patch', 'style' => 'display: none;']) !!}
{!! Form::close() !!}
