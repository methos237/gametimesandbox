<?php
/**
 * Created by PhpStorm.
 * User: James Polk
 * Date: 9/9/2018
 * Time: 5:43 PM
 */
require_once 'Users.php';

createUser();
print_r("User Added");

function createUser () {
	$uName = "test_user2";
	$uPassword = "test123";
	$uFirstName = "Jill";
	$uLastName = "Doe";
	$uEmail = "alpha@beta.info";

	$user = new \Database\Users($uName, $uPassword, $uFirstName, $uLastName, $uEmail);

	return \Database\Users::getSalt();
}
