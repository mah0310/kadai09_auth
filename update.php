<?php
// funcs.phpの読み込み
include("funcs.php");
// Db接続する
$pdo = db_conn();

// POSTデータの読み込み
$id   = $_POST["id"];
$name = $_POST['name'];
$words = $_POST['words'];
$action = $_POST['action'];

// SQLの作成
$stmt = $pdo->prepare("UPDATE gs_bm_table SET name=:name, words=:words, action=:action WHERE id=:id");
$stmt->bindValue(':id',   $id,   PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name',  $name,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':words', $words,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':action', $action,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("select.php");
}




