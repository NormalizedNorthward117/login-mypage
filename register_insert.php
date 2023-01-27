<?php
    mb_internal_encoding("utf8");
    $pdo = new PDO("mysql:dbname=midphp_practice3; host=localhost;", "root", "");

    $stmt=$pdo->prepare("insert into login_mypage(name, mail, password, picture, comments)values(:name,:mail,:password,:picture,:comments)");

    $stmt->bindValue(":name",$_POST['name']);
    $stmt->bindValue(":mail",$_POST['mail']);
    $stmt->bindValue(":password",$_POST['password']);
    $stmt->bindValue(":picture",$_POST['path_filename']);
    $stmt->bindValue(":comments",$_POST['comments']);

    $stmt->execute();
    $pdo=NULL;
    header("Location:after_register.html");
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>お問い合わせフォーム　DBに送信完了</title>
    <link rel="stylesheet" type="text/css" href="register_confirm.css">
</head>

<body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="login"><a href="login.php">ログイン</a></div>
    </header>

    <main>
        <div class="kakunin_flame">                                                                 <!--内容確認枠-->
            <div class="form_contents">                                                             <!--内容確認の要素-->

                <div class="toroku_ok">登録有難うございました。</div>                                 <!--登録完了メッセ-->
                <br>
                <a href="register.php">新規登録画面へ戻る</a></div>
                <br><br><br>

            </div><!--内容確認の要素　終わり-->
        </div><!--内容確認枠　終わり-->
    </main>

    <footer>
        © 2018 InterNous.inc All rights reserved
    </footer>
</body>
</html>