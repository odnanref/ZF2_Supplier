<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Docsismodem\Filter;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Description of DMInputFilter
 *
 * @author andref
 */
class DMInputFilter extends InputFilter
{

    /**
     *
     * @var InputFactory
     */
    protected $factory = null;

    public function __construct()
    {
        $this->factory = new InputFactory();
        $this->filter();
    }

    public function filter()
    {
        $factory = new InputFactory();

        $MacChain = new \Zend\Filter\FilterChain();
        $MacChain->attach(new \Zend\Filter\StringToUpper());
        $MacChain->attach(new \Zend\Filter\StringTrim());
        $MacChain->attach(new \Zend\Filter\Word\SeparatorToSeparator( ':', ''));
        $MacChain->attach(new \Zend\Filter\Word\SeparatorToSeparator( '.', ''));
        $MacChain->attach(new \Zend\Filter\Word\SeparatorToSeparator( '-', ''));


        $length = new \Zend\Validator\StringLength();
        $length->setMax(12)->setMin(12);

        $MacvChain = new \Zend\Validator\ValidatorChain();
        $MacvChain->attach($length);

        $macaddr = $factory->createInput(array("name" => "macaddr"));
        $macaddr->setRequired(true);

        $macaddr->setFilterChain($MacChain);
        $macaddr->setValidatorChain($MacvChain);

        $this->add($macaddr);

        $first_online = $factory->createInput(array("name" => "first_online"));
        $first_online->setAllowEmpty(true);
        $first_online->setRequired(false);

        $this->add($first_online);

        $last_online = $factory->createInput(array("name" => "last_online"));
        $last_online->setAllowEmpty(true);
        $last_online->setRequired(false);

        $this->add($last_online);

        $reg_count = $factory->createInput(array("name" => "reg_count"));
        $reg_count->setAllowEmpty(true);
        $reg_count->setRequired(false);

        $this->add($reg_count);

        $serialnum = $factory->createInput(array("name" => "serialnum"));
        $serialnum->setAllowEmpty(true);
        $serialnum->setRequired(false);

        $filterChain = new \Zend\Filter\FilterChain();
        $filterChain->attach(new \Zend\Filter\StringToUpper());
        $filterChain->attach(new \Zend\Filter\StripTags());
        $serialnum->setFilterChain($filterChain);

        $this->add($serialnum);
        // IP Address INPUT
        $ipaddr = $factory->createInput(array("name" => "ipaddr"));
        $ipaddr->setAllowEmpty(true);
        $ipaddr->setRequired(false);
        $this->add($ipaddr);

        // Config file input
        $configfilterChain = new \Zend\Filter\FilterChain();
        $configfilterChain->attach(new \Zend\Filter\StringTrim());
        $configfilterChain->attach(new \Zend\Filter\StripTags());

        $config_file = $factory->createInput(array("name" => "config_file"));
        $config_file->setRequired(false);

        $config_file->setFilterChain($configfilterChain);

        $this->add($config_file);

        // Estado input
        $estado = $factory->createInput(array("name" => "estado"));
        $estado->setAllowEmpty(false);
        $estado->setRequired(true);

        $vChain = new \Zend\Validator\ValidatorChain();
        $vChain->attach(new \Zend\Validator\InArray(array("activo" => "activo",
            "anulado" => "anulado", "cortado" => "cortado")));

        $estado->setValidatorChain($vChain);

        $this->add($estado);

        // Tel 1

        $tel1 = $factory->createInput(array("name" => "tel1"));
        $tel1->setRequired(false);
        $tel1->setAllowEmpty(true);

        $chainTel = new \Zend\Validator\ValidatorChain();
        $chainTel->attach(new \Zend\Validator\Digits());
        $chainTel->attach(new \Zend\Validator\StringLength(
                array("min" => 9, "max" => 11 )
                ));

        $tel1->setValidatorChain($chainTel);
        $this->add($tel1);

        // TEl 2
        $tel2 = clone $tel1;
        $tel2->setName("tel2");
        $this->add($tel2);

        // Mac address Mta

        $macaddr = $factory->createInput(array("name" => "macaddr_mta"));
        $macaddr->setRequired(false);

        $macaddr->setFilterChain($MacChain);
        $macaddr->setValidatorChain($MacvChain);

        $this->add($macaddr);

        // Config File Mta
        $config_file_mta = $factory->createInput(array("name" => "config_file_mta"));
        $config_file_mta->setRequired(false);

        $config_file_mta->setFilterChain($configfilterChain);

        $this->add($config_file_mta);

        // ID Model
        $val = new \Zend\Validator\ValidatorChain();
        $val->attach(new \Zend\Validator\Digits);

        $idmodel = $factory->createInput(array("name" => "idmodel"));
        $idmodel->setValidatorChain($val);
        $this->add($idmodel);
        // Had to keep brand in the filter do to \Zend\Form\Element\Select 
        // allways having require => true
        $brand = $factory->createInput(array("name" => "idbrand"));
        $brand->setRequired(false);
        $this->add($brand);

        // Node
        $FilNode = new \Zend\Filter\FilterChain();
        $FilNode->attach(new \Zend\Filter\StringToUpper());
        $FilNode->attach(new \Zend\Filter\StringTrim());

        $node = $factory->createInput(array("name" => "node"));
        $node->setRequired(false);
        $node->setFilterChain($FilNode);

        $this->add($node);

        return $this;
    }

}
