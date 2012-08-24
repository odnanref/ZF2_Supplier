<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Supplier\Model;

use \Zend\Db\Adapter\Adapter;
use \Zend\Db\TableGateway\TableGateway;
use \Zend\Db\Sql\Select;
use \Zend\Db\ResultSet\ResultSet;

/**
 * Description of SupplierTable
 *
 * @author andref
 */
class SupplierTable extends TableParent
{
    protected $table           = "supplier";
    protected $primary         = "idsupplier";
    protected $ObjectPrototype = "Supplier";
    
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $tmp = "\Supplier\Model\\" . $this->ObjectPrototype;
        $this->resultSetPrototype->setArrayObjectPrototype(
                new $tmp($adapter)
                );
        parent::__construct($adapter);
        $this->initialize();
    }
    
    public function getAll()
    {
        $res = $this->select(function (Select $select ) {
            $select->join(
                    "suppliertype", 
                    "suppliertype.idsuppliertype = supplier.idsuppliertype",
                    array("type" => "name")
                    )->order("company ASC");
        }
        );
        
        return $res;
    }
    
}
