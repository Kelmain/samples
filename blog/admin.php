<?php

header('Content-Type: text/html; charset=utf-8');
if (isset ($_GET['tab']))
{
    switch($_GET['tab']){
        case 'add':
        case 'user':
        case 'deleteall':
        case 'edit':
            require 'inc/'.$_GET['tab'].'.php';
            break;
        default:
            require 'inc/error_404.php';
    }
}else {
    $aCategories = getListCateg($db);
    $aPosts = getListPosts($db);
    $aUsers = getListUsers($db);

    include ('views/admin.phtml');
}

