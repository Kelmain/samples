<?php

function getListUsers($db){
    $requete = $db ->prepare('SELECT * from users');
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}