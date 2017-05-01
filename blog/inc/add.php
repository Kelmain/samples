<?php




if (sizeof($_POST) > 0)
{
    $aParames = array (
        ':categories' => $_POST['categories'],
        ':title' => $_POST['title'],
        ':content' => $_POST['content'],
        ':users' => $_POST['user']

    );
    addContent($db,$aParames);

}
$aCategories = getListCateg($db);
$aPosts = getListPosts($db);
$aUsers = getListUsers($db);

include ('views/add.phtml');



