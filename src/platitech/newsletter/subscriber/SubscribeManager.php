<?php

namespace platitech\newsletter\subscriber;

use platitech\newsletter\config\Config;
use platitech\newsletter\subscriber\entity\Subscribers;

class SubscribeManager
{


    /**
     * SubscribeManager constructor.
     * @param $connection
     */
    public function __construct($connection)
    {
        Config::setConn($connection);
    }


    public function subscribe($name, $email){
        $token = password_hash($email, PASSWORD_DEFAULT);
        $sql = "INSERT INTO ".Config::getTableName()." (name, email, token) values (:name, :email, :token)";
        $stmt = Config::getConn()->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        return true;
    }

    public function unSubscribe($token){
        $sql  = "DELETE FROM "+Config::getTableName()." WHERE token = ?";
        $stmt = Config::getConn()->prepare($sql);
        $stmt->bindParam(1, $token);
        $stmt->execute();
        return true;
    }

}