<?php

namespace upReal\UserBundle\Entity;

/**
 * History
 */
class History
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
    private $actionType;

    /**
     * @var integer
     */
    private $idType;

    /**
     * @var integer
     */
    private $idTarget;

    /**
     * @var \DateTime
     */
    private $date;

    private $user;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return History
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
     * Set actionType
     *
     * @param integer $actionType
     *
     * @return History
     */
    public function setActionType($actionType)
    {
        $this->actionType = $actionType;

        return $this;
    }

    /**
     * Get actionType
     *
     * @return integer
     */
    public function getActionType()
    {
        return $this->actionType;
    }

    /**
     * Set idType
     *
     * @param integer $idType
     *
     * @return History
     */
    public function setIdType($idType)
    {
        $this->idType = $idType;

        return $this;
    }

    /**
     * Get idType
     *
     * @return integer
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Set idTarget
     *
     * @param integer $idTarget
     *
     * @return History
     */
    public function setIdTarget($idTarget)
    {
        $this->idTarget = $idTarget;

        return $this;
    }

    /**
     * Get idTarget
     *
     * @return integer
     */
    public function getIdTarget()
    {
        return $this->idTarget;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return History
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}

