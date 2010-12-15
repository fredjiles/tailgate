<?php $this->title('Signup');?>
<p>Thank you for signing up.  We will not fail to impress you everytime you use
    our system.  If you have any feature recommendations pass them along here.
</p>
<?php  $this->form->config(array('templates' => array('error' => '<div class="error"{:options}>{:content}</div>'))); ?>

<?=$this->form->create($member,array('class'=>'li3',"type" => "file",'id'=>'album-form'));?>

    <?=$this->form->field('name')?>
	<?=$this->form->field('email')?>
    <?=$this->form->field('password',array('type'=>'password'))?>
    <?=$this->form->field('password2',array('label'=>'Confirm Password','type'=>'password'))?>
	
    <?=$this->form->submit('Sign Up')?>

<?=$this->form->end();?>