<?php
declare(strict_types=1);



class Produit {
    // Attributs avec types (PHP 8.4)
    private string $nom;              // Texte
    private float $prix;              // Nombre décimal
    private int $quantite;            // Nombre entier
    private bool $enStock;            // Vrai/Faux
    private ?string $description;     // Texte ou null
    private array $categories;        // Tableau
}

?>
