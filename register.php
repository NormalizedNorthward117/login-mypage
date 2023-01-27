<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="register.css">
    </head>

<body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="login"><a href="login.php">ログイン</a></div>
    </header>

    <main>
        <form action="register_confirm.php" method="post" enctype="multipart/form-data">
            <div class="form_contents"> <!--ファイルをうｐする際、必ずenctype="multipart/form-data"が必要-->
                <h2>会員登録</h2>
                <div class="name">
                    <div class="hissu">必須</div><label>氏名</label><br>
                    <input type="text" class="formbox" size="40" name="name" required>
                </div> <!--formのinput内にrequiredを入れるとそのinputを必須項目に出来る。この項目が未入力の時、予め決まったエラーメッセが自動表示-->
                <div class="mail">
                    <div class="hissu">必須</div><label>メールアドレス</label><br>
                    <input type="text" class="formbox" size="40" name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                </div>
                <div class="password">
                    <div class="hissu">必須</div><label>パスワード</label><br>
                    <input type="text" class="formbox" size="40" name="password" id="password" pattern="^[a-zA-Z0-9._%+-]{6,}$" required>
                </div> <!--id="password"確認チェック部分①-->
                <div class="password">
                    <div class="hissu">必須</div><label>パスワード確認</label><br>
                    <input type="text" class="formbox" size="40" name="confirm_password" id="confirm" oninput="ConfirmPassword(this)" required>
                </div> <!--↑id="password"確認チェック部分② ◎下記でjavasctiptも記述することでパスワード確認が完成-->
                <div class="picture">
                    <label>プロフィール写真</label><br>
                    <input type="hidden" name="max_file_size" value="1000000" />
                    <input type="file" size="40" name="picture">
                </div>
                <div class="comments">
                    <label>コメント</label><br>
                    <textarea rows="5" cols="45" name="comments"></textarea>
                </div>
                <div class="toroku">
                    <input type="submit" class="submit_button" size="35" value="登録する">
                </div>
            </div>
        </form>
    </main>

    <footer>
        © 2018 InterNous.inc All rights reserved
    </footer>

    <script>// ◎ 上記でoninput="ConfirmPassword(this)"した物の内容
        function ConfirmPassword(confirm){  //ConfirmPassword(confirm)の設定
            var input1 = password.value; //var input1 = id="password"に入力された中身
            var input2 = confirm.value; //var input2 = id="confirm"に入力された中身
            if(input1 != input2){
                confirm.setCustomValidity("パスワードが一致しません。");
            }    //  setCustumValidity()はHTML5のバリデーション機能
            else{//予め用意されたエラーメッセではなく自分でエラーメッセを設定できる
                confirm.setCustomValidity("");
            }    //空文字列をセットすると、エラーメッセージをクリア
        }
    </script>
</body>
</html>