<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Docsismodem\Form;

use Zend\Form\Form;

/**
 * Description of SupplierForm
 *
 * @author andref
 */
class DocsismodemForm extends Form
{
    public function __construct($options = array())
    {
        // we want to ignore the name passed
        parent::__construct('docsismodem');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'macaddr',
            'attributes' => array(
                'type'  => 'text',
            ),
            "options" => array(
                "label" => "Mac Address"
            )
        ));
        $this->add(array(
            'name' => 'serialnumber',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Serial number',
            ),
        ));
        $this->add(array(
            'name' => 'macaddr_mta',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Mac Address EMTA',
            ),
        ));

        $this->add(array(
            'name' => 'tel1',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Line 1',
            ),
        ));

        $this->add(array(
            'name' => 'tel2',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Line 2',
            ),
        ));

        $this->add(array(
            'name' => 'config_file',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Boot File',
            ),
        ));

        $preElm = new \Zend\Form\Element\Select("presets");
        $preElm->setLabel("Pre-configured files");

        $presets = array();
        if (array_key_exists("presets", $options)) {
            $presets = $options['presets'];
        }

        $preElm->setAttribute("options", $presets);
        $this->add($preElm);

        $state = new \Zend\Form\Element\Select("state");
        $state->setLabel("State");
        $state->setAttribute("options", ["activo" => "Active", "cortado" => "Cut",
            "anulado" => "Unactive"]);
        $this->add($state);

        $brands = array();
        if (array_key_exists("brands", $options)) {
            $brands = $options['brands'];
        }

        $brand = new \Zend\Form\Element\Select("idbrand");
        $brand->setLabel("Brand");
        $brand->setAttribute("options", $brands);
        $this->add($brand, ["required" => false]);

        $model = new \Zend\Form\Element\Select("idmodel");
        $model->setLabel("Model");
        $model->setAttribute("options", [0 => "modelo 1", 1 => "modelo 2", 2 => "modelo 3"]);
        $this->add($model);

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add',
                'id' => 'submitbutton',
            ),
        ));
    }
}
