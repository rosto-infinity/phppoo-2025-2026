<?php
declare(strict_types=1);
echo "<a href='index.php'> Accueil</a>  </br>  </br>\n ";


class Produit {
    // Attributs avec types (PHP 8.4)
    private string $nom;              // Texte
    private float $prix;              // Nombre décimal
    private int $quantite;            // Nombre entier
    private bool $enStock;            // Vrai/Faux
    private ?string $description;     // Texte ou null
    private array $categories;        // Tableau
}
var_dump(Produit::class);
echo "</br>\n";
$nom = "Ordinateur Portable";
$prix = 999.99;
$quantite = 10;
$enStock = true;
$description = null;
$categories = ["Électronique", "Informatique"];

var_dump($nom);
?>
