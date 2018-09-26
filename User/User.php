<?php
Namespace User;

/**
 * Created by PhpStorm.
 * User: James Polk
 * Date: 9/18/2018
 * Time: 2:15 AM
 */
class User {
    protected $userId;
    protected $firstName;
    protected $lastName;
    protected $emailAddress;
    protected $userName;
    protected $password;
    protected $memberSince;
    protected $isLoggedIn;


    function __construct ( $firstName, $lastName, $userName, $emailAddress, $password ) {
        $this -> firstName = $firstName;
        $this -> lastName = $lastName;
        $this -> userName = $userName;
        $this -> emailAddress = $emailAddress;
        $this -> password = $password;
        # $this->memberSince = today's date
    }


    function getFirstName () {
        return $this -> firstName;
    }


    function getLasName () {
        return $this -> lastName;
    }


    function getUsername () {
        return $this -> userName;
    }


    function getEmail () {
        return $this -> emailAddress;
    }


    function setPassword ( $password ) {
        $this -> password = $password;
    }


    function isLogged () {
        return $this -> isLoggedIn;
    }
    //TODO: email verification
    //TODO: password verification
    //TODO: change password
    //TODO: Check username
    //TODO: password criteria

}