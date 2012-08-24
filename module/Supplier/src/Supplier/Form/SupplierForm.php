<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Supplier\Form;

use Zend\Form\Form;

/**
 * Description of SupplierForm
 *
 * @author andref
 */
class SupplierForm extends Form
{
    public function __construct($options = array())
    {
        // we want to ignore the name passed
        parent::__construct('supplier');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'idsupplier',
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
        
        $selType = new \Zend\Form\Element\Select("idsuppliertype");
        $selType->setLabel("Supplier Type");
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
