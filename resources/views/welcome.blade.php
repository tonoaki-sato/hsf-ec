<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 40px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">ログイン</a>
                        <a href="{{ route('register') }}">利用登録</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="text-danger">
                    @if (Session::has('message') === true)
                    	{{ session('message') }}
                    @else
                    	&nbsp;
                    @endif
                </div>

                <div class="title m-b-md">
                    保土ケ谷宿場まつり<br />実行委員会
                </div>

                <div class="links">
                  <ul class="list-inline">
                    <li><a href="http://syukuba.net/" target="_blank"><strong>公式ホームページ</strong></a></li>
                    <li><a href="https://www.facebook.com/hodogayasyukubafest/" target="_blank"><strong>Facebook</strong></a></li>
                    <li><a href="https://ameblo.jp/komachi-hodogaya/" target="_blank"><strong>小町のブログ</strong></a></li>
                    <li><a href="https://www.instagram.com/shukubakun/" target="_blank"><strong>宿場くんInstagram</strong></a></li>
                    <li><a href="https://twitter.com/shukubakun" target="_blank"><strong>宿場くんTwitter</strong></a></li>
                  </ul>
                </div>
            </div>
        </div>
    </body>
</html>
