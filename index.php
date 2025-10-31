<?php
declare(strict_types=1);
echo "Attributs avec types (PHP 8.4) </br>  \n"; 

echo "<a href='index.php'> Accueil</a>  </br>  </br>\n ";
echo "<a href='05-attributs.php'> 05-attributs.php</a>  <br>  \n ";
echo "<a href='06-methodes.php'> 06-methodes.php</a>  <br>  \n ";
echo "<a href='07-getters-setters.php'> 07-getters-setters.php</a>  <br>  \n ";
echo "<a href='07-hooks.php'> 07-hooks.php</a>  <br> <br> <br> <br>   \n ";



class CompteBancaire {
    private float $solde;

    public function __construct(float $soldeInitial) {
        $this->solde = $soldeInitial;  // $this = cet objet précis
    }

    public function deposer(float $montant): void {
        $this->solde += $montant;  // Accès à l'attribut de CET objet
    }

    public function retirer(float $montant): void {
        if ($this->solde >= $montant) {
            $this->solde -= $montant;
        }
    }

    public function afficherSolde(): void {
        echo "Solde : {$this->solde} FCFA <br>";
    }
}

$compte1 = new CompteBancaire(1000);
$compte2 = new CompteBancaire(500);

$compte1->deposer(200);   // $this = $compte1
$compte2->retirer(100);    // $this = $compte2

$compte1->afficherSolde(); // Solde : 1200 FCFA
$compte2->afficherSolde(); // Solde : 400 FCFA


?>
