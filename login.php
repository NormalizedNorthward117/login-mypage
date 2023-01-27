<?php
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
                <div class="mail">
                    <label>メールアドレス</label><br>

                    <input type="text" class="formbox" size="40" name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" 
                    value="<?php 
                        if(!empty($_COOKIE['mailLog'])){     //クッキーmailLogが空じゃないならtext"mail"の初期値として代入する
                            echo $_COOKIE['mailLog'];
                        }else{
                        }
                    ?>" required>

                </div>
                <br>
                <div class="password">
                    <label>パスワード</label><br>
                    <input type="password" class="formbox" size="40" name="password"
                    value="<?php 
                        if(!empty($_COOKIE['passLog'])){ //↑のmailのと同じ
                            echo $_COOKIE['passLog'];
                        }else{
                        }
                    ?>" required>
                </div>
                <br>
                <div class="login_keep"><!--checkboxのvalueはチェックボックスがONなら出る値  OFFなら存在しない-->
                    <input type="checkbox" name="login_keep" value="keepLog"
                        <?php
                            if(isset($_COOKIE['login_keep'])){
                                echo "checked='checked'";
                            }
                        ?>
                    >ログイン状態を保持する
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