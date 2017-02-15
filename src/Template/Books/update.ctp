		<title> 書籍情報更新画面 </title>
                <?=$this->Form->create($books, ['url'=>['action'=>'update']]) ?>
		<h1>書籍情報更新</h1>
		<br/>
                <fieldset>
		ID：<input name="id" type="text" style="width:50px"><br/>
		タイトル：<input name="title" type="text" style="width:150px"><br/>
		著者：<input name="author" type="text" style="width:150px"><br/>
		出版年：<input name="released_in" type="text" style="width:50px"><br/>
                </fieldset>
		<?=$this->Form->button("更新") ?>
                <?=$this->Form->end() ?>
		<br/><br/>
		
		</form>
		</body>
	