<?php
declare(strict_types=1);

echo "<a href='index.php'> Accueil</a>  </br>  </br>\n ";

class Locale2
{
    private string $languageCode;
    private string $countryCode;

    public function __construct(string $languageCode, string $countryCode)
    {
        $this->setLanguageCode($languageCode);
        $this->setCountryCode($countryCode);
    }

    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    public function setLanguageCode(string $languageCode): void
    {
        $this->languageCode = $languageCode;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = strtoupper($countryCode);
    }

    public function setCombinedCode(string $combinedCode): void
    {
        [$languageCode, $countryCode] = explode('_', $combinedCode, 2);

        $this->setLanguageCode($languageCode);
        $this->setCountryCode($countryCode);
    }

    public function getCombinedCode(): string
    {
        return \sprintf("%s_%s", $this->languageCode, $this->countryCode);
    }
}

$brazilianPortuguese = new Locale2('pt', 'br');
var_dump($brazilianPortuguese->getCountryCode()); // BR
var_dump($brazilianPortuguese->getCombinedCode()); // pt_BR

?>
