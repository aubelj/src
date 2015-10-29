<?php

namespace upReal\UserBundle\Entity;

/**
 * Items
 */
class Items
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $idList;

    private $idProduct;
    private $product;

    private $user;

    private $list;


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
     * Set idList
     *
     * @param integer $idList
     *
     * @return Items
     */
    public function setIdList($idList)
    {
        $this->idList = $idList;

        return $this;
    }

    /**
     * Get idList
     *
     * @return integer
     */
    public function getIdList()
    {
        return $this->idList;
    }

    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setIdProduct($idProduct)
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    public function getIdProduct()
    {
        return $this->idProduct;
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

    public function setList($list)
    {
        $this->list = $list;

        return $this;
    }

    public function getList()
    {
        return $this->list;
    }
}

