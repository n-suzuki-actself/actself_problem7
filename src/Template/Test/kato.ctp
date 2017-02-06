<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title> メニュー画面 </title>
</head>
<body>


<h1>メニュー画面</h1>

<!-- GETで処理の種類をコントローラに渡している -->
<a href="controller.php?req=list">一覧</a> | <a href="controller.php?req=add_input">登録</a> | <a href="controller.php?req=update_input">更新</a>
<br>
<br>
<?php foreach($books as $book):

	echo $book['title'] . " " . $book['author'] . "<br>";

endforeach; ?>

</body>
</html>
