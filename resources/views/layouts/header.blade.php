<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('home') }}">
                {{ config('app.name') }}

                @if( App::isDownForMaintenance() )
                    <small>
                        （<span class="glyphicon glyphicon-wrench"></span>メンテナンスモード）
                    </small>
                @endif
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                @if ( Auth::guest() )
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>&nbsp;GUEST <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-off"></span>&nbsp;ログイン</a></li>

                            @if( App::isLocal() )
                                <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-plus"></span>&nbsp;登録</a></li>
                            @endif
                        </ul>
                    </li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">
                                <span class="glyphicon glyphicon-user"></span>&nbsp;{{ Auth::user()->name }}&nbsp;さんとしてログインしています。
                            </li>

                            <li role="separator" class="divider"></li>

                            <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span>&nbsp;ホーム</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-edit"></span>&nbsp;アカウント情報編集</a></li>

                            <li role="separator" class="divider"></li>

                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <span class="glyphicon glyphicon-off"></span>&nbsp;ログアウト
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>