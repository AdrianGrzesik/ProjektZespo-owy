<?php

class db
{
    static $mysqli = null;

    static private $_statistics = [
        'q_count'=>0,
        'time'=>0
    ];

    public static function conn() {

        if(!self::$mysqli) {

            self::$_statistics['time'] = time();

            @self::$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            if (self::$mysqli->connect_errno) {
                throw new Exception('Błąd połączenia z bazą');
            } else {
                self::$mysqli->set_charset("utf8");
            }
        }
    }

    static public function query($query) {
        self::$_statistics['q_count']++;
        return self::$mysqli->query($query);
    }

    static public function real_string($txt) {
        return mysqli_real_escape_string(self::$mysqli, $txt);
    }

    static public function num_rows($q) {
        return $q->num_rows;
    }

    static public function fetch_array($q) {
        return $q->fetch_array();
    }

    static public function fetch_assoc($q) {
        return $q->fetch_assoc();
    }

    static public function fetch_object($q) {
        return $q->fetch_object();
    }

    static public function insert_id() {
        return self::$mysqli->insert_id;
    }

    static public function showStatistics() {
        $content = '';
        foreach(self::$_statistics as $key => $val)
            $content .= $key.': '.$val."\n";

        $content .= 'Czas: '.(time()-self::$_statistics['time']).' s'."\n";

        echo $content;
    }
}

?>