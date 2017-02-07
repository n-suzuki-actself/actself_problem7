
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ログイン画面</title>
</head>
<body>
<form action="login" method="post">
    <h1>ログイン画面</h1>
        <fieldset>
            ID：<input name="mail_address" type="text" style="width:150px"><br/>
            パスワード：<input name="password" type="text" style="width:150px"><br/>
            <input name="one_time_token" type="hidden" value="<?php echo $str ?>">
        </fieldset>
	<input type="submit" value="送信">
	<br/>
        <br/>                	

</body>
</html>