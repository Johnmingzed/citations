<?php namespace App\Utilisateur;

use Core\Entity;

/**
 * Classe UtilisateurEntity
 *
 * Représente l'entité Utilisateur.
 */
class UtilisateurEntity extends Entity
{
    private ?int $id = null;
    private ?string $prenom = null;
    private ?string $nom = null;
    private ?string $mail = null;
    private ?string $mot_de_passe = null;
    private ?string $date_modif = null;
    private ?string $token = null;

    private bool $is_admin = false;

    /**
     * Constructeur de la classe UtilisateurEntity.
     *
     * @param array $data Les données à utiliser pour l'hydratation de l'entité.
     */
    public function __construct(array $data=null)
    {
        if(!is_null($data)){
            $this->hydrate($data);
        }
     
    }

    /**
     * Méthode est_admin
     *
     * Indique si l'utilisateur est un administrateur.
     *
     * @return bool True si l'utilisateur est un administrateur, false sinon.
     */
    public function est_admin(): bool
    {
        return $this->getIs_admin();
    }

    /**
     * Méthode hydrate
     *
     * Hydrate l'entité avec les données fournies.
     *
     * @param array $data Les données à utiliser pour l'hydratation.
     * @return self L'objet UtilisateurEntity hydraté.
     */
    public function hydrate(array $data=null): self
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists(__CLASS__, $method)) {
                $this->$method($value);
            } else {
                trigger_error('L\'attribut ' . $key . ' n\'existe pas', E_USER_WARNING);
            }
        }
        return $this;
    }

    /**
     * Méthode est_nouveau
     *
     * Indique si l'utilisateur est nouveau (non enregistré en base de données).
     *
     * @return bool True si l'utilisateur est nouveau, false sinon.
     */
    public function est_nouveau(): bool
    {
        return !isset($this->id);
    }

    /**
     * Méthode getId
     *
     * Obtient l'identifiant de l'utilisateur.
     *
     * @return int|null L'identifiant de l'utilisateur, ou null si non défini.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Méthode setId
     *
     * Définit l'identifiant de l'utilisateur.
     *
     * @param int $id L'identifiant de l'utilisateur.
     * @return self L'objet UtilisateurEntity mis à jour.
     */
    public function setId(int $id): self
    {
        if ($id <= 0) {
            trigger_error('Doit être strictement positif', E_USER_ERROR);
        }
        if (!$this->est_nouveau()) {
            trigger_error('id déjà existant', E_USER_ERROR);
        }
        $this->id = $id;
        return $this;
    }

    /**
     * Méthode getPrenom
     *
     * Obtient le prénom de l'utilisateur.
     *
     * @return string|null Le prénom de l'utilisateur, ou null si non défini.
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * Méthode setPrenom
     *
     * Définit le prénom de l'utilisateur.
     *
     * @param string|null $prenom Le prénom de l'utilisateur.
     * @return self L'objet UtilisateurEntity mis à jour.
     */
    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * Méthode getNom
     *
     * Obtient le nom de l'utilisateur.
     *
     * @return string|null Le nom de l'utilisateur, ou null si non défini.
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Méthode setNom
     *
     * Définit le nom de l'utilisateur.
     *
     * @param string|null $nom Le nom de l'utilisateur.
     * @return self L'objet UtilisateurEntity mis à jour.
     */
    public function setNom(?string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Méthode getMail
     *
     * Obtient l'adresse e-mail de l'utilisateur.
     *
     * @return string|null L'adresse e-mail de l'utilisateur, ou null si non définie.
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * Méthode setMail
     *
     * Définit l'adresse e-mail de l'utilisateur.
     *
     * @param string $mail L'adresse e-mail de l'utilisateur.
     * @return self L'objet UtilisateurEntity mis à jour.
     */
    public function setMail(string $mail): self
    {
        if (empty($mail)) {
            trigger_error('Ne doit pas être vide', E_USER_ERROR);
        }
        if (strlen($mail) > 320) {
            trigger_error('Pas plus de 320 caractères', E_USER_ERROR);
        }
        $this->mail = $mail;
        return $this;
    }

    /**
     * Méthode getMot_de_passe
     *
     * Obtient le mot de passe de l'utilisateur.
     *
     * @return string|null Le mot de passe de l'utilisateur, ou null si non défini.
     */
    public function getMot_de_passe(): ?string
    {
        return $this->mot_de_passe;
    }

    /**
     * Méthode setMot_de_passe
     *
     * Définit le mot de passe de l'utilisateur.
     *
     * @param string $mot_de_passe Le mot de passe de l'utilisateur.
     * @return self L'objet UtilisateurEntity mis à jour.
     */
    public function setMot_de_passe(string $mot_de_passe): self
    {
        $this->mot_de_passe = $mot_de_passe;
        return $this;
    }

    /**
     * Méthode getDate_modif
     *
     * Obtient la date de modification de l'utilisateur.
     *
     * @return string|null La date de modification de l'utilisateur, ou null si non définie.
     */
    public function getDate_modif(): ?string
    {
        return $this->date_modif;
    }

    /**
     * Méthode setDate_modif
     *
     * Définit la date de modification de l'utilisateur.
     *
     * @param string $date_modif La date de modification de l'utilisateur.
     * @return self L'objet UtilisateurEntity mis à jour.
     */
    public function setDate_modif(string $date_modif): self
    {
        $this->date_modif = $date_modif;
        return $this;
    }

    /**
     * Méthode getToken
     *
     * Obtient le token de l'utilisateur.
     *
     * @return string|null Le token de l'utilisateur, ou null si non défini.
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Méthode setToken
     *
     * Définit le token de l'utilisateur.
     *
     * @param string $token Le token de l'utilisateur.
     * @return self L'objet UtilisateurEntity mis à jour.
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Méthode getIs_admin
     *
     * Indique si l'utilisateur est un administrateur.
     *
     * @return bool True si l'utilisateur est un administrateur, false sinon.
     */
    public function getIs_admin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Méthode setIs_admin
     *
     * Définit si l'utilisateur est un administrateur.
     *
     * @param bool $admin True si l'utilisateur est un administrateur, false sinon.
     * @return self L'objet UtilisateurEntity mis à jour.
     */
    public function setIs_admin(bool $admin): self
    {
        $this->is_admin = $admin;
        return $this;
    }
}
