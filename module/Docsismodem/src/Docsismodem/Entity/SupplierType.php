<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Far\SupplierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of SupplierType
 *
 * @author andref
 * @ORM\Table(name="suppliers")
 * @property int $Id id
 * @property String $name Description
 * @property string $code char code for supplier
 */
class SupplierType
{
    /**
     *
     * @ORM\Column(type="integer")
     */
    protected $Id;
    /**
     *
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     *
     * @ORM\Column(type="string")
     */
    protected $code;

    /**
     * Get Id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return SupplierType
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return SupplierType
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get code
     *
     * @return string $code
     */
    public function getCode()
    {
        return $this->code;
    }
}
