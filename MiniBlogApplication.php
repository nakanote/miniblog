<?php

/**
 * MiniBlogApplication.
 *
 * @author Katsuhiro Ogawa <fivestar@nequal.jp>
 */
class MiniBlogApplication extends Application
{
    protected $login_action = array('account', 'signin');

    public function getRootDir()
    {
        return dirname(__FILE__);
    }

    protected function registerRoutes()
    {
        return array(
            '/'
                => array('controller' => 'status', 'action' => 'index'),
            '/status/offset/:id'
                => array('controller' => 'status', 'action' => 'offset'),
            '/status/page/:id'
                => array('controller' => 'status', 'action' => 'page'),
            '/status/:action'
                => array('controller' => 'status'),
            '/user/:user_name'
                => array('controller' => 'status', 'action' => 'user'),
            '/user/:user_name/status/:id'
                => array('controller' => 'status', 'action' => 'show'),
            '/account'
                => array('controller' => 'account', 'action' => 'index'),
            '/account/password/:control'
                => array('controller' => 'account', 'action' => 'password'),
            '/account/:action'
                => array('controller' => 'account'),
            '/follow'
                => array('controller' => 'account', 'action' => 'follow'),
        );
    }

    protected function configure()
    {
        $this->db_manager->connect('master', array(
            'dsn'      => apache_getenv('DB_DSN'),
            'user'     => apache_getenv('DB_USER'),
            'password' => apache_getenv('DB_PASSWORD'),
        ));
    }
}
