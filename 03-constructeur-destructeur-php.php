<?php

declare(strict_types=1);

/**
 * Cours 3 —- Constructeur et Destructeur (PHP 8+)
 * Exemples :
 *  - Personne : constructeur avec promotion de propriétés + validation
 *  - Logger  : ouverture/fermeture de ressource (fichier) via constructeur/destructeur
 *  - CompteBancaire : constructeur + opérations + message dans le destructeur
 *
 * Exécution (terminal, dossier du projet) :
 * php 03-constructeur-destructeur-php.php
 */

/**
 * -Classe Personne : utilisation de la promotion de propriétés et validation simple.
 */
class Personne
{
    public function __construct(
        public string $prenom,
        public int $age,
        public string $metier
    ) {
        if ($age < 0 || $age > 150) {
            throw new \InvalidArgumentException("Âge invalide.");
        }
    }

    public function sePresenter(): string
    {
        return "Bonjour, je m'appelle {$this->prenom}, j'ai {$this->age} ans et je suis {$this->metier}.";
    }

    public function feterAnniversaire(): void
    {
        $this->age++;
    }
}

/**
 * -Classe Logger : gestion simple d'un fichier de log.
 * Le destructeur ferme le fichier proprement. Ne pas lever d'exception dans __destruct().
 */
class Logger
{
    private $fichier;

    public function __construct(string $cheminFichier)
    {
        $this->fichier = @fopen($cheminFichier, 'a');
        if ($this->fichier === false) {
            throw new \RuntimeException("Impossible d'ouvrir le fichier de log : $cheminFichier");
        }
        $this->ecrire("=== Session de log démarrée ===");
    }

    public function ecrire(string $message): void
    {
        if (is_resource($this->fichier)) {
            fwrite($this->fichier, "[" . date('Y-m-d H:i:s') . "] $message\n");
        }
    }

    public function __destruct()
    {
        // Ne pas lever d'exception ici : logger seulement
        if (is_resource($this->fichier)) {
            $this->ecrire("=== Session de log terminée ===");
            fclose($this->fichier);
        }
    }
}

/**
 * -Classe CompteBancaire : constructeur avec validation, méthodes de crédit/débit,
 * et un message affiché à la destruction de l'objet.
 */
class CompteBancaire
{
    public function __construct(
        public string $titulaire,
        public float $solde = 0.0
    ) {
        if ($this->solde < 0.0) {
            throw new \InvalidArgumentException("Solde initial ne peut pas être négatif.");
        }
    }

    public function crediter(float $montant): void
    {
        if ($montant <= 0) {
            throw new \InvalidArgumentException("Montant à créditer doit être > 0.");
        }
        $this->solde += $montant;
    }

    public function debiter(float $montant): void
    {
        if ($montant <= 0) {
            throw new \InvalidArgumentException("Montant à débiter doit être > 0.");
        }
        if ($montant > $this->solde) {
            throw new \RuntimeException("Fonds insuffisants pour débiter $montant €.");
        }
        $this->solde -= $montant;
    }

    public function __destruct()
    {
        // -Message simple à la fin du script / quand l'objet est détruit
        echo "Compte de {$this->titulaire} fermé. Solde final : " . number_format($this->solde, 2) . " €" . PHP_EOL;
    }
}

/*
 * Utilisation / démonstration
 */

echo "=== Démonstration Constructeur / Destructeur ===" . PHP_EOL;

// Personne : création atomique grâce au constructeur
$eva = new Personne("Eva", 34, "designer");
echo $eva->sePresenter() . PHP_EOL;
$eva->feterAnniversaire();
echo "Après anniversaire : " . $eva->sePresenter() . PHP_EOL;

// Logger : écriture dans un fichier de log (app.log dans le dossier courant)
try {
    $logger = new Logger(__DIR__ . '/app.log');
    $logger->ecrire("Eva a ajouté une ressource.");
    // unset($logger); // si on veut forcer la fermeture immédiate
} catch (\Throwable $e) {
    echo "Erreur logger : " . $e->getMessage() . PHP_EOL;
}

// CompteBancaire : opérations puis affichage via __destruct()
try {
    $compte = new CompteBancaire("Owen", 1500.0);
    $compte->debiter(200.0);
    echo "Solde après débit : " . number_format($compte->solde, 2) . " €" . PHP_EOL;
    // Le destructeur affichera le message à la fin du script (ou si unset($compte) est appelé)
} catch (\Throwable $e) {
    echo "Erreur compte : " . $e->getMessage() . PHP_EOL;
}

echo "Fin du script — les destructeurs seront appelés automatiquement." . PHP_EOL;