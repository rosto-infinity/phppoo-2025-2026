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

    /**
     * Constructeur
     */
    public function __construct(
        string $nom,
        float $prix,
        int $quantite = 0,
        ?string $description = null,
        array $categories = []
    ) {
        if ($prix < 0) {
            throw new \InvalidArgumentException("Le prix ne peut pas être négatif.");
        }
        if ($quantite < 0) {
            throw new \InvalidArgumentException("La quantité ne peut pas être négative.");
        }

        $this->nom = $nom;
        $this->prix = $prix;
        $this->quantite = $quantite;
        $this->description = $description;
        $this->categories = array_values($categories);
        $this->enStock = $quantite > 0;
    }

    // --- Getters ---
    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    // --- Setters / Modificateurs ---
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setPrix(float $prix): void
    {
        if ($prix < 0) {
            throw new \InvalidArgumentException("Le prix ne peut pas être négatif.");
        }
        $this->prix = $prix;
    }

    public function setQuantite(int $quantite): void
    {
        if ($quantite < 0) {
            throw new \InvalidArgumentException("La quantité ne peut pas être négative.");
        }
        $this->quantite = $quantite;
        $this->enStock = $quantite > 0;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    // --- Gestion de la quantité ---
    public function augmenterQuantite(int $nombre = 1): void
    {
        if ($nombre <= 0) {
            throw new \InvalidArgumentException("Le nombre doit être positif.");
        }
        $this->quantite += $nombre;
        $this->enStock = true;
    }

    public function diminuerQuantite(int $nombre = 1): void
    {
        if ($nombre <= 0) {
            throw new \InvalidArgumentException("Le nombre doit être positif.");
        }
        if ($nombre > $this->quantite) {
            throw new \RuntimeException("Quantité insuffisante pour diminuer de $nombre.");
        }
        $this->quantite -= $nombre;
        $this->enStock = $this->quantite > 0;
    }

    // --- Catégories ---
    public function ajouterCategorie(string $categorie): void
    {
        if (!in_array($categorie, $this->categories, true)) {
            $this->categories[] = $categorie;
        }
    }

    public function retirerCategorie(string $categorie): void
    {
        $this->categories = array_values(array_filter($this->categories, fn($c) => $c !== $categorie));
    }

    public function aCategorie(string $categorie): bool
    {
        return in_array($categorie, $this->categories, true);
    }

    // --- État ---
    public function estEnStock(): bool
    {
        return $this->enStock;
    }

    // --- Utilitaires ---
    public function valeurStock(): float
    {
        return $this->prix * $this->quantite;
    }

    public function toArray(): array
    {
        return [
            'nom' => $this->nom,
            'prix' => $this->prix,
            'quantite' => $this->quantite,
            'enStock' => $this->enStock,
            'description' => $this->description,
            'categories' => $this->categories,
        ];
    }

    public function __toString(): string
    {
        return "{$this->nom} — " . number_format($this->prix, 2) . " € ({$this->quantite} en stock)";
    }
}


  
?>