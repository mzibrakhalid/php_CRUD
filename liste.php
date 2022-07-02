<style>
    td {
        border: 1px solid black;
    }
</style>
<?php
//Importer le fichier de connexion
require_once "auth.php";

$txtRequete = "select id,pu,designation,famille from produit";
//Si on vient de la page recherche.php
if (isset($_GET["btnChercher"], $_GET["txtRecherche"])) {
    $txtRech = $_GET['txtRecherche'];
    $txtRequete = "select id,pu,designation,famille from produit
     where designation like '%$txtRech%'";
}

//1  ere Etape : Creer la connexion $conn
//2  eme Etape: Preparer la requete
$requeteSlect = $conn->prepare(
    $txtRequete
);

//3 eme Etape: Executer la requete
$requeteSlect->execute();
//4 eme Etape: Lire le résultat de la requete
$resultat = $requeteSlect->fetchAll(PDO::FETCH_OBJ);

if ($requeteSlect->rowCount() == 0) {
    echo "<h3>Aucun résultat trouvé</h3>";
} else {
    //Affichage  de la requete de recherche dans un tableau
    echo "<table>";
    echo "<thead>";
    echo "<tr><th>id</th> <th>Prix Unitaire</th> <th>Designation</th> <th>Famille</th>
<th>actions</th>        
</tr>";
    echo "</thead>";
    echo "<tbody>";


    foreach ($resultat as $el) {
        echo ("<tr>"
            . "<td>" . $el->id . "</td>"
            . "<td>" . $el->designation . "</td>"
            . "<td>" . $el->famille . "</td>"
            . "<td>" . $el->pu . "</td>"
            . "<td><a href='modifier.php?id=$el->id'>Modifier</a> <br>
            <a href='supprimer.php?id=$el->id'>Supprimer</a> </td>"

            . "</tr>");
    }
    echo "</tbody>";
    echo "</table>";
}
?>
<a href="index.php">Accueil</a><br>