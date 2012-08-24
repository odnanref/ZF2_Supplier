<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Supplier\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Supplier\Model\Supplier;
use Supplier\Form\SupplierForm;

/**
 * Description of SupplierController
 *
 * @author andref
 */
class SupplierController extends AbstractActionController
{
    protected $supplierTable = null;

    /**
     *
     * @return \Supplier\Model\SupplierTable
     */
    public function getSupplierTable()
    {
        if (!$this->supplierTable) {
            $sm = $this->getServiceLocator();
            $this->supplierTable = $sm->get('Supplier\Model\SupplierTable');
        }
        return $this->supplierTable;
    }

    protected $suppliertype = null;

    /**
     *
     * @return \Supplier\Model\SupplierType
     */
    public function getSupplierType()
    {
        if (!$this->suppliertype) {
            $sm = $this->getServiceLocator();
            $this->suppliertype = $sm->get('Supplier\Model\SupplierType');
        }
        return $this->suppliertype;
    }

    public function getSupplierTypes()
    {
        $r = $this->getSupplierType();
        $types = array(0 => '');
        foreach ($r->fetchAll() as $st ) {
            $types[$st->idsuppliertype] = $st->name;
        }

        return $types;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function addAction()
    {
        $form = new SupplierForm($this->getSupplierTypes());
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $supplier = new Supplier($this->getSupplierTable()->getAdapter());
            $form->setInputFilter($supplier->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $supplier->populate($form->getData());
                $id = $supplier->save();

                // Redirect to list of albums
                return $this->redirect()->toRoute('supplier', ['action' => 'list']);
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('supplier', array(
                'action' => 'add'
            ));
        }
        $supplierRow = $this->getSupplierTable()->fetchRow("idsupplier = " . (int) $id);
        $supplier = new Supplier($this->getSupplierTable()->getAdapter());

        $supplier->populateOriginalData((array)$supplierRow);

        $form = new SupplierForm($this->getSupplierTypes());
        $form->bind($supplierRow);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $form->setInputFilter($supplier->getInputFilter());
            if ($form->isValid()) {
                $supplier->populate((array)$supplierRow);
                $supplier->save();

                // Redirect to list of albums
                return $this->redirect()->toRoute('supplier', ['action' => 'list']);
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function searchAction()
    {
        return new ViewModel();
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('supplier', ['action' => 'list']);
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getsupplierTable()->delete("idsupplier = " . $id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('supplier', ['action' => 'list']);
        }

        return array(
            'id'    => $id,
            'supplier' => $this->getSupplierTable()
                ->fetchRow("idsupplier = " . (int) $id)
        );
    }

    public function listAction()
    {
        return new ViewModel(array(
            'suppliers' => $this->getSupplierTable()->getAll()
        ));
    }
}
