<div class="form">


    <?php
    $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'forum-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">
        <?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
    </p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('maxlength' => 120)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div><!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('style' => 'width: 600px; height: 200px')); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div><!-- row -->
    <div class="row">
        <?php echo $form->labelEx($model, 'type'); ?>
        <?php echo $form->dropDownList($model, 'type', array('f' => 'Forum', 'c' => 'Category')) ?>
        <?php echo $form->error($model, 'type'); ?>
    </div><!-- row -->
    <div class="row">
        <?php //CVarDumper::dump(Forum::model()->findAllAttributes(null, true)); die(); ?>
        <?php echo $form->labelEx($model, 'parentforum'); ?>
        <?php echo $form->dropDownList($model, 'parentforum', array_merge(array(0 => 'None'), GxHtml::listDataEx(Forum::model()->findAllAttributes(null, true)))); ?>
        <?php echo $form->error($model, 'parentforum'); ?>
    </div><!-- row -->


    <?php
    echo GxHtml::submitButton(Yii::t('app', 'Save'));
    $this->endWidget();
    ?>
</div><!-- form -->