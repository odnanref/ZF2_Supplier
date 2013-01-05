<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Supplier\Filter;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Description of SupplierInputFilter
 *
 * @author andref
 */
class SupplierInputFilter extends InputFilter
{
    /**
     *
     * @var InputFactory
     */
    private $factory = null;

    public function __construct()
    {
        $this->factory = new InputFactory();
        $this->filter();
    }

    public function filter()
    {
        $this->add($inpt = $this->factory->createInput(array(
            'name' => 'idsupplier',
            'required' => false,
            'filters' => array(
                array('name' => 'Int'),
            ),
        )));

        $this->add($this->factory->createInput(array(
                    'name' => 'name',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min' => 1,
                                'max' => 254,
                            ),
                        ),
                    ),
                )));

        $this->add($this->factory->createInput(array(
                    'name' => 'company',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min' => 1,
                                'max' => 254,
                            ),
                        ),
                    ),
                )));

        $this->add($this->factory->createInput(array(
                    'name' => 'idsuppliertype',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'Int'),
                    ),
                )));
    }

}
