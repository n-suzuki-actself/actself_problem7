<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>タイトル絞り込み検索</title>
    </head>
        <body>
            <form action="search" method="post">
                <h1>タイトル絞り込み検索</h1>
                <fieldset>
                キーワードを入力してください：<input name="keyword" type="text" style="width:150px">
                <input name="one_time_token" type="hidden" value="<?php echo $str ?>">
                <input type="submit" value="検索">
                </fieldset>
            </form>
        </body>
</html>
