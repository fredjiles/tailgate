<?php $this->title('Member');?>
<?php if($tailgate) : ?>
<hgroup id="tailgate-info">
    <h2><?=$tailgate->event?></h2>
    <h3><?=$tailgate->name?> <span><?=date('m/d/Y',$tailgate->date)?></span></h3>
</hgroup>

        <?=$this->html->link('Invite people',array('controller'=>'invites','action'=>'add','id'=>$tailgate->_id));?>

<?=$this->form->create($tailgate,array());?>
    
    
	<?=$this->form->select('id',$all)?>
    
	
    <?=$this->form->submit('Go')?>

<?=$this->form->end();?>
<?php endif; ?>
<section id="member-info">
   <img src="/img/members/profile/<?=$member->_id?>" />
    <h4><?=$member->name?> <?=$this->html->link('Edit','members::edit')?></h4>
    <?= $this->html->link('Add a Tailgate','tailgates::add');?><br>
<h5>Invitations</h5>
<?php if($invites){
	foreach($invites as $invite){?>
	<?=$invite->event;?> <?=$this->html->link('join','/invites/join/'.$invite->_id)?>
	<br>
	<?php }
}
?>
</section>
<?php if($tailgate) : ?>
<section id="comments">
	<h4>Comments</h4>
	    <?php if(!empty($tailgate->comments)){

        foreach($tailgate->comments->data() as $comment){
            echo '<article>';
            echo $this->html->image('/img/members/small/'.$comment['member_id'].'.jpg');
            echo '<p>'.$comment['post'];
            echo '<span>'.$comment['member_name'].' '.date('h:m a m/d/Y',$comment['datetime']).'</span>';
            echo '</p>';
            echo '</article>';
        }
    }else{
		echo '<p>No Comments yet.  Earn major JuJu by being the first to post a comment</p>';
	}
    ?>
<?php  $this->form->config(array('templates' => array('error' => '<div class="error"{:options}>{:content}</div>'))); ?>

<?=$this->form->create($tailgate,array('class'=>'li3','id'=>'album-form','action'=>'comment'));?>

    
	<?=$this->form->hidden('_id')?>
    <?=$this->form->hidden('member_id',array('value'=>$member->_id))?>
	<?=$this->form->field('post',array('type'=>'textarea','label'=>'Comment'))?>
	
    <?=$this->form->submit('Post Comment')?>

<?=$this->form->end();?>

</section>
<?php else : ?>
<p>You are not currently involved in any tailgates on our system.  Use the link on the left to add a tailgate, or the search (coming soon) to find a
    tailgate.</p>
<?php endif;
?>
<script type="text/javascript">
    $(document).ready(function(){
$(window).bind('scroll', function(){
   console.log($(this).scrollTop());
});
});
</script>