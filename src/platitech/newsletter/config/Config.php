<?php

namespace platitech\newsletter\config;


class Config
{
    /**
     * @var string
     */
    private static $tableName = "newsletter_list";
    /**
     * @var \PDO
     */
    private static $conn;

    /**
     * @return string
     */
    public static function getTableName()
    {
        return self::$tableName;
    }

    /**
     * @param string $tableName
     */
    public static function setTableName($tableName)
    {
        self::$tableName = $tableName;
    }

    /**
     * @return \PDO
     */
    public static function getConn()
    {
        return self::$conn;
    }

    /**
     * @param \PDO $conn
     */
    public static function setConn($conn)
    {
        self::$conn = $conn;
    }



}