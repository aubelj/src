<?php

namespace upReal\UserBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Loyalty
 */
class Loyalty
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $frontCover;

    /**
     * @var string
     */
    private $backCover;

    private $backFile;
    private $frontFile;

    /**
     * @var 
     */
    private $store;

    /**
     * @var 
     */
    private $company;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set frontCover
     *
     * @param string $frontCover
     *
     * @return Loyalty
     */
    public function setFrontCover($frontCover)
    {
        $this->frontCover = $frontCover;

        return $this;
    }

    /**
     * Get frontCover
     *
     * @return string
     */
    public function getFrontCover()
    {
        return ($this->frontCover == null ? null : ($this->getUploadDir() . '/' . $this->frontCover));
    }

    /**
     * Set backCover
     *
     * @param string $backCover
     *
     * @return Loyalty
     */
    public function setBackCover($backCover)
    {
        $this->backCover = $backCover;

        return $this;
    }

    /**
     * Get backCover
     *
     * @return string
     */
    public function getBackCover()
    {
        return ($this->backCover == null ? null : ($this->getUploadDir() . '/' . $this->backCover));
    }

    /**
     * Set store
     *
     * @param integer $store
     *
     * @return Loyalty
     */
    public function setStore($store)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * Get store
     *
     * @return integer
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Set company
     *
     * @param integer $company
     *
     * @return Loyalty
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return integer
     */
    public function getCompany()
    {
        return $this->company;
    }

    public function getAbsoluteFront()
    {
        return null === $this->frontCover ? null : $this->getUploadRootDir().'/'.$this->frontCover;
    }

    public function getWebFront()
    {
        return null === $this->frontCover ? null : $this->getUploadDir().'/'.$this->frontCover;
    }

    public function getAbsoluteBack()
    {
        return null === $this->backCover ? null : $this->getUploadRootDir().'/'.$this->backCover;
    }

    public function getWebBack()
    {
        return null === $this->backCover ? null : $this->getUploadDir().'/'.$this->backCover;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/loyalty';
    }

    public function upload()
    {
        $this->uploadBack();
        $this->uploadFront();
    }    

    public function uploadBack()
    {
        // la propriété « file » peut être vide si le champ n'est pas requis
        if (null === $this->backCover) {
            return;
        }

        // utilisez le nom de fichier original ici mais
        // vous devriez « l'assainir » pour au moins éviter
        // quelconques problèmes de sécurité

        // la méthode « move » prend comme arguments le répertoire cible et
        // le nom de fichier cible où le fichier doit être déplacé
        $this->backCover->move($this->getUploadRootDir(), $this->backCover->getClientOriginalName());

        // définit la propriété « path » comme étant le nom de fichier où vous
        // avez stocké le fichier
        $this->backCover = $this->backCover->getClientOriginalName();

        // « nettoie » la propriété « file » comme vous n'en aurez plus besoin
        // $this->backFile = null;
    }

    public function uploadFront()
    {
        // la propriété « file » peut être vide si le champ n'est pas requis
        if (null === $this->frontCover) {
            return;
        }

        // utilisez le nom de fichier original ici mais
        // vous devriez « l'assainir » pour au moins éviter
        // quelconques problèmes de sécurité

        // la méthode « move » prend comme arguments le répertoire cible et
        // le nom de fichier cible où le fichier doit être déplacé
        $this->frontCover->move($this->getUploadRootDir(), $this->frontCover->getClientOriginalName());

        // définit la propriété « path » comme étant le nom de fichier où vous
        // avez stocké le fichier
        $this->frontCover = $this->frontCover->getClientOriginalName();

        // « nettoie » la propriété « file » comme vous n'en aurez plus besoin
    }
}

