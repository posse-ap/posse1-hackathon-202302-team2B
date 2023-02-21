<html>
    <head>
        <meta http-equiv="content-type" charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ichiIchiban</title>
        <link href="{{  mix('/css/app.css') }}" rel="stylesheet">
        <script src="{{ mix('/js/app.js') }}"></script>

        @stack('scripts')
    </head>
    <body>
        @section('header')
            <nav class="navbar sticky-top navbar-expand-sm navbar-green mb-3">
                <a class="navbar-brand" href="{{ route('home') }}">IchiIchiban</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="material-icons icon-white">dehaze</i></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav4">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{  route('order') }}" class="nav-link"><i class="material-icons md-light cartColor">receipt</i>注文履歴</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{  route('cart') }}" class="nav-link"><i class="material-icons md-light cartColor">shopping_cart</i>カートに行く</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a href="{{  route('logout') }}" class="nav-link"><i class="material-icons md-light cartColor">exit_to_app</i>ログアウト</a>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a href="{{  route('login') }}" class="nav-link"><i class="material-icons md-light cartColor">input</i>ログイン</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>

            @if (session('flush.message') && session('flush.alert_type'))
                <div class="text-center alert alert-{{ session('flush.alert_type') }}" role="alert">
                    {{ session('flush.message') }}
                </div>
            @endif
        @show

        <div class="container">
            @yield('content')
        </div>

        @section('footer')
            <footer class="container pt-5 pb-3">
                <div class="row">
                    <div class="col-12 text-center text-muted">
                        Copyright(C)2019 個人名or会社名,Allright Reserved.
                    </div>
                </div>
            </footer>
        @show
    </body>
</html>