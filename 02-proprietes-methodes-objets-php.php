<?php 

declare(strict_types=1);

// Qu’est-ce qu’une propriété ?
//--Une propriété (ou attribut) est une variable déclarée à l’intérieur d’une classe.
//-Elle représente une caractéristique ou un état de l’objet.

//-2.1 Définir une classe avec des propriétés
class Personne
{
  
    public string $prenom;
    public int $age;
    public string $metier;

    // --Méthode qui retourne une chaîne
    public function sePresenter(): string
    {
        return "Bonjour, je m'appelle {$this->prenom}, j'ai {$this->age} ans.";
    }

    // --Méthode qui modifie l'état de l'objet
    public function feterAnniversaire(): void
    {
        $this->age++;
    }
}
// -2.3 Instancier et utiliser un objet
$diane = new Personne("Marie", 25, "ingénieure");
$diane->prenom = "Diane";
$diane->age = 28;
$diane->metier = "développeuse";

//- afficher la présentation
echo $diane->sePresenter() . PHP_EOL;

// --fêter un anniversaire et afficher le nouvel état
$diane->feterAnniversaire();
echo "Après un anniversaire : " . $diane->sePresenter() . PHP_EOL;

// --afficher l'objet complet (facultatif)
print_r($diane);