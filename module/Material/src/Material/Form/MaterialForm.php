<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Material\Form;

use Zend\Form\Form;

/**
 * Description of SupplierForm
 *
 * @author andref
 */
class MaterialForm extends Form
{
    public function __construct($options = array())
    {
        // we want to ignore the name passed
        parent::__construct('material');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'idmaterial',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Name',
            ),
        ));
        $this->add(array(
            'name' => 'company',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Company',
            ),
        ));

        $selType = new \Zend\Form\Element\Select("idmaterialtype");
        $selType->setLabel("Material Type");
        $selType->setAttribute("options", $options);
        $this->add($selType);

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}
