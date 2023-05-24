<?php

namespace App\Models;

use DateTime;
use Core\Debug;

class Auteur
{
    private readonly int $id;
    private string|null $auteur = null;
    private string|null $bio = null;
    private DateTime|string|null $date = null;

    public function __construct(array $datas = null)
    {
        if ($datas != null) {
            $this->hydrate($datas);
        }
    }

    public function hydrate(array $datas): self
    {
        foreach ($datas as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists(__CLASS__, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        if ($id <= 0) {
            trigger_error('ID positif attendu', E_USER_ERROR);
        }
        $this->id = $id;
        return $this;
    }

    /**
     * Set the value of auteur
     */
    public function setAuteur(string $auteur = null): self
    {
        if (strlen($auteur) >= 64) {
            trigger_error('Trop long : 64 caractères maximum', E_USER_ERROR);
        }
        if ($auteur == '') {
            trigger_error('Auteur attendu', E_USER_ERROR);
        }
        $this->auteur = ucfirst($auteur);
        return $this;
    }

    /**
     * Set the value of bio
     */
    public function setBio(string $bio = null): self
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * Set the value of date_modif
     */
    public function setDate_Modif(DateTime|string $date = null): self
    {   
        $this->date = Debug::dateVerif($date);
        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of auteur
     */
    public function getAuteur(): string
    {
        return $this->auteur;
    }

    /**
     * Get the value of bio
     */
    public function getBio(): string
    {
        return $this->bio;
    }

    /**
     * Get the value of date_modif
     */
    public function getDate_Modif(): DateTime
    {
        return $this->date;
    }
}
