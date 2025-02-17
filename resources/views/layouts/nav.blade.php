@php
    $pages = App\Page::all();
@endphp

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @foreach ($pages as $page)
                <li class="nav-item">
                    <a class="nav-link" href="/pages/{{ $page->name }}">{{ $page->title }}</a>
                </li>
                @endforeach
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                @inject('Cart', 'App\Cart')               
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">我的購物車
                        @if ($Cart->where('user_id','=',Auth::user()->id)->count() > 0)
                            <span class="badge badge-danger">{{ $Cart->where('user_id','=',Auth::user()->id)->count() }}</span>
                        @endif                     
                    </a>
                </li>
                @inject('Order', 'App\Order')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.index') }}">我的訂單
                        @if ($Order->where('user_id','=',Auth::user()->id)->count() > 0)
                            <span class="badge badge-warning">{{ $Order->where('user_id','=',Auth::user()->id)->where('closed','>',0)->count() }}</span>
                        @endif                      
                    </a>
                </li>
                @section('my_menu')
                <li class="nav-item">
                    <a class="nav-link" href="/">回首頁</a>
                </li>
                @show
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>