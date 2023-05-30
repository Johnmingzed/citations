<?php namespace App\Citation;

use Core\Entity;
use App\Auteur\AuteurEntity;


/**
 * Classe représentant une entité de citation.
 *
 * @package App\Citation
 */
class CitationEntity extends Entity
{
    /**
     * Identifiant de la citation.
     *
     * @var int|null
     */
    private ?int $id = null;

    /**
     * Contenu de la citation.
     *
     * @var string|null
     */
    private ?string $citation = null;

    /**
     * Explication de la citation.
     *
     * @var string|null
     */
    private ?string $explication = null;

    /**
     * Date de modification de la citation.
     *
     * @var string|null
     */
    private ?string $date_modif = null;


    private ?int $auteurs_id = null;

    /**
     * Auteur de la citation.
     *
     * @var AuteurEntity|null
     */
    private ?AuteurEntity $auteur = null;

    /**
     * Constructeur de la classe CitationEntity.
     *
     * @param array|null $data Données à utiliser pour l'hydratation de l'entité.
     */
    public function __construct(?array $data = null)
    {
        if (!is_null($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Méthode d'hydratation de l'entité avec les données fournies.
     *
     * @param array $data Données à utiliser pour l'hydratation.
     * @return self
     */
    public function hydrate(array $data): self
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists(__CLASS__, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    /**
     * Vérifie si l'entité est nouvelle (non persistée en base de données).
     *
     * @return bool
     */
    public function est_nouveau(): bool
    {
        return !isset($this->id);
    }

    /**
     * Retourne l'identifiant de la citation.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Définit l'identifiant de la citation.
     *
     * @param int|null $id Identifiant de la citation.
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Retourne le contenu de la citation.
     *
     * @return string|null
     */
    public function getCitation(): ?string
    {
        return $this->citation;
    }

    /**
     * Définit le contenu de la citation.
     *
     * @param string|null $citation Contenu de la citation.
     * @return self
     */
    public function setCitation(?string $citation): self
    {
        $this->citation = $citation;
        return $this;
    }

    /**
     * Retourne l'explication de la citation.
     *
     * @return string|null
     */
    public function getExplication(): ?string
    {
        return $this->explication;
    }

    /**
     * Définit l'explication de la citation.
     *
     * @param string|null $explication Explication de la citation.
     * @return self
     */
    public function setExplication(?string $explication): self
    {
        $this->explication = $explication;
        return $this;
    }

    /**
     * Retourne la date de modification de la citation.
     *
     * @return string|null
     */
    public function getDate_modif(): ?string
    {
        return $this->date_modif;
    }

    /**
     * Définit la date de modification de la citation.
     *
     * @param string|null $date_modif Date de modification de la citation.
     * @return self
     */
    public function setDate_modif(?string $date_modif): self
    {
        $this->date_modif = $date_modif;
        return $this;
    }


    public function getAuteurs_id(): int|null
    {
        return $this->auteurs_id;
    }

    public function setAuteurs_id(?int $id): self
    {
        if($id >0 ){
            $this->auteurs_id = $id;
        }
        return $this;
    }


    /**
     * Retourne l'auteur de la citation.
     *
     * @return AuteurEntity
     */
    public function getAuteur(): AuteurEntity
    {
        return $this->auteur;
    }

    /**
     * Définit l'auteur de la citation.
     *
     * @param AuteurEntity $auteur Auteur de la citation.
     * @return self
     */
    public function setAuteur(AuteurEntity $auteur): self
    {
        $this->auteur = $auteur;
        return $this;
    }
}
