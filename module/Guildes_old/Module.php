<?php

namespace Guildes;

use Guildes\Service\Guildes;
use Zend\Db\TableGateway\TableGateway;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Guildes\Service\Guildes' => function($sm) {
                    $tableGateway = $sm->get('GuildesGateway');
                    $config = $sm->get('config');
                    $table = new Guildes($tableGateway, $config, $sm);
                    return $table;
                },
                'GuildesGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    return new TableGateway('guildes', $dbAdapter);
                },
            )
        );
    }

    public function onBootstrap($e) {

        $serviceManager = $e->getApplication()->getServiceManager();
        $eventManager = $e->getApplication()->getEventManager()->getSharedManager();
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();



        //$viewModel->err[] = "TEST";
    }

}