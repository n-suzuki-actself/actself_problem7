<html> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title> ユーザー情報一覧画面 </title>
    </head>
    <body>
        <h1>ユーザー情報一覧表示</h1>
        <br>
        <a href='/cakephp/users/add'>新規登録</a>
        <br>
        <br>
        <table border="1">
                        <thead>
				<tr>
					<th>ID</th>
					<th>メールアドレス</th>
					<th>パスワード</th>
					<th>名前</th>
					<th>登録日時</th>
					<th>更新日時</th>
					<th>削除</th>
				</tr>
			</thead>	
                <tbody>
                <?php foreach($data as $obj): ?> 
                <tr>
                    <td><?php echo $obj['id']; ?></td>
                    <td> <a href='/cakephp/users/update'> <?php echo $obj['mail_address'] ?></a></td>
                    <td><?php echo $obj['password'] ?></td>
                    <td><?php echo $obj['name'] ?></td>
                    <td><?php echo $obj['created'] ?></td>
                    <td><?php echo $obj['modified'] ?></td>  
                    <td> <a href="/cakephp/users/delete/<?php echo $obj['id']?>"  onClick='return CheckDelete()' >削除</a></td>
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
