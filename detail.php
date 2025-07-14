<?php
include("funcs.php");
session_start();
sschk();

// ①渡されたidを受け取る
$id = $_GET['id'];
// ②Dbと接続
$pdo = db_conn();

// 渡されたidを元にデータ取得SQLでデータを取得
$sql = "SELECT * FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//データを1行分だけ取得、複数取得する場合はfetchAllを使う
$row = $stmt->fetch();

?>

<!-- 以下がHTML -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title></title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Main[Start] -->
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>BOOK STOCK</legend>
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     <label>本の名前 <input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>気になったワード<br> 
        <textArea name="words" rows="4" cols="40"><?=$row["words"]?></textArea></label><br>
     <label>次のAction<br>
        <textArea name="action" rows="4" cols="40"><?=$row["action"]?></textArea></label><br>
     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


