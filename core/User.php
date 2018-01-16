<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 16/01/2018
 * Time: 15:33
 */

class User {
    private $name, $email, $password, $accountType;

    public function __construct($name, $email, $password, $accountType)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->accountType = $accountType;
    }

    public function __sleep()
    {
        return array('name', 'email', 'password', 'accountType');
    }

    public function __wakeup()
    {
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

}