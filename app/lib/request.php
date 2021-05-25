<?php


class request {

    private static $_variables = null;
    private static $_variables_by_method = null;

    public static function exist(string $name, string $method = null):bool {
        self::_prepareRequestVariables();
        $val = self::get($name, $method);
        if($val!==null)
            return true;
        else
            return false;
    }

    public static function get(string $name, string $method = null) {
        self::_prepareRequestVariables();
        if(!$method) {
            if (isset(self::$_variables[$name]))
                return self::$_variables[$name];
            else
                return null;
        }
        else {
            if (isset(self::$_variables_by_method[$method][$name]))
                return self::$_variables_by_method[$method][$name];
            else
                return null;
        }
    }

    private static function _prepareRequestVariables() {
        if(self::$_variables===null) {
            self::$_variables = [];
            self::$_variables_by_method = [];
            self::$_variables_by_method['post'] = [];
            self::$_variables_by_method['get'] = [];
            if (count($_GET)) {
                foreach ($_GET as $key => $val) {
                    if(is_string($val)) {
                        self::$_variables[db::real_string($key)] = db::real_string($val);
                        self::$_variables_by_method['get'][db::real_string($key)] = db::real_string($val);
                    }
                }
            }
            if (count($_POST)) {
                foreach ($_POST as $key => $val) {
                    if(is_string($val)) {
                        self::$_variables[db::real_string($key)] = db::real_string($val);
                        self::$_variables_by_method['post'][db::real_string($key)] = db::real_string($val);
                    }
                }
            }
        }
    }

}