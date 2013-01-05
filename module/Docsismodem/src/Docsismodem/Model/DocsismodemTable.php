<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Docsismanager\Model;

use \Zend\Db\Adapter\Adapter;
use \Zend\Db\TableGateway\TableGateway;
use \Zend\Db\Sql\Select;
use \Zend\Db\ResultSet\ResultSet;

/**
 * Description of DocsismodemTable
 *
 * @author andref
 */
class DocsismodemTable extends TableParent
{
    protected $table           = "docsismodem";
    protected $primary         = "macaddr";
    protected $ObjectPrototype = "Docsismodem";

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $tmp = "\Docsismanager\Model\\" . $this->ObjectPrototype;
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
