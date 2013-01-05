<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Far\SupplierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Supplier Entity Document
 *
 * @author andref
 *
 * @ORM\Entity
 * @ORM\Table(name="suppliers")
 * @property string $name
 * @property string $company
 * @property SupplierType $type
 */
class Supplier implements InputFilterAwareInterface
{
    protected $inputFilter;

    /**
     *
     * @ORM\Id
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
    protected $company;

    /**
     *
     * @ORM\ReferenceOne("suppliertype")
     */
    protected $type;

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
     * @return Supplier
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
     * Set company
     *
     * @param string $company
     * @return Supplier
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * Get company
     *
     * @return string $company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Supplier
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * Populate from an array.
     *
     * @param array $data
     *
     * @return Supplier
     */
    public function populate(array $data = array())
    {
        $a = new \ReflectionObject($this);
        foreach ($data as $k => $val ) {
            if ($a->hasProperty($k)) {
                $this->$k = $val;
            }
        }
        return $this;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if ($this->inputFilter === null ) {
            $this->inputFilter = new Supplier\Filter\SupplierInputFilter();
        }
        return $this->inputFilter;
    }
}
