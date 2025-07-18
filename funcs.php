<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
function db_conn(){
    try {
        //localhostの場合　＊config.phpはconfig_sample.phpを参考に個人で作成してください。
        require_once(__DIR__. "/config.php");

        //localhost以外　＊config_server.phpはconfig_sample.phpを参考に個人で作成してください。
        if($_SERVER["HTTP_HOST"] != 'localhost'){
            require_once(__DIR__. "/config_server.php");
            }
        return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}



//SQLエラー関数：sql_error($stmt)
function sql_error($stmt) {
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name) {
    header("Location: ".$file_name);
    exit();
}


//SessionCheck(スケルトン)
function sschk(){
    if( $_SESSION['chk_ssid'] != session_id() ){
      exit('LOGIN ERROR');
    }else{
      session_regenerate_id(true);
      $_SESSION['chk_ssid'] = session_id();
    }
  }
  




