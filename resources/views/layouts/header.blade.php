<nav class="navbar navbar-inverse navbar-fixed-top navbar-static-top">
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
                        （<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>メンテナンスモード）
                    </small>
                @endif
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @if( Auth::check() )
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;来場者管理&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('visitor') }}"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;来場者一覧</a></li>
                            <li><a href="{{ route('visitor.add') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;来場者登録</a></li>
                            <li><a href="{{ route('visitor.csv') }}"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>&nbsp;CSVアップロード</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;メール配信管理&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('mail') }}"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;テンプレート一覧</a></li>
                            <li><a href="{{ route('mail.add') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;テンプレート登録</a></li>
                            <li><a href="{{ route('mail.log') }}"><span class="glyphicon glyphicon-time" aria-hidden="true"></span>&nbsp;配信ログ一覧</a></li>
                        </ul>
                    </li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    @if( Auth::guest() )
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-th" aria-hidden="true"></span>&nbsp;GUEST <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;ログイン</a></li>

                            @if( App::isLocal() )
                                <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;登録</a></li>
                            @endif
                        </ul>
                    @else
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-th" aria-hidden="true"></span>&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;{{ Auth::user()->name }}&nbsp;としてログインしています。
                            </li>

                            <li role="separator" class="divider"></li>

                            <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;ホーム</a></li>
                            <li><a href="{{ route('modify') }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;アカウント編集</a></li>
                            <li><a href="{{ route('phpinfo') }}"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;phpinfo</a></li>

                            <li role="separator" class="divider"></li>

                            <li>
                                <a href="{{ route('logout') }}" onclick="return false;" id="logoutBtn">
                                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;ログアウト
                                </a>
                            </li>
                        </ul>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
