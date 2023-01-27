<?php                                                                                               //アップロードされた画像ファイルの設定
    mb_internal_encoding("utf8");
    $temp_pic_name = $_FILES['picture']['tmp_name']; // うｐファイルを、tmp_nameとして$temp_pic_nameで設定して取得
    $orignal_pic_name = $_FILES['picture']['name']; // うｐファイル名を、$orignal_pic_nameで変数設定して取得
    $path_filename='./image/'.$orignal_pic_name; // imageフォルダに入ってるうｐファイルを呼び出す変数
    move_uploaded_file($temp_pic_name,'./image/'.$orignal_pic_name); // うｐファイルをimageフォルダに移動
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>マイページ登録情報　確認</title>
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

                <h2>会員登録 確認</h2>                                                               <!--内容確認のタイトル-->

                <div class="kakunin">こちらの内容で登録してもよろしいでしょうか？</div>                 <!--内容確認のメッセ-->

                <div class="kinyu_naiyo">                                                           <!--前ぺージ記入内容-->
                    <p>氏名：<?php  echo $_POST['name']; ?></p>
                    <p>メール：<?php echo $_POST['mail']; ?></p>
                    <p>パスワード：<?php echo $_POST['password']; ?></p>

                    <p>プロフィール写真：<?php // ↑で設定した変数を使ってうｐされたファイルのファイル名を表示-->
                        if(empty($orignal_pic_name)){
                            echo "なし";
                        }else{
                            echo $orignal_pic_name;
                        }
                    ?></p>

                    <p>コメント：<?php //写真と同様、空なら「なし」と表示
                        if(empty($_POST['comments'])){
                            echo "なし";
                        }else{
                            echo $_POST['comments'];
                        }
                    ?></p>
                </div>
                
                <div class="toroku">
                    <form action="register.php">                                                       <!--入力フォームに戻るボタン-->
                        <input type="submit" class="back_button" value="戻って修正する" />
                    </form><!--戻るボタン 終わり-->

                    <form action="register_insert.php" method="post" enctype="multipart/form-data">    <!--入力情報をregister_insert.phpに送るボタン-->

                       <input type="submit" class="submit_button" value="登録する">

                        <input type="hidden" value=<?php echo $_POST['name']; ?> name="name" />
                        <input type="hidden" value=<?php echo $_POST['mail']; ?> name="mail" />
                        <input type="hidden" value=<?php echo $_POST['password']; ?> name="password" />

                        <input type="hidden" value=<?php 
                            if(empty($path_filename)){ // ファイルのアップロードが無ければ何もしない
                            }else{
                                echo $path_filename; //↑で設定した変数を使って移動後のファイルの格納先を指定
                            }
                        ?> size="35" name="path_filename" >

                        <input type="hidden" value=<?php
                            if(empty($_POST['comments'])){ // コメントの入力が無ければ何もしない
                            }else{
                                echo $_POST['comments'];
                            }
                        ?> size="35" name="comments" />

                    </form><!--登録ボタン　終わり-->
                </div><!--ボタン全体　終わり-->
            </div><!--内容確認の要素　終わり-->
        </div><!--内容確認枠　終わり-->
    </main>

    <footer>
        © 2018 InterNous.inc All rights reserved
    </footer>
</body>
</html>