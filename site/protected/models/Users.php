<?php

/**
 * This is the model class for table "yii_users".
 *
 * The followings are the available columns in table 'yii_users':
 * @property integer $id
 * @property string $user_name
 * @property string $user_pass
 * @property string $user_mail
 * @property string $user_mail
 * @property string $user_group
 * @property string $user_acti
 * @property string $user_acti_pass
 */
class Users extends CActiveRecord {

    public $user_pass_check;
    public $verifyCode;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'yii_users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_name, user_pass, user_pass_check, user_mail', 'required'),
            array('user_name, user_mail', 'unique'),
            array('user_name', 'length', 'max' => 20),
            array('user_pass', 'length', 'max' => 30),
            array('user_pass_check', 'length', 'max' => 30),
            array('user_mail', 'length', 'max' => 100),
            array('user_pass_check', 'compare', 'compareAttribute' => 'user_pass'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_name, user_pass, user_mail', 'safe', 'on' => 'search'),
            // verifyCode needs to be entered correctly
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
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
            'user_name' => 'User Name',
            'user_pass' => 'User Pass',
            'user_pass_check' => 'Repeat User Pass',
            'user_mail' => 'User Mail',
            'verifyCode' => 'Verification Code',
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
        $criteria->compare('user_name', $this->user_name, true);
        $criteria->compare('user_pass', $this->user_pass, true);
        $criteria->compare('user_mail', $this->user_mail, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function beforeSave() {
        if ($this->user_acti != 3) {
            $this->user_pass = Security::hash($this->user_pass);
            $this->user_acti_pass = Security::hash($this->id . $this->user_name . $this->user_pass, 'sha1');
        }
        return true;
    }

}