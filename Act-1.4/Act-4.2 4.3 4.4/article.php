<html>

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
     mysqli_close($conn);

}

//delete article by id

if (isset($_POST['delete_post'])) {

    //secure data 
    // $id=mysqli_real_espace_string($conn,$_GET['id']);
     $id = $_POST["id_to_delete"] ;
     echo $id;
    //write query for an article
     $sql = "DELETE from articles where id = $id";

     if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . mysqli_error($conn);
      }
      
      mysqli_close($conn);
}

?>


<?php if(isset($_GET['id'])): ?>
<form action="article.php" method="post">
<div style="text-align:center;background-color:pink;width:30%;margin:0 auto;height:250px">
    <h1>Titre de l'article : <?php echo htmlspecialchars($article["titre"]) ?></h1>
    <?php echo htmlspecialchars($article["texte"]) ?>
    <h3>publie le : <?php echo htmlspecialchars($article["date_publication"]) ?> </h3>
    <h3>publie par : <?php echo htmlspecialchars($article["auteur"]) ?></h3>
    </br>
    <input value='delete' type="submit" name="delete_post" />
    <input value=<?php echo $article['id']?> type="hidden" name="id_to_delete" />
    </div>
    <div style="text-align:center;margin-top:100px">
        <textarea type="text" name="texte" rows="8" cols="45">
     Ecrire votre commentaires
    </textarea >
</br>
    <input value='ajouter' type="submit" name="ajout_commentaire" style="margin-top:20px" />
        <div>
</form>
<?php endif; ?>
    
</html>