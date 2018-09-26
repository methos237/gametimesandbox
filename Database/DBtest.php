<?php
/**
 * DBtest.php
 * @author James Knox Polk <james@polkcreative.com>
 * Date: 9/23/2018
 * Time: 5:34 PM
 */

require_once 'DBConnect.php';

print_r2(displayUsers());


function displayUsers () {
	$db = $db = \Database\DBConnect::instance();
	$data = $db->getAll("SELECT * FROM `users`");
	return $data;
}


function print_r2 ( $_val ) {
	echo '<pre>';
	print_r ($_val);
	echo '</pre>';
}