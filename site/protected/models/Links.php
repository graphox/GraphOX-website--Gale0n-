<?php

/**
 * This is the model class for table "yii_links".
 *
 * The followings are the available columns in table 'yii_links':
 * @property integer $id
 * @property string $link_label
 * @property string $link_title
 * @property string $link_url
 */
class Links extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Links the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'yii_links';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, link_label, link_url', 'required'),
            array('id', 'numerical', 'integerOnly' => true),
            array('link_label, link_title, link_url', 'length', 'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, link_label, link_title, link_url', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'link_label' => 'Link label',
            'link_title' => 'Link title',
            'link_url' => 'Link URL',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('link_label', $this->link_label, true);
        $criteria->compare('link_title', $this->link_title, true);
        $criteria->compare('link_url', $this->link_url, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}