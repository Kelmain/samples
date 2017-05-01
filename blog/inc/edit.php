<?php
$id = array (':id' => $_GET['id'],);

selectEditPost($db,$id);


if (sizeof($_POST) > 0)
{
    $aEditParames = array (
        ':categories' => $_POST['categories'],
        ':title' => $_POST['title'],
        ':content' => $_POST['content'],
        ':users' => $_POST['user'],
        ':id'  => $_GET['id']

    );
    editPost($db,$aEditParames);


}




$aCategories = getListCateg($db);
$aPosts = getListPosts($db);
$aUsers = getListUsers($db);
$aEditPosts = selectEditPost($db, $id);
//var_dump($aEditPosts);
include ('views/edit.phtml');