<?php


class route {

    private static $_routes = [];

    static public function add(string $route, string $function):void {
        self::$_routes[$route] = $function;
    }

    static public function getFunctionToRun(string $url):?array {
        $url = current(explode("?",$url));
        $url_segments = explode("/",$url);

        if(count(self::$_routes)) {
            foreach(self::$_routes as $route => $function) {
                $segments = explode("/",$route);

                $anchors = getVariablesBetweenBrackes($route);

                $correct = true;
                $args = [];
                if(count($segments)!=count($url_segments))
                    $correct = false;
                else {
                    if(count($segments)) {
                        foreach($segments as $skey => $segment) {
                            $cleared_segment = str_replace(['{','}'],['',''],$segment);
                            if($segment!=$url_segments[$skey]&&!in_array($cleared_segment, $anchors)) {
                                $correct = false;
                                break;
                            }
                            elseif(in_array($cleared_segment, $anchors))
                                $args[] = $url_segments[$skey];
                        }
                    }
                    else
                        $correct = false;
                }

                if($correct)
                    return [
                        'function'=>$function,
                        'args'=>$args
                    ];
            }
        }

        return [
            'function'=>'',
            'args'=>[]
        ];
    }

}