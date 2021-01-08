<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{ HtmlHelper::activeClass('tasks.index') }}"
                       href="{{ route('tasks.index') }}">{{ __('tasks.top-nav-label') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ HtmlHelper::activeClass('task_statuses.index') }}"
                       href="{{ route('task_statuses.index') }}">{{ __('task_statuses.top-nav-label') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ HtmlHelper::activeClass('labels.index') }}"
                       href="{{ route('labels.index') }}">{{ __('labels.top-nav-label') }}</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            {!! Form::open(['route' => 'logout', 'id' => 'logout-form', 'class' => 'd-none']) !!}
                            {!! Form::close() !!}
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
