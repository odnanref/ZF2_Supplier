<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Supplier\Model;

/**
 * Contact details
 *
 * @author andref
 */
class Contact extends \Supplier\Model\AbstractEntity
{
    public $id;
    
    public $name;
        
    private $phone = array();
    
    public function getPhones()
    {
        return $this->phone;
    }
    
    public function addPhone($phone)
    {
        $this->phone[] = $phone;
        return $this;
    }
    
    public function setPhone(array $Phones)
    {
        $this->phone = $Phones;
        return $this;
    }
    
    private $mobile = array();
    
    public function getMobile()
    {
        return $this->mobile;
    }
    
    public function addMobile($phone)
    {
        $this->mobile[] = $phone;
        return $this;
    }
    
    public function setMobile(array $Phones)
    {
        $this->mobile = $Phones;
        return $this;
    }
    
    public $address;
    
    public $country;
    
    private $email = array();
    
    public function setEmails(array $email)
    {
        $this->email = $email;
        return $this;
    }
    
    public function addEmail($email)
    {
        $this->email[] = $email;
        return $this;
    }
    
    public function getEmails()
    {
        return $this->email;
    }

    public $website;
}
