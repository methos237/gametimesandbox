<?php
require 'OpenTDBGetter.php';

$content =  (OpenTDBGetter::getQuestionsURL(10,null, 10, "medium", "multiple"));

//$contents = file_get_contents($content);

//$data = json_decode($contents);

$data = (OpenTDBGetter::getDecodedJSONFromURL($content));

$tokenTest = (OpenTDBGetter::requestToken());

echo '<pre>';
//print_r(json_decode($contents));
print_r($data);
print_r($tokenTest);
print_r($data->results[0]->question);
echo '</pre>';






