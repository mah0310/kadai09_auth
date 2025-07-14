<?php
//エラー表示
ini_set("display_errors", 1);

//2. DB接続します
include("funcs.php");
session_start();
sschk();
$pdo = db_conn();

//２．データ表示SQL作成
$sql = "SELECT * FROM gs_bm_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>読書図鑑 管理者画面</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<style>
        table {
            border: solid 1px black;
            width: 100%;
            margin: 30px 0;
        }
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid" style="display: flex; align-items: center; background-color:#e4b7a0; font-weight:bold;">
      <div>管理者画面</div>
      <div class="navbar-header"><a class="navbar-brand" href="collect.php">読んだ本を登録する場合はこちら！</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="index.php">ユーザー登録</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="user.php">ユーザー一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">


<table>
<?php foreach($values as $v){ ?>
    <tr>
    <td><a href="detail.php?id=<?=$v["id"]?>"><?=$v["id"]?></a></td>
    <td><?=$v["name"]?></td>
    <td><?=$v["words"]?></td>
    <td><?=$v["action"]?></td>
    <td><?=$v["date"]?></td>
    <td><a href="delete.php?id=<?=$v["id"]?>">削除</a></td>
  </tr>
<?php } ?>
</table>


  </div>
</div>
<!-- Main[End] -->
<script>
  const a = '<?php echo $json; ?>';
  console.log(JSON.parse(a));
</script>
</body>
</html>
