<?php

namespace upReal\ProductBundle\Entity;

/**
 * Specification
 */
class Specification
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
     * @var string
     */
    private $fieldName;

    /**
     * @var string
     */
    private $fieldDesc;


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
     * @return Specification
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
     * Set fieldName
     *
     * @param string $fieldName
     *
     * @return Specification
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    /**
     * Get fieldName
     *
     * @return string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * Set fieldDesc
     *
     * @param string $fieldDesc
     *
     * @return Specification
     */
    public function setFieldDesc($fieldDesc)
    {
        $this->fieldDesc = $fieldDesc;

        return $this;
    }

    /**
     * Get fieldDesc
     *
     * @return string
     */
    public function getFieldDesc()
    {
        return $this->fieldDesc;
    }
}

