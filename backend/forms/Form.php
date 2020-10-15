<?php
namespace app\forms;
class Form extends \yii\base\Model{
        public $email;
        public $login;
        public $password;
        
        public function rules(){
            return[
                
                [['email','login','password'],'required'],
                ['email','email'],
                ['password', 'string', 'min' => 6],
                ['login', 'string', 'min' => 4],
                ];
        }
};