<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $uid
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $groupid
 * @property integer $status
 * @property integer $addtime
 * @property string $nickname
 * @property string $sign
 * @property string $web
 * @property string $mobile
 * @property string $qq
 * @property string $last_login_ip
 * @property string $logins
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email', 'required'),
			array('status, addtime', 'numerical', 'integerOnly'=>true),
			array('username, password, email, sign, web', 'length', 'max'=>100),
			array('groupid, logins', 'length', 'max'=>10),
			array('nickname', 'length', 'max'=>50),
			array('mobile, qq', 'length', 'max'=>11),
			array('last_login_ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, username, password, email, groupid, status, addtime, nickname, sign, web, mobile, qq, last_login_ip, logins', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => Yii::t('model','uid'),
			'username' => Yii::t('model','username'),
			'password' => Yii::t('model','password'),
			'email' => Yii::t('model','email'),
			'groupid' => Yii::t('model','groupid'),
			'status' => Yii::t('model','status'),
			'addtime' => Yii::t('model','addtime'),
			'nickname' => Yii::t('model','nickname'),
			'sign' => Yii::t('model','sign'),
			'web' => Yii::t('model','web'),
			'mobile' => Yii::t('model','mobile'),
			'qq' => Yii::t('model','qq'),
			'last_login_ip' => Yii::t('model','last_login_ip'),
			'logins' => Yii::t('model','logins'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('uid',$this->uid,true);

		$criteria->compare('username',$this->username,true);

		$criteria->compare('password',$this->password,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('groupid',$this->groupid,true);

		$criteria->compare('status',$this->status);

		$criteria->compare('addtime',$this->addtime);

		$criteria->compare('nickname',$this->nickname,true);

		$criteria->compare('sign',$this->sign,true);

		$criteria->compare('web',$this->web,true);

		$criteria->compare('mobile',$this->mobile,true);

		$criteria->compare('qq',$this->qq,true);

		$criteria->compare('last_login_ip',$this->last_login_ip,true);

		$criteria->compare('logins',$this->logins,true);

		return new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * 数据保存前处理
	 * @return boolean.
	 */
	protected function beforeSave ()
	{
		if ($this->isNewRecord) {
			if($this->groupid <= 0)
			{
				$this->addError('groupid',Yii::t('admin','Group Is Required'));
				return false;
			}
			$this->password = CPasswordHelper::hashPassword($this->password, 8);
			$this->addtime = time();
		}
		return true;
	}
	
	/**
	 * 检测用户密码
	 * @param  [type] $password [description]
	 * @return [type]           [description]
	 */
	public function validatePassword($password){
		return CPasswordHelper::verifyPassword($password, $this->password);
	}
}