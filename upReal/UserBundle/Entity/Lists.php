<?php

namespace upReal\UserBundle\Entity;

/**
 * List
 */
class Lists
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
     * @var integer
     */
    private $public;

    /**
     * @var integer
     */
    private $type;

    /**
     * @var integer
     */
    private $nbItems;

    /**
     * @var integer
     */
    private $idUser;

    private $items;

    private $date;

    protected $user;

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
     *
     * @return List
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
     * Set public
     *
     * @param integer $public
     *
     * @return List
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return integer
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return List
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set nbItems
     *
     * @param integer $nbItems
     *
     * @return List
     */
    public function setNbItems($nbItems)
    {
        $this->nbItems = $nbItems;

        return $this;
    }

    /**
     * Get nbItems
     *
     * @return integer
     */
    public function getNbItems()
    {
        return $this->nbItems;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return List
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

    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    public function getItems()
    {
        return $this->items;
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

   public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    } 
}

