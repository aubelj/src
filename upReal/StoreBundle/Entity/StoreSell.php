<?php

namespace upReal\StoreBundle\Entity;

/**
 * StoreSell
 */
class StoreSell
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $price;

    /**
     * @var integer
     */
    private $product;

    /**
     * @var integer
     */
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
     * Set price
     *
     * @param string $price
     *
     * @return StoreSell
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set product
     *
     * @param integer $product
     *
     * @return StoreSell
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return integer
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set store
     *
     * @param integer $store
     *
     * @return StoreSell
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
}

