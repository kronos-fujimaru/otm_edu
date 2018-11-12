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

<header class="navbar navbar-default navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
        <div class="navbar-header navbar-collapse">
          <ul class="nav navbar-nav">
            <li {!!is_active($selectMenuIndex, 0)!!}><a class="navbar-brand" href="/admin">研修管理システム（管理者）</a></li>
            <li {!!is_active($selectMenuIndex, 2)!!}><a href="/admin/instructors">講師管理</a></li>
            <li {!!is_active($selectMenuIndex, 3)!!}><a href="/admin/companies">受講企業管理</a></li>
            <li {!!is_active($selectMenuIndex, 4)!!}><a href="/admin/trainings">研修管理</a></li>
            <li {!!is_active($selectMenuIndex, 5)!!}><a href="/admin/examinations">理解度テスト管理</a></li>
            <li {!!is_active($selectMenuIndex, 6)!!} {{$selectMenuIndex}}><a href="/admin/analysis">適正分析レポート</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name}}でログイン中 <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/admin/setting">設定</a></li>
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
