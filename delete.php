<?php
include("funcs.php");
session_start();
sschk();
$pdo = db_conn();

$id = $_GET['id'];

// id に紐づく情報を操作するようなSQLを出す
$stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("select.php");
}

