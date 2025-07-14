<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値を受け取る
$name= $_POST["name"];
$lid = $_POST["lid"]; //lid
$lpw = $_POST["lpw"]; //lpw

$hashed_pw = password_hash($lpw, PASSWORD_DEFAULT);


//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

// 初回ユーザーを管理者に設定する
$stmt = $pdo->prepare("SELECT COUNT(*) FROM gs_bmuser_table");
$stmt->execute();
$user_count = $stmt->fetchColumn();

if ($user_count == 0) {
    $kanri_flg = 1;  // 最初の1人 → 管理者
} else {
    $kanri_flg = 0;  // 一般ユーザー
}


// SQLの作成 これでDbにユーザー登録を行う
$stmt = $pdo->prepare("INSERT INTO gs_bmuser_table SET name=:name, lid=:lid, lpw=:lpw, kanri_flg=:kanri_flg");
$stmt->bindValue(':name',  $name,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $hashed_pw,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    sql_error($stmt);
}else{
    session_regenerate_id(true);
    $_SESSION["chk_ssid"]  = session_id();
    $_SESSION["kanri_flg"] = $kanri_flg;
    $_SESSION["name"]      = $name;
    redirect("select.php");
}











