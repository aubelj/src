<?php

namespace upReal\SearchBundle\Entity;

/**
 * Identify
 */
class Identify
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $product;

    /**
     * @var integer
     */
    private $keyword;

    private $idProduct;
    private $idKeyword;


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
     * Set product
     *
     * @param integer $product
     *
     * @return Identify
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
     * Set keyword
     *
     * @param integer $keyword
     *
     * @return Identify
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return integer
     */
    public function getKeyword()
    {
        return $this->keyword;
    }
}

