<!doctype html>
<html lang="zh-CN">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  </head>
<body>
  <a href="{{ $link = url('user/active',$token).'?email='.urlencode($email) }}" target="_blank">点击激活你的账号 {{$link}}</a>
</body>
</html>
