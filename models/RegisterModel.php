<?php


namespace app\models;
use app\core\Model;

class RegisterModel extends Model
{
    public string $firstname='';
    public string $lastname='';
    public string $email='';
    public string $password='';
    public string $confirmpassword='';

    public function register()
    {
        // foreach ($data as $key => $value){
        //     if (property_exists($this,$key)){
        //         $this->{$key} = $value;
        //     }
        // }
        echo "create new user";
    }

    public function rules():array{
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED,[self::RULE_MIN,'min'=>3],[self::RULE_MAX,'max'=>14]],
            'confirmpassword' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match' =>'password' ]],
        ];
    }

}