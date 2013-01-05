<?php

namespace Docsismodem;

use Zend\Mvc\ModuleRouteListener;

class Module
{
    public function onBootstrap($e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $eventManager->attach('dispatch', array($this, 'preDispatch'), 100);
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function preDispatch($e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $helperHeadLink = $sm->get('viewhelpermanager')->get('headLink');
        $helperHeadLink->appendStylesheet( '/js/dojo/dijit/themes/claro/claro.css');
        $hHeadScript = $sm->get('viewhelpermanager')->get('headScript');
        $hHeadScript->appendFile('/js/dojo/dojo/dojo.js', 'text/javascript');

        $hHeadScript->appendScript('require( ["dojo/parser", 
        "dijit/layout/TabContainer", 
        "dijit/layout/ContentPane"]);')
        ->prependScript('var dojoConfig={
            has: {
                "dojo-firebug": false
            },
            parseOnLoad: true,
            async: true
        }');

    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Docsismodem\Model\DocsismodemTable' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table     = new \Docsismanager\Model\DocsismodemTable($dbAdapter);
                    return $table;
                }
            ),
        );
    }
}
