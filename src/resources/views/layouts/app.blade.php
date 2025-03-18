<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')

    @yield('css') {{-- 各ページごとのCSS --}}
    <!-- CSSの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">


</head>
<body>
<div class="content-head__1">
      <header class="header">
              <label class="header__label"><a href="{{ route('expenses.index') }}">Calculation</a></label>
        </header>
</div>

    <main>
    @yield('content')
  </main>

    @yield('scripts')

</body>
</html>
