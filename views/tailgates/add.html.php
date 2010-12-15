<?php $this->title('Signup');?>
<p>Thank you for signing up.  We will not fail to impress you everytime you use
    our system.  If you have any feature recommendations pass them along here.
</p>
<?php  $this->form->config(array('templates' => array('error' => '<div class="error"{:options}>{:content}</div>'))); ?>

<?=$this->form->create($member,array('class'=>'li3',"type" => "file",'id'=>'album-form'));?>
    <?=$this->form->field('event');?>
    <?=$this->form->field('name')?>
	<?=$this->form->field('date',array('class'=>'datepicker'))?>
    <?=$this->form->field('location')?>
	<?=$this->form->field('time')?>
    <?=$this->form->submit('Add Tailgate')?>

<?=$this->form->end();?>