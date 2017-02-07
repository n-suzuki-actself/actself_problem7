<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title> 書籍情報更新画面 </title>
		</head>
		<body>

		<form action="/cakephp/reviews/updatereview" method="post">
		<h1>書籍情報更新</h1>
                <br>
                <?php echo '「' . $data['title']  . '」' . 'の口コミ一覧'; ?>
                <br>
		<br/>
                <fieldset>
		ID：<input name="id" type="text" style="width:50px"><br/>
		見出し：<input name="header" type="text" style="width:150px"><br/>
		ニックネーム：<input name="nickname" type="text" style="width:150px"><br/>
                本文：<textarea name="body" rows="10"
                             ></textarea><br/>
                5段階評価:<select name="star_count"style="width:50px">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                </select>
		<input name="book_id" type="hidden" value="<?php echo $data['id'] ?>">
                <input name="one_time_token" type="hidden" value="<?php echo $str ?>">
                </fieldset>
		<input type="submit" value="更新">
		<br/><br/>
		
		</form>
		</body>
		</html>