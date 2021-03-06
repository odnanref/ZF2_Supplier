<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Material\Model;

use \Zend\Db\Adapter\Adapter;
use \Zend\Db\TableGateway\TableGateway;
use Zend\Db\RowGateway\RowGateway;
use \Zend\Db\Sql\Select;
use \Zend\Db\ResultSet\ResultSet;

/**
 * Description of SupplierType
 *
 * @author andref
 */
class MaterialType extends TableParent
{
    protected $table           = "materialtype";
    protected $primary         = "idmaterialtype";
    protected $ObjectPrototype = null;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        parent::__construct($adapter);
        $this->initialize();
    }
}
