<?php

session_start();

require app_path().'/config.php';
require lib_path().'/db.php';
require lib_path().'/queryBuilder.php';
require lib_path().'/routes.php';
require lib_path().'/views.php';
require lib_path().'/request.php';



require app_path().'/controllers/products.php';


require app_path().'/models/modelAbstract.php';
require app_path().'/models/productModel.php';



class app {

    private $_url = null;

    function __construct() {
        db::conn();
        $this->_urlInit();
        $this->_routesInit();
        $this->_pageRun();
    }

    private function _urlInit():void {
        $this->_url = $_SERVER['REQUEST_URI'];
    }

    private function _routesInit():void {
        require base_path().'/routes/web.php';
    }

    private function _pageRun():void {
        $arr = route::getFunctionToRun($this->_url);
        $function = $arr['function'];
        echo $function;
        $args = $arr['args'];
        if($function&&$function!='')
            $this->_runFunction($function, $args);
        else
            $this->_prepareError(404);
    }

    private function _runFunction(string $function, array $args):void {
        $exploded = explode('@',$function);
        if(count($exploded)==2) {
            $runed_class = new $exploded[0];
            $func_name = $exploded[1];
            $products;
            isset($args[0])?$arg1=$args[0]:$arg1=null;
            isset($args[1])?$arg2=$args[1]:$arg2=null;
            isset($args[2])?$arg3=$args[2]:$arg3=null;
            isset($args[3])?$arg4=$args[3]:$arg4=null;
            isset($args[4])?$arg5=$args[4]:$arg5=null;

            $content = $runed_class->$func_name($arg1,$arg2,$arg3,$arg4,$arg5);
            echo $arg1;
            echo $arg2;
            echo $content;
        }
    }

    private function _prepareError(string $error):void {

    }

}