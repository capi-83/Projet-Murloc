<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Users;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Users\Model\Users;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager  = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        /*$oSessionUser = new Container('users');
        if(! empty($oSessionUser['users']))
        {
            $e->getViewModel()->setVariable('userConnect',true);
            $e->getViewModel()->setVariable('nom',$oSessionUser['users'][0]['pseudo']);
            $e->getViewModel()->setVariable('avatar',$oSessionUser['users'][0]['avatar']);
        }*/
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }


    /**
     * 
     * chemin du fichier du liaison pour l'autoload.
     * 
     * @return file
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
                ),
        );

    } 
    
    public function getServiceConfig() {
        return array(
                'factories' => array(
                    'Users\Model\Users' => function($sm) {
                        $tableGateway = $sm->get('UsersGateway');
                        $config = $sm->get('config');
                        $table = new Users($tableGateway, $config);
                        return $table;
                    },
                    'UsersGateway' => function($sm) {
                        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                        return new TableGateway('users', $dbAdapter);
                    },
                )
            );
    }
}
