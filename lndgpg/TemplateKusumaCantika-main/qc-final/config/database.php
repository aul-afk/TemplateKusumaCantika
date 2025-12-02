<?php
class Database {
    private static $connection;

    public static function getConnection() {
        if (!self::$connection) {
            self::$connection = new mysqli("localhost", "root", "", "qc");
            if (self::$connection->connect_error) {
                die("Koneksi database gagal: " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}
