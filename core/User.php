<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 16/01/2018
 * Time: 15:33
 */

class User {
    private $name, $email, $password, $accountType,$activation,$dateCreation;

    public function __construct($name, $email, $password, $accountType,$activation,$dateCreation)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->accountType = $accountType;
        $this->activation = $activation;
        $this->dateCreation = $dateCreation;
    }

    public function __sleep()
    {
        return array('name', 'email', 'password', 'accountType', 'activation');
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


    public function getAccountType()
    {
        return $this->accountType;
    }


    public function getActivation()
    {
        return $this->activation;
    }


    public function getDateCreation()
    {
        return $this->dateCreation;
    }






}