<?php

/**
 * DbManager.
 *
 * @author Katsuhiro Ogawa <fivestar@nequal.jp>
 */
class DbManager
{
    protected $connections = array();
    protected $repository_connection_map = array();
    protected $repositories = array();

    /**
     * 繝・・繧ｿ繝吶・繧ｹ縺ｸ謗･邯・
     *
     * @param string $name
     * @param array $params
     */
    public function connect($name, $params)
    {
        $params = array_merge(array(
            'dsn'      => null,
            'user'     => '',
            'password' => '',
            'options'  => array(),
        ), $params);

        $con = new PDO(
            $params['dsn'],
            $params['user'],
            $params['password'],
            $params['options']
        );

        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->connections[$name] = $con;
    }

    /**
     * 繧ｳ繝阪け繧ｷ繝ｧ繝ｳ繧貞叙蠕・
     *
     * @string $name
     * @return PDO
     */
    public function getConnection($name = null)
    {
        if (is_null($name)) {
            return current($this->connections);
        }

        return $this->connections[$name];
    }

    /**
     * 繝ｪ繝昴ず繝医Μ縺斐→縺ｮ繧ｳ繝阪け繧ｷ繝ｧ繝ｳ諠・ｱ繧定ｨｭ螳・
     *
     * @param string $repository_name
     * @param string $name
     */
    public function setRepositoryConnectionMap($repository_name, $name)
    {
        $this->repository_connection_map[$repository_name] = $name;
    }

    /**
     * 謖・ｮ壹＆繧後◆繝ｪ繝昴ず繝医Μ縺ｫ蟇ｾ蠢懊☆繧九さ繝阪け繧ｷ繝ｧ繝ｳ繧貞叙蠕・
     *
     * @param string $repository_name
     * @return PDO
     */
    public function getConnectionForRepository($repository_name)
    {
        if (isset($this->repository_connection_map[$repository_name])) {
            $name = $this->repository_connection_map[$repository_name];
            $con = $this->getConnection($name);
        } else {
            $con = $this->getConnection();
        }

        return $con;
    }

    /**
     * 繝ｪ繝昴ず繝医Μ繧貞叙蠕・
     *
     * @param string $repository_name
     * @return DbRepository
     */
    public function get($repository_name)
    {
        if (!isset($this->repositories[$repository_name])) {
            $repository_class = $repository_name . 'Repository';
            $con = $this->getConnectionForRepository($repository_name);

            $repository = new $repository_class($con);

            $this->repositories[$repository_name] = $repository;
        }

        return $this->repositories[$repository_name];
    }

    /**
     * 繝・せ繝医Λ繧ｯ繧ｿ
     * 繝ｪ繝昴ず繝医Μ縺ｨ謗･邯壹ｒ遐ｴ譽・☆繧・
     */
    public function __destruct()
    {
        foreach ($this->repositories as $repository) {
            unset($repository);
        }

        foreach ($this->connections as $con) {
            unset($con);
        }
    }
}
