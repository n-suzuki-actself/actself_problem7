<h1>書籍情報登録</h1>                
<?=$this->Form->create($entity,['url'=>['action'=>'add']]) ?>	
<!--?php var_dump($entity) ?>-->
<!--?php $entity['tite']=''?>-->
    <fieldset>
        タイトル：<input name="title" type="text" value="<?php echo $entity['title']?>" placeholder="※必須項目" style="width:150px"><br/>
<!--        <div class="error"><?php echo $this->Form->error('books.title')?></div>-->
        <!--<?=$this->Form->input('タイトル：', ['name'=>'title','type' => 'text', 'value'=>$entity['title'],'placeholder'=>'※必須項目','style' =>'width:160px'])?>-->
        著者：<input name="author" type="text" value="<?php echo $entity['author']?>" placeholder="※必須項目" style="width:150px"><br/>
	出版年：<input name="released_in" type="text" value="<?php echo $entity['released_in']?>" placeholder="※必須項目　※半角" style="width:150px"><br/>                
    </fieldset>
<?=$this->Form->button("登録") ?>
<?=$this->Form->end() ?>            		                                               
                              		
              
		