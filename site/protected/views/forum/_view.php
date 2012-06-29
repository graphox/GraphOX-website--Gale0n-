<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('forum_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->forum_id), array('view', 'id' => $data->forum_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('name')); ?>:
	<?php echo GxHtml::encode($data->name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('description')); ?>:
	<?php echo GxHtml::encode($data->description); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('type')); ?>:
	<?php echo GxHtml::encode($data->type); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('parentforum')); ?>:
	<?php echo GxHtml::encode($data->parentforum); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('last_poster_name')); ?>:
	<?php echo GxHtml::encode($data->last_poster_name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('last_poster_id')); ?>:
	<?php echo GxHtml::encode($data->last_poster_id); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('last_thread')); ?>:
	<?php echo GxHtml::encode($data->last_thread); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('last_post_id')); ?>:
	<?php echo GxHtml::encode($data->last_post_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('last_post_time')); ?>:
	<?php echo GxHtml::encode($data->last_post_time); ?>
	<br />
	*/ ?>

</div>