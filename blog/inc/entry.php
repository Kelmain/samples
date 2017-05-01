<?php
$id = array (':id' => $_GET['id'],);

if (sizeof($_POST) > 0)
{
    $aCommentParames = array (
        ':posts_id'  => $_GET['id'],
        ':comment' => $_POST['comment']
    );
    addComment($db,$aCommentParames);


}


$post = getPost($db,$id);
$comments = getComments($db,$id);
$aUsers = getListUsers($db);
include ('views/entry.phtml');