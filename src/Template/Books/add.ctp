            <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title> 書籍情報画面 </title>
		</head>
		<body>
                                  
		<form action="add" method="post">
		<h1>書籍情報登録</h1>
                <fieldset>
		タイトル：<input name="title" type="text" style="width:150px"><br/>
		著者：<input name="author" type="text" style="width:150px"><br/>
		出版年：<input name="released_in" type="text" style="width:50px"><br/>
                <input name="one_time_token" type="hidden" value="<?php echo $str ?>">                     
                </fieldset>
		<input type="submit" value="登録">
		<br/><br/>                		                                               
                              		
                </form>
		</body>
                </html>
		