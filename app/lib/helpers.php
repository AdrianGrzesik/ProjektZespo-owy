<?php
//file management section
function base_path():string {
    return current(explode('/public',$_SERVER['DOCUMENT_ROOT']));
}

function public_path():string {
    return base_path().'/public';
}

function app_path():string {
    return base_path().'/app';
}

function lib_path():string {
    return app_path().'/lib';
}

function resource_path():string {
    return base_path().'/resource';
}

function view_patch():string {
    return resource_path().'/views';
}

function redirect($url) {
    header('Location: '.$url);
}
//variable management 
function getVariablesBetweenBrackes($txt, $brackes_start = '{', $brackes_stop = '}') {
    $matches = [];
    preg_match_all("/\\".$brackes_start."[^\\".$brackes_stop."]*\\".$brackes_stop."/", $txt, $matches);
    $result = $matches[0];
    if(count($result)>0) {
        foreach($result as $k => $v)
            $result[$k] = str_replace([$brackes_start,$brackes_stop],['',''],$v);
    }
    return $result;
}

function codeLinkSpecialChars($link) {
    $link = mb_strtolower($link);
    $link = str_replace(array(' ','ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ź', 'ż'),array('-','a','c','e','l','n','o','s','z','z'),$link);
    return $link;
}

function randomString($charts = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $charts; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}
//cookie
function helpersSetCookie($key, $value, $expire_days_count) {
    if($expire_days_count==0)
        $expire = 0;
    else
        $expire = time()+$expire_days_count*86400;
    setcookie($key, $value, $expire);
}

function clearInputString($txt) {
    return strip_tags($txt);
}