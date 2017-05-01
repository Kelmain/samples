<?php


if (isset($_GET['id'])){

    $id = array(':id' => $_GET['id'],);

    deletePost($db, $id);
}

$aCategories = getListCateg($db);
$aPosts = getListPosts($db);
$aUsers = getListUsers($db);
include ('views/admin.phtml');

