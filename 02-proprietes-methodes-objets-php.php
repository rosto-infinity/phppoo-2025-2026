<?php 

// Qu’est-ce qu’une propriété ?
//--Une propriété (ou attribut) est une variable déclarée à l’intérieur d’une classe.
//-Elle représente une caractéristique ou un état de l’objet.
class Personne
{
    public string $prenom;
    public int $age;
    public string $metier;

    // -Méthode qui retourne une chaîne
    public function sePresenter(): string
    {
        return "Bonjour, je m'appelle {$this->prenom}, j'ai {$this->age} ans.";
    }

    // Méthode qui modifie l'état de l'objet
    public function feterAnniversaire(): void
    {
        $this->age++;
    }
}

$diane = new Personne();
$diane->prenom = "Diane";
$diane->age = 28;
$diane->metier = "développeuse";

