<?php



function getListCateg($db){
    $requete = $db ->prepare('SELECT id, tag from categories');
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}