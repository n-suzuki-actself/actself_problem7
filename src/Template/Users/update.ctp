<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ユーザー情報更新画面</title>
    </head>
    <body>
        <form action='/cakephp/users/update' method='post'>
		<h1>ユーザー情報更新画面</h1>
                <fieldset>
                ID:<input name="id" type="text" style="width:50px"><br/>
		メールアドレス：<input name="mail_address" type="text" style="width:150px"><br/>
		パスワード：<input name="password" type="text" style="width:150px"><br/>
		名前：<input name="name" type="text" style="width:150px"><br/>
                <input name="one_time_token" type="hidden" value="<?php echo $str ?>">
                </fieldset>
		<input type="submit" value="更新">
        </form>
    </body>
</html>
