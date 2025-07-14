<!-- Sign in 画面を作ろう！！ -->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<style>div{padding: 10px;font-size:16px;}</style>
<title>Sign in </title>
</head>
<body>

<header>
  <nav style="background-color:#e4b7a0; font-weight:bold; padding:10px;">SIGN IN</nav>
</header>

<form name="form" action="signin_act.php" method="post" style="padding-top:40px;">
名前:<input type="text" name="name">
ID:<input type="text" name="lid">
PW:<input type="password" name="lpw">
<input type="submit" value="sign in">
</form>

<div style=padding-top:20px;><a href="./login.php">すでにアカウントをお持ちの方はこちら</a></div>



</body>
</html>