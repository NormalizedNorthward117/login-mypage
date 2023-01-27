<?php
    mb_internal_encoding("utf8");
        //セッションスタート
    session_start();

    try{//try catch文 ：に接続できなければエラーメッセ

        $pdo=new PDO("mysql:dbname=midphp_practice3;host=localhost;","root","");
        //DB接続を対象とし、接続出来ない場合の処理をcatchに記述する*/

    }//↓DB接続が出来ない場合

    catch(PDOException $e){//catchの例外種類にPDO関連の例外を記述している　変数名は必須

        die(

            "<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>
            しばらくしてから再度ログインをしてください。</p>
            <a href='http://localhost/php_practice/login_mypage/login.php'>ログイン画面へ</a>"

        );//die("出力するメッセージ");は、現在のスクリプトを終了してメッセを出力するコード

    }

            //↓prepared statement　$_SESSION['id']でidから行を指定して更新されたpostデータのname、mail、password、commentsデータのupdate
    $stmt=$pdo->prepare(
        "update login_mypage set name =:name        where id = :id;
        update login_mypage set mail =:mail         where id = :id;
        update login_mypage set password =:password where id = :id;
        update login_mypage set comments =:comments where id = :id;"
    );

        //bindValueを使用し、実際に？に何を代入するか
    $stmt->bindValue(":id",$_SESSION['id']); // mypage.phpで受け取ったid値を元に行を指定
    $stmt->bindValue(":name",$_POST['name']);         //"update addresslist set name =$_SESSION['name']           where user_id = $_SESSION['id'];"
    $stmt->bindValue(":mail",$_POST['mail']);         //"update addresslist set mail =$_SESSION['mail']           where user_id = $_SESSION['id'];"
    $stmt->bindValue(":password",$_POST['password']); //"update addresslist set password =$_SESSION['password']   where user_id = $_SESSION['id'];"
    $stmt->bindValue(":comments",$_POST['comments']); //"update addresslist set comments =$_SESSION['comments']   where user_id = $_SESSION['id'];"

        //executeでクエリ(name,mail,password,comments:update)を実行
    $stmt->execute();

            //↓prepared statement：selectとwhereを用いて$_SESSION['id']でidから行を指定し、行の全ての列表示
    $stmt=$pdo->prepare("select * from login_mypage where id = :id");

        //bindValueを使用し、実際に？に何を代入するか
    $stmt->bindValue(":id",$_SESSION['id']); //"select * from login_mypage where id = $_SESSION['id']"

        //executeでクエリ(DB:id=post:id match check and show all this raw data)を実行
    $stmt->execute();


    $pdo=NULL;//DB接続解除

        //fetch・while文でデータ取得  sessionに代入
    while($row = $stmt->fetch()){
        $_SESSION['name']= $row['name'];
        $_SESSION['mail']= $row['mail'];
        $_SESSION['password']= $row['password'];
        $_SESSION['path_filename']= $row['picture'];
        $_SESSION['comments']= $row['comments'];
        };
    
        //データ取得が無ければ、リダイレクト  エラー画面へ
    if(empty($_SESSION['id'])){
        header("Location:login_error.php");
    }else{
        header("Location:mypage.php");
    };
?>