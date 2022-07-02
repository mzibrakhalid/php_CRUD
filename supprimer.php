<?php
require_once "auth.php";


if (
    $_SERVER["REQUEST_METHOD"] == "GET" //il s'agit du premier chargement
    and isset($_GET["id"])
) {
    $id = $_GET["id"];
    $requete = $conn->prepare(
        "delete from produit where id=:id"
    );
    $requete->bindParam(":id", $id);


    $res = $requete->execute();
    if ($res)
        echo "<h5>Suppression effectuée avec succès</h5>";
    else
        echo "<h5>Erreur lors de la Suppression</h5>";
}
?>
<a href="index.php">Accueil</a><br>
<a href="liste.php">Liste des Produits</a><br>