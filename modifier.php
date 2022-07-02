<?php
require_once "auth.php";

$designation = "";
$pu = "";
$famille = "";
if (
    $_SERVER["REQUEST_METHOD"] == "GET" //il s'agit du premier chargement
    and isset($_GET["id"])
) {


    $id = $_GET["id"];
    //2 etape
    $requete = $conn->prepare(
        "select pu,designation,famille from produit where id=:id"
    );
    $requete->bindParam(":id", $id);
    //3 Etape
    $requete->execute();
    //4 Etape
    /*
    On a mis fetch au lieu de fetchAll car on est 
    sur qu'on va avoir une seule ligne 
    */
    $resultat = $requete->fetch(PDO::FETCH_OBJ);

    $designation = $resultat->designation;
    $pu = $resultat->pu;
    $famille = $resultat->famille;
} else if (
    $_SERVER["REQUEST_METHOD"] == "POST"
    //il s'agit du clique sur le bouton modifier
    and isset(
        $_POST["Modifier"],
        $_POST["id"],
        $_POST["Designation"],
        $_POST["PU"],
        $_POST["Famille"]
    )
) {
    $id = $_POST["id"];
    $designation = $_POST["Designation"];
    $pu =  $_POST["PU"];
    $famille =  $_POST["Famille"];
    //2 etape
    $requete = $conn->prepare(
        "update produit set pu=:pu, designation=:designation
    , famille=:famille where id=:id"
    );
    $requete->bindParam(":id", $id);
    $requete->bindParam(":pu", $pu);
    $requete->bindParam(":designation", $designation);
    $requete->bindParam(":famille", $famille);
    //3 Etape
    $res = $requete->execute();
    //4 Etape
    if ($res)
        echo "<h5>Modification effectuée avec succès</h5>";
    else
        echo "<h5>Erreur lors de la modification</h5>";
}
?>
<h3>Modification</h3>
<form method="post">
    <input type="hidden" name="id" value='<?php echo $id; ?>'>
    <input type="text" placeholder="Designation" name="Designation" value='<?php echo $designation; ?>'><br>
    <input type="text" placeholder="PU" name="PU" value='<?php echo $pu; ?>'><br>
    <input type="text" placeholder="Famille" name="Famille" value="<?php echo $famille; ?>"><br>
    <input type="submit" value="Modifier" name="Modifier">
</form>

<a href="index.php">Accueil</a><br>
<a href="liste.php">Liste Produits</a><br>