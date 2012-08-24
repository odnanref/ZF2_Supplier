<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Brand\Brand;

use \Zend\Db\Adapter\Adapter;
use \Zend\Db\TableGateway\TableGateway;
use \Zend\Db\Sql\Select;
use \Zend\Db\ResultSet\ResultSet;

/**
 * Description of SupplierTable
 *
 * @author andref
 */
class BrandTable extends TableParent
{
    protected $table           = "brand";
    protected $primary         = "idbrand";
    protected $ObjectPrototype = "Brand";

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $tmp = "\\" . __NAMESPACE__ . "\\" . $this->ObjectPrototype;
        $this->resultSetPrototype->setArrayObjectPrototype(
                new $tmp($adapter)
                );
        parent::__construct($adapter);
        $this->initialize();
    }

    public function getAll()
    {
        $res = $this->select();

        return $res;
    }

}
