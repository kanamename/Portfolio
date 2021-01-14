<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Select Shop TOKYO</title>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <!-- トースト -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  @yield('styles')

  <!-- css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- トースト -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>

<body>
  <header class="mb-5">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top px-5">
      <a class="navbar-brand" href="/">Select Shop TOKYO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      @if(Auth::check())
        <div class="collapse navbar-collapse justify-content-end" id="navbar">
          <a href="{{ route('mypage') }}" class="nav-link text-info">MYPAGE</a>
          <a href="#" id="logout" class="nav-link text-info">LOGOUT</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      @else
        <div class="collapse navbar-collapse justify-content-end" id="navbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-info" href="{{ route('login') }}">LOGIN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-info" href="{{ route('register') }}">REGISTER</a>
            </li>
          </ul>
        </div>
      @endif
    </nav>
  </header>

  <main>
    @yield('content')
  </main>

  <script>
    @if(Auth::check())
        document.getElementById('logout').addEventListener('click', function(event) {
          event.preventDefault();
          document.getElementById('logout-form').submit();
        });
    @endif

    @yield('scripts')
  </script>
</body>
</html>