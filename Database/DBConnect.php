<?php
namespace Database;

/**
 * Last Updated: 9/22/2018
 *
 * Description: Wrapper class for PDO database operations.
 *
 * @author James Knox Polk <jkpolk@uncg.edu>
 *
 */

/**
 * TODO: log errors instead of echo
 * TODO: create INSERT helper
 * TODO: create UPDATE helper
 * TODO: create EMPTY TABLE helper
 */

use PDO;
use PDOException;

define ( 'DB_HOST', 'localhost' );
define ( 'DB_NAME', 'polkcre2_gametimesandbox' );
define ( 'DB_USER', 'polkcre2_gtadmin' );
define ( 'DB_PASS', 'PsY+FEn4#exV' );
define ( 'DB_CHAR', 'utf8' );

class DBConnect {

    private $debug;
    private $killOnError;
    private $options;

    protected static $instance;
    protected $pdo;


    protected function __construct () {
        $this -> debug = TRUE;
        $this -> killOnError = FALSE;

        $this -> options = array (
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => FALSE,
        );
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR;
        $this -> pdo = new PDO( $dsn, DB_USER, DB_PASS, $this -> options );
    }


    /**
     * Public access to DBConnect class
     *
     * @author     James Knox Polk <jkpolk@uncg.edu>
     * @return DBConnect
     */
    public static function instance () {
        if ( self ::$instance === NULL ) {
            self ::$instance = new self;
        }
        return self ::$instance;
    }


    /**
     * Proxy to native PDO methods
     *
     * @author     James Knox Polk <jkpolk@uncg.edu>
     *
     * @param $_method
     * @param $_args
     *
     * @return mixed
     */
    public function __call ( $_method, $_args ) {
        return call_user_func_array ( array ( $this -> pdo, $_method ), $_args );
    }


    /**
     * Helper function to smoothly run prepared statements
     *
     * @author     James Knox Polk <jkpolk@uncg.edu>
     *
     * @param       $_sql
     * @param array $_args
     *
     * @return bool|\PDOStatement
     */
    public function run ( $_sql, $_args = [] ) {
        try {
            if ( !$_args ) {
                return $this -> query ( $_sql );
            }
            $stmt = $this -> pdo -> prepare ( $_sql );
            $stmt -> execute ( $_args );
        } catch ( PDOException $e ) {
            $this -> handleError ( $e -> getMessage () );
            throw  $e;
        }
        return $stmt;
    }


    /**
     * Helper function to return one record from a database table
     *
     * @author     James Knox Polk <jkpolk@uncg.edu>
     *
     * @param       $_sql
     * @param array $_args
     *
     * @return mixed
     */
    public function getOne ( $_sql, $_args = [] ) {
        $data = $this -> run ( $_sql, $_args ) -> fetch ();
        return $data;
    }


    /**
     * Helper function to return all records from a database table
     *
     * @author     James Knox Polk <jkpolk@uncg.edu>
     *
     * @param       $_sql
     * @param array $_args
     *
     * @return array
     */
    public function getAll ( $_sql, $_args = [] ) {
        $data = $this -> run ( $_sql, $_args ) -> fetchAll ();
        return $data;
    }


    /**
     * Error handler for all database calls
     *
     * @author     James Knox Polk <jkpolk@uncg.edu>
     *
     * @param string $_error
     */
    private function handleError ( string $_error ): void {
        error_log ( $_error );
        if ( $this -> debug ) {
            echo $_error;
        }
        if ( $this -> killOnError ) {
            die( $_error );
        }
    }
}