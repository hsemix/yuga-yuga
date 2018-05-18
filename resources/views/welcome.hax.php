<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Welcome | {{ config('app.name', 'Yuga') }}</title>
  {{ css(['yuga/bootstrap/css/bootstrap.min.css', 'yuga/css/yuga.css']) }}
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand" href="<?=host('/')?>"><?=config('app.name', 'Yuga')?></a>
    <button class="navbar-toggler btn btn-primary" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="nav navbar-nav">
            <li><a href="{{ host('/') }}">Home</a></li>
            @if (Auth::authRoutesExist())
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @endif
            @endif
        </ul>
    </div>
  </nav>
  <div class="container">
    <div class="flex-center position full-height">
        <div class="content">
            <div class="title m-b-md">
            {{ config('app.name', 'Yuga Framework') }}, the only php mvvm framework
            </div>
        </div>
    </div>
  </div>
  <footer style="bottom: 0;">
    <p>Powered by Mahad Tech Solutions</p>
  </footer>
  {{ script(['yuga/js/jQuery/jquery-2.2.3.min.js', 'yuga/bootstrap/js/bootstrap.min.js']) }}
</body>

</html>