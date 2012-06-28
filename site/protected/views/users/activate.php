<div class="view">
    <?php
    if (Yii::app()->user->hasFlash('activate')) :
        echo Yii::app()->user->getFlash('activate');
    else:
        ?>

        <p>Awaiting account activation ..</p>

    <?php
    endif;
    ?>
</div>