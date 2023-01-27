<?php
    mb_internal_encoding("utf8");
        //セッションスタート
    session_start();

        //session配列が空だった場合
    if(empty($_SESSION['id'])) {

        try{//try catch文 midphp_practice3：に接続できなければエラーメッセ 

            $pdo=new PDO("mysql:dbname=midphp_practice3;host=localhost;","root","");
                //↑DB接続を対象とし、接続出来ない場合の処理をcatchに記述する

        }//↓DB接続が出来ない場合

        catch(PDOException $e){//catchの例外種類にPDO関連の例外を記述している　変数名は必須

            die(
                "<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>
                しばらくしてから再度ログインをしてください。</p>
                <a href='http://localhost/php_practice/login_mypage/login.php'>ログイン画面へ</a>"
            );//die("出力するメッセージ");は、現在のスクリプトを終了してメッセを出力するコード

        }

            //↓prepared statement　selectとwhereを用いてDBのmail＆passとpostデータのmail＆passを照合で行を指定し行の全ての列表示
        $stmt=$pdo->prepare("select * from login_mypage where mail=:mail && password=:password");

            //bindValueを使用し、実際に？に何を代入するか
        $stmt->bindValue(":mail",$_POST['mail']);            //"select * from login_mypage where mail=$_POST['mail']"
        $stmt->bindValue(":password",$_POST['password']);    //"select * from login_mypage where password=$_POST['password']"

            //executeでクエリ(DB:mail&pass=post:mail&pass match check and show all raw data)を実行
        $stmt->execute();

            //DB接続解除
        $pdo=NULL;

            //fetch・while文でデータ取得  sessionに代入
        while($row = $stmt->fetch()){

            $_SESSION['id']= $row['id'];
            $_SESSION['name']= $row['name'];
            $_SESSION['mail']= $row['mail'];
            $_SESSION['password']= $row['password'];
            $_SESSION['path_filename']= $row['picture'];
            $_SESSION['comments']= $row['comments'];

        };
    
            //データ取得が無ければ、リダイレクト  エラー画面へ
        if(empty($_SESSION['id'])){
            header("Location:login_error.php");
        }

            //login.phpでlogin状態を保持にチェックしていた場合
        if(!empty($_POST['login_keep'])) {
            $_SESSION['login_keep'] = $_POST['login_keep'];
        } // ↑ ポストされたlogin_keepをsessionに保存

    };//if:session配列=null終了

        //login:sucsessかつ$_SESSION['login_keep']≠nullの時
    if(!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])) {

            //cookieにmail,password,login_keep保存
        setcookie('mailLog',$_SESSION['mail'],time()+60*60*24*7);// $_COOKIE['mailLog']=$_SESSION['mail']の値                一週間有効
        setcookie('passLog',$_SESSION['password'],time()+60*60*24*7);// $_COOKIE['passLog']=$_SESSION['password']の値        一週間有効
        setcookie('login_keep',$_SESSION['login_keep'],time()+60*60*24*7);// $_COOKIE['passLog']=$_SESSION['password']の値   一週間有効

    }//if:login:sucsess&$_SESSION['login_keep']≠null終了

    else if(empty($_SESSION['login_keep'])){
        //↑login:sucsessかつ$_SESSION['login_keep']=nullの時

            //cookieのデータ削除
        setcookie('mailLog',time()-1);// $_COOKIE['mailLog'] delete
        setcookie('passLog',time()-1);// $_COOKIE['passLog'] delete
        setcookie('login_keep',time()-1);// $_COOKIE['passLog'] delete
    };//if:login:sucsess&$_SESSION['login_keep']=null終了
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>マイページ</title>
        <link rel="stylesheet" type="text/css" href="mypage.css">
    </head>

<body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="logout"><a href="log_out.php">ログアウト</a></div>
    </header>

    <main>
        <div class="kakunin_flame">                                                                 <!--内容確認枠-->
            <div class="form_contents">                                                             <!--内容確認の要素-->

                <h2>会員情報</h2>                                                                    <!--内容確認のタイトル-->

                <div class="aisatsu">こんにちは！　<?php  echo $_SESSION['name']; ?> さん</div>     <!--会員へのメッセ-->

                    <div class="profile_pic"><img src=
                        "<?php // ↑で設定した変数を使ってうｐされたファイルフォルダを指定し、表示-->
                            if(empty($_SESSION['path_filename'])){
                            } else{
                                echo $_SESSION['path_filename'];
                            }
                        ?>"
                    ></div>
                    <br>
                    <div class="basic_info">
                        <p>氏名：<?php echo $_SESSION['name']; ?></p>
                        <p>メール：<?php echo $_SESSION['mail']; ?></p>
                        <p>パスワード：<?php echo $_SESSION['password']; ?></p>
                        </div>
                    <div class="commentText">
                        <?php //写真と同様、空なら「なし」と表示
                        if(empty($_SESSION['comments'])){
                            echo "コメントなし";
                        }else{
                            echo $_SESSION['comments'];
                        };
                        ?>
                    </div>
                    <form method="post" action="mypage_hensyu.php" class="form_center"><!--mypage_hensyuへpost-->

                        <input type="hidden" value="<?php echo rand(1,10); ?>" name="from_mypage" id="from_mypage"/>
                        <!--↑URL直打ちでのmypage_hensyu.phpへの接続を避けるため、乱数を生成しmypage_hensyu.phpへpostする-->

                        <div class="button"><!--編集画面へのボタン-->
                            <input type="submit" class="edit_button" size="35" value="編集する"/>
                        </div><!--ボタン　終わり-->
                    </form>

            </div><!--内容確認の要素　終わり-->
        </div><!--内容確認枠　終わり-->
    </main>

    <footer>
        © 2018 InterNous.inc All rights reserved
    </footer>
</body>
</html>