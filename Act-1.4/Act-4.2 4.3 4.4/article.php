<html>
<form  method="post">

<?php 

include('db_connection.php');



//get article by id
if (isset($_GET['id'])) {

    //secure data 
    // $id=mysqli_real_espace_string($conn,$_GET['id']);
     $id = $_GET['id'];
    //write query for an article
     $sql = "SELECT * from articles where id = $id";

     //make query and get result
     $result= mysqli_query($conn,$sql);

     //fetch the resulting rows as an array
     $article = mysqli_fetch_assoc($result);

     //free result from memory
    mysqli_free_result($result);

     //close connection
  

}

//delete article by id

if (isset($_POST['delete_post'])) {

    //secure data 
    // $id=mysqli_real_espace_string($conn,$_GET['id']);
     $id = $_POST["id_to_delete"] ;
    //write query for an article
     $sql = "DELETE from articles where id = $id";

     if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        echo '<a href=formulairearticle.php><input value="Page d acceuil" type="submit" style="margin-left:20px"/></a>';
      } else {
        echo "Error deleting record: " . mysqli_error($conn);
      }
      
   
}


//add comment to an article 
if (isset($_POST['add_comment']))  
{
$texte = isset($_POST['texte_comment']) ? $_POST['texte_comment'] : '';
$auteur = isset($_POST['auteur_comment']) ? $_POST['auteur_comment'] : '';
$id_article = $article['id'] ; 



//create sql insert
$add_sql = "INSERT INTO commentaires(texte, auteur, date_publication,id_article) VALUES ('$texte','$auteur',now(),'$id_article')";

// header('Location: articles.php?id='.$x);
// save to db and check
if (mysqli_query($conn,$add_sql))
{
   echo "your comment has been successfully added " ;
}
else 
{
    echo 'query error : '.mysqli_error($conn);
}

}
?>






<!-- show article -->
<?php if(isset($_GET['id'])): ?>
<form action="article.php" method="post">
<div style="text-align:center;background-color:pink;width:30%;margin:0 auto;height:250px">
    <h1>Titre de l'article : <?php echo htmlspecialchars($article["titre"]) ?></h1>
    <?php echo htmlspecialchars($article["texte"]) ?>
    <h3>publie le : <?php echo htmlspecialchars($article["date_publication"]) ?> </h3>
    <h3>publie par : <?php echo htmlspecialchars($article["auteur"]) ?></h3>
    </br>
    <input value='delete' type="submit" name="delete_post" />
    <input value="<?php echo $article['id']?>" type="hidden" name="id_to_delete" />
    </div>
    <div style="text-align:center;margin-top:100px">
        <input value='ecrire votre nom' name="auteur_comment" />
</br>
        <textarea type="text" name="texte_comment" rows="8" cols="45" style="margin-top:20px"> 
     Ecrire votre commentaire
    </textarea >
</br>

        <div>
</form>
<?php endif; 
?>

<input value='ajouter' type="submit" name="add_comment" style="margin-top:20px" />

<?php 



//get comment by the article's id

    //secure data 
    // $id=mysqli_real_espace_string($conn,$_GET['id']);
     $id = $article['id'];
     
    
    //write query for an article
     $sql = "SELECT * from commentaires where id_article=$id";
     
     //make query and get result
     $result= mysqli_query($conn,$sql);
    
     //fetch the resulting rows as an array
     $commentaires = mysqli_fetch_all($result, MYSQLI_ASSOC);
 
     //free result from memory
    mysqli_free_result($result);
?>



 <!-- show comment -->
<?php if((count($commentaires))>0): ?> 
 <h1>Les commentaires : </h1>
<?php foreach ($commentaires as $commentaire): ?> 
    <textarea type="text" rows="8" cols="45" style="margin-top:20px"> <?php echo htmlspecialchars($commentaire['texte']) ?></textarea >
    <h2>Ajoute par : <?php echo htmlspecialchars($commentaire['auteur']) ?></h2>
    <h2>le : <?php echo htmlspecialchars($commentaire['date_publication']) ?></h2>
     
<?php endforeach; ?>
<?php endif; ?>
<?php mysqli_close($conn);?>
</form>


</html>