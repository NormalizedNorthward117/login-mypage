<?php
    mb_internal_encoding("utf8");
    session_start();//mypage.phpで設定したのでこれだけで値引き継ぎ完了

        //mypage.phpでpostされた$_POST['from_mypage']が空の時、login_errorへリダイレクト
    if(empty($_POST['from_mypage'])){
        header("Location:login_error.php");
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>マイページ編集</title>
        <link rel="stylesheet" type="text/css" href="mypage_hensyu.css">
    </head>

<body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="logout"><a href="log_out.php">ログアウト</a></div>
    </header>

    <main>
        <form action="mypage_update.php" method="post">
            <div class="form_contents">                                                             <!--内容確認の要素-->

                <h2>会員情報</h2>                                                                    <!--内容確認のタイトル-->
                
                <div class="aisatsu">こんにちは！　<?php  echo $_SESSION['name']; ?>さん</div>             <!--会員へのメッセ-->

                <div class="profile_pic">
                    <img src=
                        "<?php // ↑で設定した変数を使ってうｐされたファイルフォルダを指定し、表示-->
                            if(empty($_SESSION['path_filename'])){
                            } else{
                                echo $_SESSION['path_filename'];
                            }
                        ?>"
                    >
                </div>
                <br>
                <div class="basic_info">

                    <div class="name"><!--名前編集-->
                        氏名：<input type="text" class="formbox" size="40" name="name"
                        value="<?php echo $_SESSION['name']; ?>"required>
                    </div>

                    <div class="mail"><!--メール編集-->
                        メール：<input type="text" class="formbox" size="40" name="mail"
                        value="<?php echo $_SESSION['mail']; ?>" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                    </div>

                    <div class="password"><!--パスワード編集-->
                        パスワード：<input type="text" class="formbox" size="40" name="password"
                        value="<?php echo $_SESSION['password']; ?>" pattern="^[a-zA-Z0-9._%+-]{6,}$" required>
                    </div>

                </div>
                <div class="commentText"><!--コメント欄編集-->
                    <textarea rows="5" cols="95" name="comments" value=""><?php 
                        if(!empty($_SESSION['comments'])){
                            echo $_SESSION['comments'];
                        }else{}
                    ?></textarea>
                </div>

                <div class="button"> <!--登録情報をアプデするボタン-->
                    <input type="submit" class="update_button" value="この内容に変更する">
                </div><!--ボタン　終わり-->
            </div><!--編集内容の要素　終わり-->
        </form><!--枠　終わり-->
    </main>

    <footer>
        © 2018 InterNous.inc All rights reserved
    </footer>
</body>
</html>