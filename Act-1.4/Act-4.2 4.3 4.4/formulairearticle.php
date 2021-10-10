<?php 

include('db_connection.php');

// //write query for all articles
// $sql = 'SELECT * from articles';

// //make query and get result
// $result= mysqli_query($conn,$sql);

// //fetch the resulting rows as an array
// $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);

// //free result from memory
// mysqli_free_result($result);

// //close connection
// mysqli_close($conn);

// print_r($articles);

?>



<div style="text-align:center;margin-top:100px">
<p>
   Ce formulaire permet de poster un article
</p>
<form action="articles.php" method="post">
    <label> Ecrire le titre de l'article:</label>
    <input type="text" name="titre" />
</br></br>
    <textarea type="text" name="texte" rows="8" cols="45">
     Ecrire votre texte ici.
    </textarea>
    </br></br>
    <label> Ecrire le nom de l'auteur de l'article:</label>
    <input type="text" name="auteur" />
    </br></br>
    <label for="start">Choisir la date de publication de l'article:</label>
<input type="date" id="start" name="date_publication" placeholder="yyyy-mm-dd"
      
       min="2018-01-01" max="2021-10-07">
       </br></br>
       <input type="hidden" id="merchantid" name="merchantid" value="<?php echo uniqid();?>"/>
    <input type="submit" value="Publier" name="submit" />

</form>




</div>