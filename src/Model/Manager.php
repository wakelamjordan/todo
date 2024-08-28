<?php

namespace App\Model;

use PDO;
use PDOException;

require_once("../Config/params.php");

class Manager
{
    private static $connexion;

    public static function getConnexion()
    {
        $host = HOST;
        $dbname = DBNAME;
        $user = USER;
        $password = PASSWORD;


        // exit;
        // $user=self::$user;
        // $password=self::$password;

        if (self::$connexion === null) {

            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

            try {
                self::$connexion = new PDO($dsn, $user, $password);
                // return $pdo;
            } catch (PDOException $e) {
                echo "<h1>Erreur de connexion à la base de données: " . $e->getMessage() . "</h1>";
                die;
            }
        }
        return self::$connexion;
    }

    public function request($obj, $sql, $variables = [])
    {
        $connexion = self::getConnexion();

        $request = $connexion->prepare($sql);

        $request->execute($variables);

        $count = $request->rowCount();

        if ($count != 0) {
            if (!$obj) {
                $result = $request->setFetchMode(PDO::FETCH_ASSOC);
            } else {
                $request->setFetchMode(PDO::FETCH_CLASS, $obj);
            }
            if ($count > 1) {
                $result = $request->fetchAll();
            } else {
                // $result = $request->setFetchMode(PDO::FETCH_ASSOC);
                // $request->setFetchMode(PDO::FETCH_CLASS, $obj);
                $result = $request->fetch();
            }
            // echo 'ejeje';
            return $result;
        }
    }
}
