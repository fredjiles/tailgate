<?=$this->title('Invite');?>
<?=$this->form->create($tailgate,array('class'=>'li3'));?>


	<?=$this->form->hidden('_id')?>
    <?=$this->form->hidden('member_id',array('value'=>$member->_id))?>
<p>Enter in emails below to send an invitation to join this tailgate.  Use a comma to seperate email addresses.</p>
	<?=$this->form->field('emails',array('type'=>'textarea','label'=>'Emails'))?>

    <?=$this->form->submit('Send Invite')?>

<?=$this->form->end();?>
