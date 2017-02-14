
<h1>書籍情報登録</h1>                
		<?=$this->Form->create($entity , ['url'=>['action'=>'add']])?>		
                <fieldset>
		タイトル：<input name="title" type="text" style="width:150px"><br/>
		著者：<input name="author" type="text" style="width:150px"><br/>
		出版年：<input name="released_in" type="text" style="width:50px"><br/>                    
                </fieldset>
                <?=$this->Form->button("登録") ?>
                <?=$this->Form->end() ?>            		                                               
                              		
              
		