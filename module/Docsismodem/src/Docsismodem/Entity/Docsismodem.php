<?php

namespace Docsismodem\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Docsis cable modem
 *
 * @ORM\Entity
 * @ORM\Table(name="docsismodem")
 * @property string $macaddr
 * @property string $first_online
 * @property string $last_online
 * @property int $reg_count
 * @property string $serialnum
 * @property string $ipaddr
 * @property string $config_file
 * @property int $cmts_vlan
 * @property int $subnum
 * @property string $estado
 * @property string $datamudado
 * @property string $lastip
 * @property string $tel1
 * @property string $tel2
 * @property string $macaddr_mta
 * @property string $config_file_mta
 * @property int $idmodel
 * @property string $node
 *
 */
class Docsismodem implements InputFilterAwareInterface
{
    protected $inputFilter = null;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string")
     */
    protected $macaddr;
    /**
     * @ORM\Column(type="string")
     */
    protected $first_online;
    /**
     * @ORM\Column(type="string")
     */
    protected $last_online;
    /**
     * @ORM\Column(type="integer")
     */
    protected $reg_count;
    /**
     * @ORM\Column(type="string")
     */
    protected $serialnum;
    /**
     * @ORM\Column(type="string")
     */
    protected $ipaddr;
    /**
     * @ORM\Column(type="string")
     */
    protected $config_file;
    /**
     * @ORM\Column(type="integer")
     */
    protected $cmts_vlan;
    /**
     * @ORM\Column(type="integer")
     */
    protected $subnum;
    /**
     * @ORM\Column(type="string")
     */
    protected $estado;
    /**
     * @ORM\Column(type="string")
     */
    protected $datamudado;
    /**
     * @ORM\Column(type="string")
     */
    protected $lastip;
    /**
     * @ORM\Column(type="string")
     */
    protected $tel1;
    /**
     * @ORM\Column(type="string")
     */
    protected $tel2;
    /**
     * @ORM\Column(type="string")
     */
    protected $macaddr_mta;
    /**
     * @ORM\Column(type="string")
     */
    protected $config_file_mta;
    /**
     * @ORM\Column(type="integer")
     */
    protected $idmodel;
    /**
     * @ORM\Column(type="string")
     */
    protected $node;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }
    /**
     * Convert the object to Array
     *
     * @return Array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function populate(array $Data = array())
    {
        foreach ($Data as $prop => $value) {
            if (property_exists(array($this, $prop))) {
                $this->$prop = $value;
            }
        }
        return $this;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new Exception("Not used.");
    }

    public function getInputFilter()
    {
        return new \Docsismodem\Filter\DMInputFilter();
    }
}
