        <h1>書籍情報一覧表示</h1>
        <table>
        <br>
        <a href='/cakephp/books/search'>タイトル絞り込み検索</a>　
        <a href='/cakephp/books/add'>新規登録</a>　
        <a href='/cakephp/users/index'>ユーザー情報一覧</a>
        <br>
        <form action="/cakephp/books/indexByAverage" method="post">
        <input type="submit" value="書籍の評価順に並び替える">
        </form>
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
        <?php
        $arr = $data->toArray();
        for($i = 0;$i < count($arr);$i++){
            echo $this->Html->tableCells(
                $arr[$i]->toArray(),
                ['style'=>'background-color:#f0f0f0'],
                ['style'=>'font-weight:bold'],
                true);
        }
        ?>
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

 