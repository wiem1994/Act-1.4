<html>
<form action="article.php " method="get">

<?php 

include('db_connection.php');

$titre ="";
$texte="";
$auteur="";
$date_publication=date(('Y-m-d'));
// ,strtotime($_POST['date_publication'])
// $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
// $texte = isset($_POST['texte']) ? $_POST['texte'] : '';
// $auteur = isset($_POST['auteur']) ? $_POST['auteur'] : '';
// $month = date('n');
// $year = date('Y');
// $day = date('D');

 
if (isset($_POST['submit'])){

$titre = isset($_POST['titre']) ? $_POST['titre'] : '';
$texte = isset($_POST['texte']) ? $_POST['texte'] : '';
$auteur = isset($_POST['auteur']) ? $_POST['auteur'] : '';
$date_publication = isset($_POST['date_publication']) ? $_POST['date_publication'] : '';
//create sql insert
$add_sql = "INSERT INTO articles(titre, texte, auteur, date_publication) VALUES ('$titre','$texte','$auteur','$date_publication')";
header('Location: articles.php');
// save to db and check
if (mysqli_query($conn,$add_sql))
{
   echo "your article has been successfully added " ;
}
else 
{
    echo 'query error : '.mysqli_error($conn);
}
}




//write query for all articles
$sql = 'SELECT * from articles';


//make query and get result
$result= mysqli_query($conn,$sql);


//fetch the resulting rows as an array
$articles = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);

//close connection
mysqli_close($conn);
?>

<?php foreach ($articles as $article): ?>

    <div style="text-align:center;background-color:pink;width:30%;margin:0 auto;height:250px">
    <h1>Titre de l'article : <?php echo htmlspecialchars($article["titre"]) ?></h1>
    <?php echo htmlspecialchars($article["texte"]) ?>
    <h3>publie le : <?php echo htmlspecialchars($article["date_publication"]) ?> </h3>
    <h3>publie par : <?php echo htmlspecialchars($article["auteur"]) ?></h3>
    </br>
    <a href="article.php?id=<?php echo $article['id']?>"><input value='plus d information' name="delete" style="width:120px;" /></a>
    </div>

<?php endforeach; ?>
</form>
</html>