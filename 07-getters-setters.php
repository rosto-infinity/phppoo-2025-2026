<?php
declare(strict_types=1);

echo "<a href='index.php'> Accueil</a>  </br>  </br>\n ";


class Personne {
    private string $nom;
    private int $age;
    
    // Getter pour $nom
    public function getNom(): string {
        return $this->nom;
    }
    
    // Setter pour $nom
    public function setNom(string $nom): void {
        if (strlen($nom) < 2) {
            throw new InvalidArgumentException("Le nom doit contenir au moins 2 caractères");
        }
        $this->nom = $nom;
    }
    
    // Getter pour $age
    public function getAge(): int {
        return $this->age;
    }
    
    // Setter pour $age avec validation
    public function setAge(int $age): void {
        if ($age < 0 || $age > 150) {
            throw new InvalidArgumentException("Âge invalide");
        }
        $this->age = $age;
    }
}

$personne = new Personne();
$personne->setNom("eva");  // ✓ Valide
$personne->setAge(25);       // ✓ Valide

// $personne->setNom("A");   // ✗ Exception : Le nom doit contenir au moins 2 caractères
// $personne->setAge(200);   // ✗ Exception : Âge invalide

echo $personne->getNom();    // eva
echo $personne->getAge();    // 25

?>
