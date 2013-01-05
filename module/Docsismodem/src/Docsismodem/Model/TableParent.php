<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Supplier\Model;

use \Zend\Db\Adapter\Adapter;
use \Zend\Db\TableGateway\TableGateway;
use Zend\Db\RowGateway\RowGateway;
use \Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;

/**
 * Description of TableParent
 *
 * @author andref
 */
class TableParent extends TableGateway
{
    protected $table           = null;
    
    protected $primary         = null;
    
    public function getPrimary()
    {
        return $this->primary;
    }
    
    protected $ObjectPrototype = null;
    
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        
        $this->resultSetPrototype = new ResultSet();
        
        if ($this->ObjectPrototype !== null ) {
            $tmp = __NAMESPACE__ . "\\" . ucfirst($this->ObjectPrototype);
            $this->resultSetPrototype->setArrayObjectPrototype(
                new $tmp($adapter)
                );
        } else {
            $this->resultSetPrototype->setArrayObjectPrototype(
                new RowGateway($this->primary, $this->table, $adapter)
                );
        }
        parent::__construct($this->table, $adapter);
    }
    
    public function fetchAll($condition = null)
    {
        return $this->select();
    }
    
    public function fetchRow($condition = null)
    {
        return $this->select($condition)->current();
    }
        
    public function save($Data)
    {
        if ( !($Data instanceOf AbstractEntity) && !is_array($Data)) {
            throw new \Exception("Data not a instance of AbstractEntity or neither is array");
        }
        
        if (($Data instanceOf AbstractEntity)) {
            $Data = $Data->toArray(); 
            // shouln't a Array be the same has a object
            // when in a foreach...
        }
        
        $id = null;
        if (isset($Data[$this->primary]) && $Data[$this->primary] > 0 ) {
            $id = (double) $Data[$this->primary];
        } else {
            $id = 0;
        }
        
        if ($id <= 0) {
            $affected = 0;
            if ( ($affected = $this->insert($Data)) > 0 ) {
                return $this->getLastInsertValue();
            } else {
                return $affected;
            }
        } else {
            // I trust the id really exists in the table
            return $this->update($Data, "{$this->primary}" . " = " . (double) $id);
        }
    }
    
}
