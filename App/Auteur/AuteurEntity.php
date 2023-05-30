<?php namespace App\Auteur;
use Core\Entity;
/**
 * Classe AuteurEntity
 *
 * Description : Représente l'entité Auteur.
 */
class AuteurEntity extends Entity
{
    private ?int $id = null;
    private ?string $auteur = null;
    private ?string $bio = null;
    private ?string $date_modif = null;

    /**
     * Constructeur de la classe AuteurEntity.
     *
     * @param array|null $data Les données à utiliser pour l'hydratation de l'entité (facultatif).
     */
    public function __construct(?array $data = null)
    {
        if (!is_null($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Méthode hydrate
     *
     * Description : Hydrate l'entité avec les données fournies.
     *
     * @param array $data Les données à utiliser pour l'hydratation.
     * @return self L'objet AuteurEntity hydraté.
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
     * Méthode est_nouveau
     *
     * Description : Vérifie si l'entité est nouvelle (non enregistrée en base de données).
     *
     * @return bool True si l'entité est nouvelle, sinon False.
     */
    public function est_nouveau(): bool
    {
        return !isset($this->id);
    }

    /**
     * Méthode getId
     *
     * Description : Obtient l'ID de l'auteur.
     *
     * @return int|null L'ID de l'auteur, ou null si non défini.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Méthode setId
     *
     * Description : Définit l'ID de l'auteur.
     *
     * @param int $id L'ID de l'auteur.
     * @return self L'objet AuteurEntity mis à jour.
     * @throws Error si l'ID est inférieur ou égal à 0.
     */
    public function setId($id): self
    {
        if ($id <= 0) {
            trigger_error('Un N+ est attendu', E_USER_ERROR);
        }
        $this->id = $id;
        return $this;
    }

    /**
     * Méthode getAuteur
     *
     * Description : Obtient le nom de l'auteur.
     *
     * @return string Le nom de l'auteur.
     */
    public function getAuteur(): string
    {
        return $this->auteur;
    }

    /**
     * Méthode setAuteur
     *
     * Description : Définit le nom de l'auteur.
     *
     * @param string $auteur Le nom de l'auteur.
     * @return self L'objet AuteurEntity mis à jour.
     * @throws Error si la chaîne dépasse 63 caractères ou est vide.
     */
    public function setAuteur(string $auteur): self
    {
        if (strlen($auteur) > 63) {
            trigger_error('Trop long (63 max)', E_USER_ERROR);
        }
        if (empty($auteur)) {
            trigger_error('chaine vide', E_USER_ERROR);
        }
        $this->auteur = $auteur;
        return $this;
    }

    /**
     * Méthode getBio
     *
     * Description : Obtient la biographie de l'auteur.
     *
     * @return string|null La biographie de l'auteur, ou null si non définie.
     */
    public function getBio(): ?string
    {
        return $this->bio;
    }

    /**
     * Méthode setBio
     *
     * Description : Définit la biographie de l'auteur.
     *
     * @param string|null $bio La biographie de l'auteur.
     * @return self L'objet AuteurEntity mis à jour.
     */
    public function setBio(?string $bio): self
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * Méthode getDate_modif
     *
     * Description : Obtient la date de modification de l'auteur.
     *
     * @return string|null La date de modification de l'auteur, ou null si non définie.
     */
    public function getDate_modif(): ?string
    {
        return $this->date_modif;
    }

    /**
     * Méthode setDate_modif
     *
     * Description : Définit la date de modification de l'auteur.
     *
     * @param string $date La date de modification de l'auteur.
     * @return self L'objet AuteurEntity mis à jour.
     */
    public function setDate_modif(string $date): self
    {
        $this->date_modif = $date;
        return $this;
    }
}
