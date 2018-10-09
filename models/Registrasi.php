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
class Registrasi extends Model
{
    public $username;
    public $password;
    public $nama;
    public $alamat;
    public $telepon;
    public $email;
    public $verifyCode;
    // public $captcha;
    // public $recaptcha;
    // public $email_var;
    // public $rememberMe = true;
    // private $_user = false;


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
            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i'],
            [['nama', 'alamat', 'password'], 'required', 'message'=> 'Data tidak boleh kosong'],
            // ['recaptcha', 'compare', 'compareAttribute' => 'captcha', 'operator' => '=='],
            ['telepon', 'match', 'pattern' => '/((\+[0-9]{6})|0)[-]?[0-9]{7}/'],
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
