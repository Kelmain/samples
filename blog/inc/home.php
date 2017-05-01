<?php

$aCategories = getListCateg($db);
$aPosts = getListPosts($db);
$aUsers = getListUsers($db);

include ('views/index.phtml');