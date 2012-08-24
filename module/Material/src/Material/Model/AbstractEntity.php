<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace \Material\Model;

/**
 * Description of AbstractEntity
 *
 * @author andref
 */
abstract class AbstractEntity extends \Zend\Db\RowGateway\RowGateway
{
    /**
     * This variable object should be an extension of TableParent
     *
     * @var TableParent
     */
    protected $table = null;

    /**
     *
     *
     * @param Array $data
     * @return \Supplier\Model\AbstractEntity
     */
    public function setFromArray($data)
    {
        return $this->exchangeArray($data);
    }

    /**
     * set from array
     *
     * @param Array $data
     * @return \Supplier\Model\AbstractEntity
     */
    public function exchangeArray($data)
    {
        $vars = get_object_vars($this);
        foreach ($data as $k => $value ) {
            if (in_array($k, $vars)) {
                $this->{$k} = $value;
            }
        }
        return $this;
    }

    public function toArray()
    {
        $vars   = get_object_vars($this);
        $Out    = array();
        foreach ($vars as $k ) {
            $Out[$k] = $this->{$k};
        }
        return $Out;
    }

    protected function preInsert()
    {

    }

    protected function postInsert()
    {

    }

    protected function preUpdate()
    {

    }

    protected function postUpdate()
    {

    }

    public function save()
    {
        if ($this->table === null) {
            throw new \Exception("Table property doesn't exist");
        }
        $update = false;

        if (($primary = $this->table->primary) !== null &&
                $this->{$primary} > 0 ) {
            $this->preUpdate();
            $update = true;
        } else {
            $this->preInsert();
        }

        $id = $this->table->save($this->toArray());

        if ($update === true ) {
            $this->postUpdate();
        } else {
            $this->postInsert();
        }

        return $id;
    }

    public function delete()
    {
        if ($this->table === null) {
            throw new \Exception("Table property doesn't exist");
        }

        return $this->table->delete(
                array(
            $this->table->getPrimary(),
            $this->{$this->table->getPrimary()}
            ));

    }
}
