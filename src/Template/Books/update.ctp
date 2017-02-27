		<title> 書籍情報更新画面 </title>
                <?php echo  $this->Form->create($entity) ?>
		<h1>書籍情報更新</h1>
                <fieldset>
		<?php echo $this->Form->input('title', ['type' => 'text', 'label' => "タイトル"]); ?><br>
                著者：<input name="author" type="text" value="<?php echo $entity['author'] ?>" style="width:150px"><br/>
		出版年：<input name="released_in" type="text" value="<?php echo $entity['released_in'] ?>" style="width:50px"><br/>
                <input name="id" type="hidden" value="<?php echo $entity['id'] ?>">
                </fieldset>
		<?=$this->Form->button("更新") ?>
                <?=$this->Form->end() ?>
		
	