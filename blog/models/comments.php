<?php
function addComment($db,$aCommentParames){

	$requete = $db->prepare("INSERT INTO comments (posts_id,comments_content,comments_date,user_id)
    VALUES (:posts_id,:comment,NOW(),1)");
	$requete->execute($aCommentParames);
    
}


function getComments($db,$id){
    
    $requete = $db->prepare('SELECT posts_id,comments_content,comments_date,user_id,users.user_name from comments 
    INNER JOIN users ON user_id=users.id
    WHERE posts_id= :id
    ORDER BY comments_date DESC');
	$requete->execute($id);
    
	return $requete->fetchAll(PDO::FETCH_ASSOC);
   
}
