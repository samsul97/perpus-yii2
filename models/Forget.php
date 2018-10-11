<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * LoginForm is the model basename(path)ehind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Forget extends Model
{
    public $email;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // [['password','date_var'],'safe'],
            // ['password', 'required', 'on' => ['register']],
            // ['password', 'string', 'min' => 6, 'max' => 72, 'on' => ['register', 'create']],
            // ['username', 'match', 'pattern' => '/^\d{10}$/', 'message'=> 'Kolom harus terisi 10 digit'],
            // [['passwordConfirm'], 'compare', 'compareAttribute' => 'password'],
            [['email'], 'unique'],
            ['verifyCode', 'captcha'],
            ['token', function ($attribute, $params) {
            if (!ctype_alnum($this->$attribute)) {
                $this->addError($attribute, 'The token must contain letters or digits.');
        }
    }],
        ];
    }
}
