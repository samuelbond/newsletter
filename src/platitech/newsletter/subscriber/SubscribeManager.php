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
        $subscriber = new Subscribers();
        $subscriber->setName($name);
        $subscriber->setEmail($email);
        $subscriber->setToken(password_hash($email, PASSWORD_DEFAULT));
        $sql = "INSERT INTO ".Config::getTableName()." (name, email, token) values (?, ?, ?)";
        $stmt = Config::getConn()->prepare($sql);
        $stmt->bindParam(1, $subscriber->getName());
        $stmt->bindParam(2, $subscriber->getEmail());
        $stmt->bindParam(3, $subscriber->getToken());
        $stmt->execute();
        return $subscriber;
    }

    public function unSubscribe($token){
        $sql  = "DELETE FROM "+Config::getTableName()." WHERE token = ?";
        $stmt = Config::getConn()->prepare($sql);
        $stmt->bindParam(1, $token);
        $stmt->execute();
        return true;
    }

}