<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>オープン研修管理システム</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="/js/marked.js"></script>
    <script>
      $(function() {
          marked.setOptions({
              langPrefix: ''
          });
      });

      $(function() {
          $('.markdown').each(function(i, e) {
              e.innerHTML = marked(e.innerHTML);
          });

          $('.markdown pre code').each(function(i, e) {
              $(e).text(unsanitize($(e).text()));
              hljs.highlightBlock(e, e.className);
          });
      });

      function unsanitize(html) {
        return $('<div />').html(html).text();
      }
  </script>
</head>
<body>
<header class="navbar navbar-inverse navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
        <div class="navbar-header navbar-collapse">
            <ul class="nav navbar-nav">
              <li {!!is_active($selectMenuIndex, 0)!!}><a class="navbar-brand" href="/manager">研修管理システム（担当者）</a></li>
              <li {!!is_active($selectMenuIndex, 3)!!}><a href="/manager/livecamera">ライブ配信</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name}}でログイン中 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="/manager/setting">設定</a></li>
                  <li><a href="/auth/logout">ログアウト</a></li>
                </ul>
              </li>
            </ul>
        </div>
    </div>
</header>
@yield('content')
</body>
</html>
