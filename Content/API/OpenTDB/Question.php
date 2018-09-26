<?php
/**
 * Created by PhpStorm.
 * User: jwthrs
 * Date: 9/25/2018
 * Time: 6:07 PM
 */
// Question class pulls information from OUR database.
require_once "../../../Database/DBConnect.php";
require 'OpenTDBGetter.php';

class Question {

    /**
     * Inserts three question sets for the game to use for the day.
     */
    public static function insertDailyQuestionSets() {

        // Using a token insures we don't get repeat questions.
        $token = (OpenTDBGetter::requestToken());
        insertDailyToken($token);

        // Connecting to database.
        $db = \Database\DBConnect::instance();

        // Insert three daily question sets.

        // FIXME: Code smell - many similar statements executed. Refactor?
        $content =  (OpenTDBGetter::getQuestionsURL(10,$token, 10, "easy", "multiple"));
        $data = (OpenTDBGetter::getDecodedJSONFromURL($content));
        insertJSONResultsToDB("questionSet1", $data, $db);

        $content =  (OpenTDBGetter::getQuestionsURL(10,$token, 10, "medium", "multiple"));
        $data = (OpenTDBGetter::getDecodedJSONFromURL($content));
        insertJSONResultsToDB("questionSet2", $data, $db);

        $content =  (OpenTDBGetter::getQuestionsURL(10,$token, 5, "medium", "multiple"));
        $data = (OpenTDBGetter::getDecodedJSONFromURL($content));
        insertJSONResultsToDB("questionSet3", $data, $db);
    }

    /**
     * Inserts question json results
     * @param $data
     */
    public static function insertJSONResultsToDB($_questionSetName, $_data, $_db) {

        // TODO: If response code other than 0, error report.

        for ($i = 0; $i < count($_data->results); $i++) {
            insertQuestionToDB($_questionSetName, $_db, $_data->results[$i], $i);
        }

        /*
        // For each result in the results array of the json, input as question.
        foreach ($_data->results as $question) {
            insertQuestionToDB($_questionSetName, $_db, $question);
        }
        */
    }

    public static function insertQuestionToDB($_questionSetName, $_db, $_question, $_qID) {
        $_db->run("INSERT INTO $_questionSetName (qID, qCategory, qDifficulty, qQuestion, qAnswer, qIncorrect1, qIncorect2, qIncorrect3) 
                  VALUES ($_qID, $_question->category, $_question->difficulty, $_question->question, $_question->correct_answer, $_question->incorrect_answers[0], $_question->incorrect_answers[1], $_question->incorrect_answers[2])" );
    }

    /**
     * Pulls a specific question by QuestionSet and QuestionID from GameTime DB.
     * @param $_qSet QuestionSet
     * @param $_qID QuestionID
     */
    public static function pullQuestionFromLocalDB($_qSet, $_qID) {

    }
}