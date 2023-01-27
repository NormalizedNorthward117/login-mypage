<?php
        //ログイン時にアクセスした場合、マイページにリダイレクト
    session_start();
    if(isset($_session['id'])){ //もしログイン状態ならば
        header("Location:mypage.php"); //即マイページへリダイレクト
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>マイページログイン</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>

<body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="toroku"><a href="register.php">新規登録</a></div>
    </header>

    <main>
        <form action="mypage.php" method="post">

            <div class="form_contents">
                <div class="error_message">メールアドレスまたはパスワードが間違っています。</div>
                <div class="mail">
                    <label>メールアドレス</label><br>
                    <input type="text" class="formbox" size="40" name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                </div>
                <br>
                <div class="password">
                    <label>パスワード</label><br>
                    <input type="password" class="formbox" size="40" name="password" pattern="^[a-zA-Z0-9._%+-]{6,}$" required>
                </div>
                <br>
                <div class="login_button">
                    <input type="submit" class="submit_button" size="35" value="ログイン">
                </div>
            </div>
        </form>
    </main>

    <footer>
        © 2018 InterNous.inc All rights reserved
    </footer>
</body>
</html>