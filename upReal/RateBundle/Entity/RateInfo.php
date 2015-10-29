<?php

namespace upReal\RateBundle\Entity;

/**
 * RateInfo
 */
class RateInfo
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $type;

    /**
     * @var integer
     */
    private $idRate;
    private $rate;

    /**
     * @var integer
     */
    private $idTarget;
    private $target;

    /**
     * @var integer
     */
    private $idTargetType;


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
     * Set type
     *
     * @param integer $type
     *
     * @return RateInfo
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
     * Set idRate
     *
     * @param integer $idRate
     *
     * @return RateInfo
     */
    public function setIdRate($idRate)
    {
        $this->idRate = $idRate;

        return $this;
    }

    /**
     * Get idRate
     *
     * @return integer
     */
    public function getIdRate()
    {
        return $this->idRate;
    }

    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set idTarget
     *
     * @param integer $idTarget
     *
     * @return RateInfo
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

    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set idTargetType
     *
     * @param integer $idTargetType
     *
     * @return RateInfo
     */
    public function setIdTargetType($idTargetType)
    {
        $this->idTargetType = $idTargetType;

        return $this;
    }

    /**
     * Get idTargetType
     *
     * @return integer
     */
    public function getIdTargetType()
    {
        return $this->idTargetType;
    }
}

