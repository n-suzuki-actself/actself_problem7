<title>ログイン画面</title>
<?php echo $this->Form->create()?>
<!--    <form action="login" method="post">-->
    <h1>ログイン画面</h1>
        <fieldset>
            <?php if(isset($error_messsage)){echo $error_messsage;} ?>
            <?php echo $this->Form->input('ID', ['name'=>'mail_address','type' => 'text', 'style' =>'width:150px'])?>
<!--            ID：<input name="mail_address" type="text" style="width:150px"><br/>-->
            <?php echo $this->Form->input('パスワード', ['name'=>'password','type' => 'text', 'style' =>'width:150px'])?>
<!--            パスワード：<input name="password" type="text" style="width:150px"><br/>-->

        </fieldset>
    <?php echo $this->Form->button("送信") ?>
    <?php echo $this->Form->end() ?>
<!--	<input type="submit" value="送信">-->
<!--    </from>-->
        
	<br/>
        <br/>                	

