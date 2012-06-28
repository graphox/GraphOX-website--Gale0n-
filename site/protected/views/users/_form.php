<?php if (Yii::app()->user->hasFlash('register')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('register'); ?>
    </div>

<?php else: ?>

    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'users-form',
            'enableAjaxValidation' => false,
                ));
        ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'user_name'); ?>
            <?php echo $form->textField($model, 'user_name', array('size' => 20, 'maxlength' => 20)); ?>
            <?php echo $form->error($model, 'user_name'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'user_pass'); ?>
            <?php echo $form->textField($model, 'user_pass', array('size' => 30, 'maxlength' => 30)); ?>
            <?php echo $form->error($model, 'user_pass'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'user_pass_check'); ?>
            <?php echo $form->textField($model, 'user_pass_check', array('size' => 30, 'maxlength' => 30)); ?>
            <?php echo $form->error($model, 'user_pass_check'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'user_mail'); ?>
            <?php echo $form->textField($model, 'user_mail', array('size' => 60, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'user_mail'); ?>
        </div>

        <?php if (CCaptcha::checkRequirements()): ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'verifyCode'); ?>
                <div>
                    <?php $this->widget('CCaptcha'); ?>
                    <?php echo $form->textField($model, 'verifyCode'); ?>
                </div>
                <div class="hint">Please enter the letters as they are shown in the image above.
                    <br/>Letters are not case-sensitive.</div>
                <?php echo $form->error($model, 'verifyCode'); ?>
            </div>
        <?php endif; ?>

        <div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        </div>
        <?php $this->endWidget(); ?>

    </div><!-- form -->

<?php endif; ?>