<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 10/5/14
 * Time: 11:32 PM
 */

if(!isset($_COOKIE['visits']))
{
    $_COOKIE['visits']=0;
}
$visits=$_COOKIE['visits']+1;
setcookie('visits',$visits,time()+3600*24*365);

include 'welcome.html.php';