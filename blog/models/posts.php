<?php


function addContent($db, $aParames){
    $requete = $db ->prepare('INSERT INTO blog_posts (categories_id, posts_title, posts_content, user_id,posts_date)
VALUES (:categories, :title, :content, :users, NOW())');
    $requete->execute($aParames);



}



function getPost($db,$id){
    
    $requete = $db->prepare('SELECT blog_posts.*, users.user_name,categories.tag from blog_posts 
    INNER JOIN users ON user_id=users.id
    INNER JOIN categories ON categories_id=categories.id
    WHERE blog_posts.id=:id');
	$requete->execute($id);
    
	return $requete->fetch(PDO::FETCH_ASSOC);
    
}



function getListPosts($db){
    $requete = $db ->prepare('SELECT blog_posts.*, users.user_name,categories.tag from blog_posts 
    INNER JOIN users ON user_id=users.id
    INNER JOIN categories ON categories_id=categories.id
    
    ORDER BY posts_date DESC');
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}


function deletePost ($db, $id){
    $requete = $db ->prepare('DELETE FROM blog_posts WHERE id = :id');
    $requete->execute($id);

}






function selectEditPost ($db, $id)
{
    $requete = $db->prepare('SELECT blog_posts.*, users.id ,users.user_name,categories.id , categories.tag from blog_posts 
    INNER JOIN users ON user_id=users.id
    INNER JOIN categories ON categories_id=categories.id  WHERE blog_posts.id = :id');
    $requete->execute($id);
    return $requete->fetch(PDO::FETCH_ASSOC);
}


function editPost($db, $aEditParames){
    $requete = $db ->prepare('UPDATE blog_posts SET categories_id = :categories, posts_title = :title, posts_content = :content, user_id = :users WHERE id = :id');
    $requete->execute($aEditParames);


}





































