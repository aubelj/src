<?php

namespace upReal\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gain
 */
class Gain
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
    private $idAchievement;


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
     * @return Gain
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
     * Set idAchievement
     *
     * @param integer $idAchievement
     * @return Gain
     */
    public function setIdAchievement($idAchievement)
    {
        $this->idAchievement = $idAchievement;

        return $this;
    }

    /**
     * Get idAchievement
     *
     * @return integer 
     */
    public function getIdAchievement()
    {
        return $this->idAchievement;
    }
}
