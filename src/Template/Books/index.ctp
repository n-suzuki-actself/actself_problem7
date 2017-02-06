<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title> 書籍情報一覧画面 </title>
    </head>
    <body>
        <h1>書籍情報一覧表示</h1>
        <br>
        <a href='/cakephp/books/add'>新規登録</a>
        <br>
        <a href='/cakephp/users/index'>ユーザー情報一覧</a>
        <br>
        <br>
        <table border="1">
            <thead>
				<tr>
					<th>ID</th>
					<th>タイトル</th>
					<th>著者</th>
					<th>出版年</th>
                                        <th>口コミ</th>
					<th>登録日時</th>
					<th>更新日時</th>
					<th>削除</th>
				</tr>


			</thead>
		
	
                <tbody>
                   <!-- <form action="delete" method="post">-->
                <?php foreach($data as $obj): ?> 
                <tr>
                    <td><?php echo $obj['id']; ?></td>
                    <!--<td><!?php echo $obj['title']; ?></td>　-->
                    <td> <a href='/cakephp/books/update'> <?php echo h($obj['title']) ?></a></td>
                    <td><?php echo $obj['author'] ?></td>
                    <td><?php echo $obj['released_in'] ?></td>
                    <td><a href='/cakephp/reviews/review/<?php echo h($obj['id'])?>'>口コミ</a></td>
                    <td><?php echo $obj['created'] ?></td>
                    <td><?php echo $obj['modified'] ?></td>  
                   <!-- <td><!input type="submit" value="削除"></td>-->
                    <!--<td><input name="id" type="hidden" value=<!?php echo $obj['id']?>></td>-->
                   <!-- <td> <a href="delete/<!?php echo $obj['id'] ?>">削除</a></td>-->
                    <!--<td> <a href="delete/<?php echo $obj['id'] ?>">削除</a><script onClick='CheckDelete()'></script></td>-->
                    <td> <a href="/cakephp/books/delete/<?php echo $obj['id']?>"  onClick='return CheckDelete()' >削除</a></td>
                  <!-- <td> <!?php echo $this->Html->link('削除', '/delete/'$obj['id'],  '本当に削除しますか？) ?></td> -->
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