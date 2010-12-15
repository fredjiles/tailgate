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
	
    <?=$this->form->submit('Save')?>

<?=$this->form->end();?>
<h4>Change Profile Image</h4>
<?=$this->html->image('/img/members/profile/'.$member->_id.'.jpg',array('id'=>'profile-image'))?>
<div id="file-uploader">

</div>
<?php echo $this->html->script(array('fileuploader'),array('inline'=>'false')); ?>
<script type="text/javascript">

$(document).ready(function(){
	var uploader = new qq.FileUploader({

        element: $('#file-uploader')[0],

		 action: '/images/addProfileImage/',

         onComplete: function(id, fileName, responseJSON){

			console.log(responseJSON);
            $('#profile-image').attr('src',responseJSON.file);

		},

		showMessage: function(message){

		}
		 });

});


</script>