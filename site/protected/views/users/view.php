<?php
$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Users', 'url' => array('index')),
    array('label' => 'Create User', 'url' => array('create')),
    array('label' => 'Update User', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete User', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Users', 'url' => array('admin')),
);

$user = Users::model()->findByPk($model->id);
?>

<h1>Viewing user "<?php echo CHtml::encode($model->user_name); ?>"</h1>

<div class="view">
    <p>
        User's database ID: <?php echo CHtml::encode($model->id); ?><br />
        User's EMail: <?php echo CHtml::encode($model->user_mail); ?><br />
    </p>
</div>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'user_name',
        'user_pass',
        'user_mail',
    ),
));
?>
