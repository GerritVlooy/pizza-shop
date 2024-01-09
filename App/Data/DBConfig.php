<?php
//Data/DBConfig.php
declare(strict_types=1);
namespace App\Data;

class DBConfig {
    
    protected static string $DB_CONNSTRING = 
    "mysql:host=localhost;dbname=cursusphp;charset=utf8";
    protected static string $DB_USERNAME = "root";
    protected static string $DB_PASSWORD = "";
}