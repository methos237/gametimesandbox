<?php
/**
 * Created by PhpStorm.
 * User: WahabEhsan
 * Date: 9/25/18
 * Time: 6:38 PM
 */

require_once 'index.php';

testingUser();

function testingUser() {
    $userTest = new User("Wahab", "Ehsan", "wahabehsan111", "wahabehsan111@hotmail.com", "123456!K");
    $testArray = ["w", "we", "ewewe"];
    $conting = count($testArray);
    print $conting;
}