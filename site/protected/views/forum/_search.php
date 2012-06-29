<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'forum_id'); ?>
		<?php echo $form->textField($model, 'forum_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'description'); ?>
		<?php echo $form->textArea($model, 'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'type'); ?>
		<?php echo $form->textField($model, 'type', array('maxlength' => 1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'parentforum'); ?>
		<?php echo $form->textField($model, 'parentforum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'last_poster_name'); ?>
		<?php echo $form->textField($model, 'last_poster_name', array('maxlength' => 120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'last_poster_id'); ?>
		<?php echo $form->textField($model, 'last_poster_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'last_thread'); ?>
		<?php echo $form->textField($model, 'last_thread', array('maxlength' => 120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'last_post_id'); ?>
		<?php echo $form->textField($model, 'last_post_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'last_post_time'); ?>
		<?php echo $form->textField($model, 'last_post_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
