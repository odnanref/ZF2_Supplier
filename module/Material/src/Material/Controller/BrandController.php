<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Material\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Material\Model\Material;
use Material\Form\MaterialForm;

/**
 * Description of MaterialController
 *
 * @author andref
 */
class MaterialController extends AbstractActionController
{
    protected $materialTable = null;

    /**
     *
     * @return \Material\Model\MaterialTable
     */
    public function getMaterialTable()
    {
        if (!$this->materialTable) {
            $sm = $this->getServiceLocator();
            $this->materialTable = $sm->get('Material\Model\MaterialTable');
        }
        return $this->materialTable;
    }

    protected $materialtype = null;

    /**
     *
     * @return \Material\Model\MaterialType
     */
    public function getMaterialMaterialType()
    {
        if (!$this->materialtype) {
            $sm = $this->getServiceLocator();
            $this->materialtype = $sm->get('Material\Model\MaterialType');
        }
        return $this->materialtype;
    }

    public function getMaterialTypes()
    {
        $r = $this->getMaterialType();
        $types = array(0 => '');
        foreach ($r->fetchAll() as $st ) {
            $types[$st->idmaterialtype] = $st->name;
        }

        return $types;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function addAction()
    {
        $form = new MaterialForm($this->getMaterialTypes());
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $material = new Material($this->getMaterialTable()->getAdapter());
            $form->setInputFilter($material->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $material->populate($form->getData());
                $id = $material->save();

                // Redirect to list of albums
                return $this->redirect()->toRoute('material',
                        array('action' => 'list')
                        );
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('material', array(
                'action' => 'add'
            ));
        }
        $supplierRow = $this->getMaterialTable()->fetchRow("idmaterial = " . (int) $id);
        $supplier = new Material($this->getMaterialTable()->getAdapter());

        $supplier->populateOriginalData((array)$supplierRow);

        $form = new MaterialForm($this->getMaterialTypes());
        $form->bind($supplier);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $form->setInputFilter($supplier->getInputFilter());
            if ($form->isValid()) {
                $supplier->populate((array)$supplierRow);
                $supplier->save();

                // Redirect to list of albums
                return $this->redirect()->toRoute('material', ['action' => 'list']);
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
            return $this->redirect()->toRoute('supplier');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getsupplierTable()->delete("idsupplier = " . $id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('supplier');
        }

        return array(
            'id'    => $id,
            'supplier' => $this->getMaterialTable()
                ->fetchRow("idsupplier = " . (int) $id)
        );
    }

    public function listAction()
    {
        return new ViewModel(array(
            'suppliers' => $this->getMaterialTable()->getAll()
        ));
    }
}
