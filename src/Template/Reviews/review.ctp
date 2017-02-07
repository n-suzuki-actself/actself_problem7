<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title> 口コミ一覧画面 </title>
    </head>
    <body>
        <h1>口コミ一覧表示</h1>       
        <br>
        <?php echo '「' . $data['title']  . '」' . 'の口コミ一覧'; ?>
        <br>
        <br>       
        <a href="/cakephp/reviews/addreview/<?php echo $data['id'] ?>" >新規登録</a>
        <table border="1">
                        <thead>       
				<tr>
					<th>ID</th>
					<th>見出し</th>
					<th>ニックネーム</th>
					<th>削除</th>
					<th>登録日時</th>
					<th>更新日時</th>					
				</tr>
			</thead>	
                <tbody>
                <?php foreach($list as $obj): ?> 
                <tr>
                    <td><?php echo h($obj['id']) ?></td>
                    <td> <a href="/cakephp/reviews/updatereview/<?php echo $data['id'] ?>" > <?php echo h($obj['header']) ?></a></td>
                    <td><?php echo h($obj['nickname']) ?></td>
                    <td> <a href="/cakephp/reviews/deletereview/<?php echo $obj['id']?>/<?php echo $data['id']?>"  onClick='return CheckDelete()' >削除</a></td>
                    <td><?php echo $obj['created'] ?></td>
                    <td><?php echo $obj['modified'] ?></td> 
                    <input name="book_id" type="hidden" value="<?php echo $data['id']?>">                   
                </tr>
		<?php endforeach; ?>
		</tbody>
                </table>       
        <script>
            function CheckDelete(){
                if(window.confirm('本当に削除しますか？')){
                    return true;
                }
                else{
                    window.alert('キャンセルされました');
                    return false;
                }
            }              
                //alerf("pass");
        </script>
    </body>
</html>