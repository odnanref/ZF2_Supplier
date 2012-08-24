<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Material\Model;

use Zend\Db\RowGateway\RowGateway;
use Zend\Db\Adapter\Adapter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Form\Annotation;

/**
 * Supplier entity class
 *
 * @author andref
 */
class Material extends RowGateway implements InputFilterAwareInterface
{
    protected $primaryKeyColumn = "idmaterial";

    private $inputFilter = null;

    public function __construct(Adapter $adapter)
    {
        parent::__construct( "idmaterial", "material", $adapter);
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($inpt = $factory->createInput(array(
                'name'     => 'idmaterial',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'description',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 254,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'stockable',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Boolean'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'allowtransport',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Boolean'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'allowbuytosupplier',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Boolean'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'allowbuybyclient',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Boolean'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'inhousebuild',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Boolean'),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function save()
    {
        unset($this->inputFilter);
        return parent::save();
    }
}
