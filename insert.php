<form method="post">
    <input type="text" placeholder="Designaion" name="Designation"><br>
    <input type="text" placeholder="PU" name="PU"><br>
    <input type="text" placeholder="Famille" name="Famille"><br>

    <input type="submit" value="Ajouter" name="Ajouter">
</form>
<a href="liste.php">Liste Produits</a><br>
<?php
//1 Etape
require_once "auth.php";


if (
    empty($_POST["Designation"]) or  empty($_POST["PU"])
    or  empty($_POST["Famille"]) or  empty($_POST["Ajouter"])
) {
    //Quitter le programme s'il y a une seule valeur nulle
    die("Veulliez remplir le formulaire");
}

$Designation = $_POST["Designation"];
$PU = $_POST["PU"];
$Famille = $_POST["Famille"];
//2 Etape
$requeteInsert = $conn->prepare(
    "insert into produit(Designation,PU,Famille) 
    values(:Designation,:PU,:Famille)  "
);
$requeteInsert->bindParam(":Designation", $Designation);
$requeteInsert->bindParam(":PU", $PU);
$requeteInsert->bindParam(":Famille", $Famille);
// 3 et 4 Etape
if ($requeteInsert->execute())
    echo "Ajout effectué avec succès, l'identifant est :" . $conn->lastInsertId();

?>