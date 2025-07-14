<?php
include("funcs.php");
//エラー表示
ini_set("display_errors", 1);

//<!-- POSTデータの取得 -->
$name = $_POST['name'];
$words = $_POST['words'];
$action = $_POST['action'];

//<!-- DB接続 -->
$pdo = db_conn();

//<!-- DEに書き込み：SQLをphpで作成し書き込み -->
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(`name`,words,`action`,`date`)VALUES(:name, :words, :action, sysdate());");
// 準備するよって意味合い！Sysdateは現在時刻ってこと
// :~ というのは後でいれるよってこと
$stmt->bindValue(':name',  $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT 文字だとSTR)
$stmt->bindValue(':words', $words, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':action', $action, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//<!-- 最後の処理 -->
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("SQL_Error:".$error[2]);
}else{
    //５．index.phpへリダイレクト
   header("Location:index.php");
   exit();
  
}
?>
