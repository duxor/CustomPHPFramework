<?php

class DBConfig{
    public static function get(){
        return json_encode([
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'database' => 'test'
        ]);
    }
}