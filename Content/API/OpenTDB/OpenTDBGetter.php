<?php
Namespace Content;

/**
 * The OpenTDBGetter class is a class containing static methods to interface with the OpenTDB API.
 *
 * Creation
 * User: Jamie Weathers
 * Date: 9/10/2018
 * Time: 6:15 PM
 *
 * @author Jamie Weathers
 * @author James Knox Polk <jkpolk@uncg.edu>
 */
class OpenTDBGetter {
    /**
     * Returns the URL as a string to be used for a get call.
     *
     * @param $_questionCount : ?amount=<1 to 50>.
     * @param $_sessionToken : Token string.
     * @param $_questionDifficulty : ?difficulty=<hard, medium, easy>.
     * @param $_questionCategory : ?category=<9 to 31>.
     * @param $_questionType : ?type=<multiple, boolean>.
     *
     * @return string get request URL to a JSON representation of OpenTDB's questions.
     */
    public static function getQuestionsURL ( $_questionCount, $_sessionToken = NULL, $_questionCategory = NULL, $_questionDifficulty = NULL, $_questionType = NULL ) {

        $url_openTDB = "https://opentdb.com/api.php?";

        $qCount = "amount=$_questionCount";

        $getURL = $url_openTDB . $qCount;

        // TODO: Scrub the parameter input to verify the input is correct.

        if ( $_questionDifficulty != NULL ) {
            $qDiff = "&difficulty=$_questionDifficulty";
            $getURL .= $qDiff;
        }
        if ( $_questionCategory != NULL ) {
            $qCat = "&category=$_questionCategory";
            $getURL .= $qCat;
        }
        if ( $_questionType != NULL ) {
            $qType = "&type=$_questionType";
            $getURL .= $qType;
        }
        if ( $_sessionToken != NULL ) {
            $sToken = "&token=$_sessionToken";
            $getURL .= $sToken;
        }

        return $getURL;
    }


    /**
     * Gets a decoded JSON from a URL.
     * @param $_getURL The URL of the JSON to be decoded.
     * @return mixed The php structure of a JSON from the given URL.
     */
    public static function getDecodedJSONFromURL ( $_getURL ) {
        $contents = file_get_contents ( $_getURL );
        return json_decode ( $contents );
    }


    /**
     * Resets a given token.
     * @param $_sessionToken Token to be reset.
     */
    public static function resetToken ( $_sessionToken ) {

        $postURL = "https://opentdb.com/api_token.php?command=reset&token=$_sessionToken";
        // TODO: Log "Token 'X' Reset" at HR:MIN:SEC, MM/DD/YY.
    }


    /**
     * Gets a new token from OpenTDB.
     * @return The received token from the API call.
     */
    public static function requestToken () {

        $url = "https://opentdb.com/api_token.php?command=request";
        $contents = file_get_contents ( $url );
        $data = json_decode ( $contents );
        // TODO: Log Token Received: 'X' at HR:MIN:SEC, MM/DD/YY.

        return $data -> token;
    }

}