<?php

namespace upReal\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Karma
 */
class Karma
{
    /**
     * @var integer
     */
    private $id;    

    /**
     * @var integer
     */
    private $idUser;

    /**
     * @var integer
     */
    private $value;

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
     * Set idUser
     *
     * @param integer $idUser
     * @return Karma
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set value
     *
     * @param integer $value
     * @return Karma
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }
}
