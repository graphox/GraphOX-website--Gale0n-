<?php

class ForumController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Forum'),
		));
	}

	public function actionCreate() {
		$model = new Forum;


		if (isset($_POST['Forum'])) {
			$model->setAttributes($_POST['Forum']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->forum_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Forum');


		if (isset($_POST['Forum'])) {
			$model->setAttributes($_POST['Forum']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->forum_id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Forum')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Forum');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Forum('search');
		$model->unsetAttributes();

		if (isset($_GET['Forum']))
			$model->setAttributes($_GET['Forum']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}