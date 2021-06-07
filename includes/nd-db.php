<?php

namespace NdarkCMS;

use Mysqli;

class NDDB
{
    protected static $instance = null;
    
    public function __construct()
    {
        $this->create_db();
    }
    
    
    public static function instance()
    {
        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        
        return self::$instance;
    }
    
    // TODO: separate
    private function create_db()
    {
        $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD );
        
        if ( $mysqli->connect_errno ) {
            printf( "Connect failed: %s\n", $mysqli->connect_error );
            exit();
        }
        
        if ( !$mysqli->select_db( DB_NAME ) ) {
            echo "Couldn't select database: " . $mysqli->error;
            
            if ( !$mysqli->query( 'CREATE DATABASE IF NOT EXISTS ' . DB_NAME . ';' ) ) {
                echo "Couldn't create database: " . $mysqli->error;
            }
            $mysqli->select_db( DB_NAME );
            header( "Refresh:0" );
        }
    }
}


NDDB::instance();
