<?php
namespace Database;

/**
 * Last Updated: 9/25/2018
 *
 * Description: Creates a user record in the database
 *
 * @author James Knox Polk <james@polkcreative.com>
 *
 */

require_once ( 'DBConnect.php' );


class CreateUser extends Users {
    private $db;
    private $data;
    private $active;


    public function __construct ( string $_userName, string $_password, string $_firstName, string $_lastName, string $_emailAddress ) {
        parent ::__construct ( $_userName, $_password, $_firstName, $_lastName, $_emailAddress );

        $salt = parent ::getSalt ();
        $userName = $_userName;
        $password = $this -> saltPassword ( $_password, $salt );
        $email = parent ::checkEmail ( $_emailAddress );
        $firstName = ucwords ( strtolower ( $_firstName ) );
        $lastName = ucwords ( strtolower ( $_lastName ) );
        $this -> active = 1;

        parent ::print_r2 ( $this -> insertUser ( $userName, $password, $firstName, $lastName, $email, $this -> active ) );
    }


    private function insertUser ( string $_userName, string $_password, string $_firstName, string $_lastName, string $_emailAddress, string $_active ) {
        $this -> db = DBConnect ::instance ();
        //$this->data = $this->db->run("INSERT INTO `users` (`uName`,`uPassword`,`uFirstName`,`uLastName`,`uEmail`,`uActive`) VALUES (?,?,?,?,?,?);",[ $_userName, $_password, $_firstName, $_lastName, $_emailAddress, $_active] );
        $this -> data = [ $_userName, $_password, $_firstName, $_lastName, $_emailAddress, $_active ];
        return $this -> data;
    }


    private static function saltPassword ( $_password, $_salt ) {
        $saltedPassword = "AES_ENCRYPT('$_password','$_salt'";

        return $saltedPassword;
    }
}