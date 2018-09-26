<<<<<<< HEAD
<?php
/**
 * Description: The User class
 * @author : Wahab Ehsan
 */

require_once './Database/DBConnect.php';

define('PWSALT', 'CRC7Qgz40t34NnRNJ!7sXZJ3-GaRA)md(m-3gNbGo@8gGgRbIVSGBmZw7iffzdlT');

class User{
    protected $userId;
    protected $firstName;
    protected $lastName;
    protected $emailAddress;
    protected $userName;
    protected $password;
    protected $memberSince;
    private $isLoggedIn;
    protected $db;
    protected $dataResult;

    function __construct($_firstName, $_lastName, $_userName, $_emailAddress, $_password) {
        $this->firstName = $_firstName;
        $this->lastName = $_lastName;
        $this->userName = $_userName;
        $this->emailAddress = $_emailAddress;
        $this->password = $_password;
        $this->db = \Database\DBConnect::instance();
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLasName() {
        return $this->lastName;
    }

    function getUsername() {
        return $this->userName;
    }

    function getEmail() {
        return $this->emailAddress;
    }

    function isLogged(){
        return $this->isLoggedIn;
    }

    function emailVerification($_email){
        $this->dataResult = $this->db->getOne("SELECT uId from USERS WHERE uEmail = ?", [$_email]);
        if ($this->dataResult == null){
            return FALSE;
        }
        return TRUE;
    }

    function passwordVerification($_password, $_email){
        $this->dataResult = $this->db->getOne("SELECT AES_DECRYPT(?, 'PWSALT') AS `pswd` FROM `users` WHERE `email` = ?", [$_password, $_email]);
        if ($this->dataResult == null){
            return FALSE;
        }
        return TRUE;
    }

    function changePassword($_password, $_username){
        $this->db->run("INSERT INTO `users` (`uEmail`, `uPassword`) VALUES (? , AES_ENCRYPT(?, '".PWSALT."')", [$_username, $_password]);
    }

    function usernameCheck($_username){
        $this->dataResult = $this->db->getOne("SELECT uId from USERS WHERE uName = ?", [$_username]);
        if ($this->dataResult == null){
            return FALSE;
        }
        return TRUE;
    }

    function passwordCriteriaCheck($_password){
        $passwordArray = str_split($_password);
        $passwordLength = count($passwordArray);
        $hasDigit = FALSE;
        $hasUppercase = FALSE;
        $hasSpecialChar = FALSE;
        if ($passwordLength < 6){
            return FALSE;
        }
        foreach ($passwordArray as $value) {
            if (is_numeric($value)) {
                $hasDigit = TRUE;
            }
            if (ctype_upper($value)) {
                $hasUppercase = TRUE;
            }
            if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)){
                $hasSpecialChar = TRUE;
            }
        }
        if (!$hasDigit || !$hasUppercase || !$hasSpecialChar){
            return FALSE;
        }
        return TRUE;
    }

    function createUser ($uName, $uPassword, $uFirstName, $uLastName, $uEmail){
        //TODO: Email for verification
        return $this->db->run("INSERT INTO `users` (`uName`,`uPassword`,`uFirstName`,`uLastName`,`uEmail`) VALUES (?,AES_ENCRYPT(?,'".PWSALT."'),?,?,?);", [$uName, $uPassword, $uFirstName, $uLastName, $uEmail]);
    }

    function userLogin($_username, $_password, $_email){
        if ($this->usernameCheck($_username) && $this->passwordVerification($_password, $_email)) {
           $this->isLoggedIn = TRUE;
        } else {
            return FALSE;
        }
        return TRUE;
    }
}

?>
