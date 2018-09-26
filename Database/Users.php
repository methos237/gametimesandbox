<?php
namespace Database;

/**
 * Last Updated: 9/25/2018
 *
 * Description: Class that creates a user record in the database
 *
 * @author James Knox Polk <jkpolk@uncg.edu>
 *
 */

define ( 'PWSALT', '7qyXQr86AwT^L6B_39ku^Af_2VtuLy7S$7wfB?zM3B%#^XG&F+P-Z^7r?6RVj&B2W_MZPhuu7_=2s+YS*_?QzPay9S2C_-?SC?k#VG3yh+tdn$SG*UgZYR2L8rW-!QH%4L4q8wA!Zcw2eKPC2LUg7^kQDq-5xLM2Lc%qQqFzMLpJ@Dbckn8*cf!+w6HAV_kNVs%+-Hq?m_QAxBJv#Lf*zw$myEg#yCMm@WPC+?V9rS@GeT#5q3fD-MJD%pvTD!eg' );

class Users {
    private $userName;
    private $password;
    private $firstName;
    private $lastName;
    private $emailAddress;
    private $salt;


    public function __construct ( string $_userName, string $_password, string $_firstName, string $_lastName, string $_emailAddress ) {
        $this -> salt = PWSALT;
        $this -> userName = $_userName;
        $this -> password = $_password;
        $this -> emailAddress = $_emailAddress;
        $this -> firstName = $_firstName;
        $this -> lastName = $_lastName;
    }


    public static function checkEmail ( $_email ) {
        if ( filter_var ( $_email, FILTER_VALIDATE_EMAIL ) ) {
            $result = $_email;
        } else {
            echo ( "$_email is not valid" );
        }

        return $result;
    }


    public function getEmailAddress () {
        return $this -> emailAddress;
    }


    public function getFirstName (): string {
        return $this -> firstName;
    }


    public function getLastName (): string {
        return $this -> lastName;
    }


    public function getPassword (): string {
        return $this -> password;
    }


    public function getSalt (): string {
        return $this -> salt;
    }


    public function getUserName (): string {
        return $this -> userName;
    }


    public function print_r2 ( $_val ) {
        echo '<pre>';
        print_r ( $_val );
        echo '</pre>';
    }


    public function setEmailAddress ( $emailAddress ): void {
        $this -> emailAddress = $emailAddress;
    }


    public function setFirstName ( string $firstName ): void {
        $this -> firstName = $firstName;
    }


    public function setLastName ( string $lastName ): void {
        $this -> lastName = $lastName;
    }


    public function setPassword ( string $password ) {
        $this -> password = $password;
    }


    public function setUserName ( string $userName ): void {
        $this -> userName = $userName;
    }
}