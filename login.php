<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<style>div{padding: 10px;font-size:16px;}</style>
<title>ログイン</title>
</head>
<body>

<header>
  <nav style="background-color:#e4b7a0; font-weight:bold; padding:10px;">LOGIN</nav>
</header>

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<form name="form1" action="login_act.php" method="post" style="padding-top:40px;">
ID:<input type="text" name="lid">
PW:<input type="password" name="lpw">
<input type="submit" value="ログイン">
</form>

<div style=padding-top:20px;><a href="./index.php">まだアカウントをお持ちでない方はこちら</a></div>


</body>
</html>