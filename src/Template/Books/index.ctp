        <h1>書籍情報一覧表示</h1>
        <table>
        <br>
<!--        <a href='/cakephp/books'>タイトル絞り込み検索</a>　-->
        <a href='/cakephp/books/add'>新規登録</a>　
        <a href='/cakephp/users/index'>ユーザー情報一覧</a>
        <?php echo $sort ?>
<!--        <a href='/cakephp/books/index?sort=rating'>評価の高い順に並び替える</a>-->
        
        <br>
        <br>
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
                <tbody>
                <?php foreach($data as $obj): ?> 
                <tr>
                    <td><?php echo h($obj['id']) ?></td>
                    <td> <a href='/cakephp/books/update/<?php echo $obj['id']?>'> <?php echo h($obj['title']) ?></a></td>
                    <td><?php echo h($obj['author']) ?></td>
                    <td><?php echo h($obj['released_in']) ?></td>
                    <td><a href='/cakephp/reviews/review/<?php echo h($obj['id'])?>'>口コミ</a></td>
                    <td><?php echo $obj['created'] ?></td>
                    <td><?php echo $obj['modified'] ?></td>        
                    <td> <a href="/cakephp/books/delete/<?php echo $obj['id']?>"  onClick='return CheckDelete()' >削除</a></td>              
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

 