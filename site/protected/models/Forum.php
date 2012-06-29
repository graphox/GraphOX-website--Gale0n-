<?php

Yii::import('application.models._base.BaseForum');

class Forum extends BaseForum
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}