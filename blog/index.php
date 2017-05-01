<?php
header('Content-Type: text/html; charset=utf-8');
require ('inc/connectionDB.php');
require ('models/categories.php');
require ('models/posts.php');
require ('models/users.php');
require ('models/comments.php');


if (isset ($_GET['page']))
{
    switch($_GET['page']){
        case 'admin':
            
           require 'admin.php';
            
            break;
            case 'entry':
            require 'inc/entry.php';
            break;
            default:
            require 'inc/error_404.php';
    }
}else {

    include ('inc/home.php');
}





























//var_dump($aParames);
//include ('admin.php');



