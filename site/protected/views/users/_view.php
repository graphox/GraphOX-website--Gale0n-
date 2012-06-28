<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_name), array('view', 'id'=>$data->id)); ?> - 

        <b><?php echo CHtml::mailto(CHtml::encode("EMail"), $data->user_mail); ?></b>
	<br />


</div>