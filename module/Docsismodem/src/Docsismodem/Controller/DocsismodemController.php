<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Docsismodem\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Docsismodem\Entity\Docsismodem;
use Docsismodem\Form\DocsismodemForm;
use Doctrine\ORM\EntityManager;

/**
 * Description of SupplierController
 *
 * @author andref
 */
class DocsismodemController extends AbstractActionController
{
   /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

   protected $docsismodemTable = null;

   public function setdocsismodemTable(\Docsismanager\Model\DocsismodemTable $dmTable)
   {
        $this->docsismodemTable = $dmTable;
        return $this;
   }
    /**
     *
     * @return \Docsismanager\Model\DocsismodemTable
     */
    public function getDocsismodemTable()
    {
        if (!$this->docsismodemTable) {
            //$sm = $this->getServiceLocator();
            //$this->docsismodemTable = $sm->get('docsismodem-table');
            $this->docsismodemTable = $this->getEntityManager()->getRepository('Docsismodem\Entity\Docsismodem');
        }
        return $this->docsismodemTable;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function addAction()
    {
        $form = new DocsismodemForm();
        $form->get('submit')->setValue('Add');

        $dms = $this->getDocsismodemTable();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $docsismodem = new Docsismodem();
            $form->setInputFilter($docsismodem->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $docsismodem->populate($form->getData());
                $id = $this->em->persist($docsismodem);
                $this->em->flush();

                // Redirect to list of modems
                return $this->redirect()->toRoute('docsismodem',
                    ['action' => 'list']
                );
            } else {
                //var_dump($form);
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('docsismodem', array(
                'action' => 'add'
            ));
        }
        $DMRow      = $this->getDocsismodemTable()->fetchRow("macaddr = ? ", $id);
        $docsismodem = new Docsismodem($this->getDocsismodemTable()->getAdapter());
        $docsismodem->populate((array)$DMRow, true);

        $form = new DocsismodemForm();
        $form->bind($docsismodem);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $form->setInputFilter($docsismodem->getInputFilter());
            if ($form->isValid()) {
                $docsismodem->exchangeArray($docsismodem);
                $id = $docsismodem->save();

                // Redirect to list of modems
                return $this->redirect()->toRoute('docsismodem', ['action' => 'list']);
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
            return $this->redirect()->toRoute('docsismodem', ['action' => 'list']);
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getDocsismodemTable()->delete("macaddr = ? ", $id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('docsismodem', ['action' => 'list']);
        }

        return array(
            'id'    => $id,
            'docsismodem' => $this->getDocsismodemTable()
                ->fetchRow("macaddr = ? " , (int) $id)
        );
    }

    public function listAction()
    {
        return new ViewModel(array(
            'modems' => $this->getEntityManager()->getRepository('Docsismodem\Entity\Docsismodem')->findAll()
        ));
    }
}
