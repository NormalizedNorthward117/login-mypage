<?php
        //セッション開始
    session_start();

        //セッションの削除
    session_destroy();

        //ログインページへリダイレクト
    header("Location:login.php"); 
?>