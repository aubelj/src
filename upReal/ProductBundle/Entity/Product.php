<?php

namespace upReal\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 */
class Product
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $ean;

    /**
     * @var string
     */
    private $picture;

    /**
     * @var string
     */
    private $brand;

    private $uploadDate;

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
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set ean
     *
     * @param integer $ean
     * @return Product
     */
    public function setEan($ean)
    {
        $this->ean = $ean;

        return $this;
    }

    /**
     * Get ean
     *
     * @return integer 
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Product
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
//        return ($this->picture == null ? null : ($this->getUploadDir() . '/' . $this->picture));        
        return $this->picture;
    }

    public function getWebPath()
    {
        return null === $this->picture ? null : $this->getUploadDir().'/'.$this->picture;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire dans lequel sauvegarder les photos de profil
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'images/Product';
    }
    
    public function uploadPicture($id)
    {
        // Nous utilisons le nom de fichier original, donc il est dans la pratique 
        // nécessaire de le nettoyer pour éviter les problèmes de sécurité

        // move copie le fichier présent chez le client dans le répertoire indiqué.
        $this->picture->move($this->getUploadRootDir(), '2_'.$id.'.jpg');

        // On sauvegarde le nom de fichier
        $this->picture = '2_' . $id.'.jpg';
        
        // La propriété file ne servira plus
        // $this->file = null;
    }

    /**
     * Set brand
     *
     * @param string $brand
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return String 
     */
    public function getBrand()
    {
        return $this->brand;
    }

    public function setUploadDate($date)
    {
        $this->uploadDate = $date;

        return $this;
    }

    public function getUploadDate()
    {
        return $this->uploadDate;
    }
}
