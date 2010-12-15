

<?php  $this->form->config(array('templates' => array('error' => '<div class="error"{:options}>{:content}</div>'))); ?>

<?=$this->form->create();?>
    <?=$this->form->field('email')?>
	<?=$this->form->field('password',array('type'=>'password'))?>
    <?=$this->form->submit('Login')?>
<?=$this->form->end();?>

