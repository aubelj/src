<?php

namespace upReal\UserBundle\Entity;

/**
 * Possess
 */
class Possess
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $idUser;
    private $user;

    /**
     * @var integer
     */
    private $idLoyalty;
    private $loyalty;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var integer
     */
    private $ean;

    /**
     * @var integer
     */
    private $balance;

    /**
     * @var \DateTime
     */
    private $creationTime;

    /**
     * @var \DateTime
     */
    private $expirationTime;

    /**
     * @var integer
     */
    private $idStore;
    private $store;


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
     * Set user
     *
     * @param integer $user
     *
     * @return Possess
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set loyalty
     *
     * @param integer $loyalty
     *
     * @return Possess
     */
    public function setLoyalty($loyalty)
    {
        $this->loyalty = $loyalty;

        return $this;
    }

    /**
     * Get loyalty
     *
     * @return integer
     */
    public function getIdLoyalty()
    {
        return $this->idLoyalty;
    }

    public function getLoyalty()
    {
        return $this->loyalty;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Possess
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Possess
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set ean
     *
     * @param integer $ean
     *
     * @return Possess
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
     * Set balance
     *
     * @param integer $balance
     *
     * @return Possess
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return integer
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     *
     * @return Possess
     */
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    /**
     * Get creationTime
     *
     * @return \DateTime
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * Set expirationTime
     *
     * @param \DateTime $expirationTime
     *
     * @return Possess
     */
    public function setExpirationTime($expirationTime)
    {
        $this->expirationTime = $expirationTime;

        return $this;
    }

    /**
     * Get expirationTime
     *
     * @return \DateTime
     */
    public function getExpirationTime()
    {
        return $this->expirationTime;
    }

    /**
     * Set store
     *
     * @param integer $store
     *
     * @return Possess
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
    public function getIdStore()
    {
        return $this->idStore;
    }

    public function getStore()
    {
        return $this->store;
    }
}

