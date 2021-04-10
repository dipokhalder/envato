<?php

namespace Dipokhalder\Envato;

use Dipokhalder\Envato\Api\Authentication;
use Dipokhalder\Envato\Api\Forum;
use Dipokhalder\Envato\Api\Market;
use Dipokhalder\Envato\Api\Me;
use Dipokhalder\Envato\Api\User;

class Envato
{
    protected $config;
    protected $auth;

    public function __construct( $config )
    {
        $this->config = $config;
        $this->auth   = new Authentication($this->config);
        $this->auth->authenticate();
    }

    public function __call( $method, $args )
    {
        $arguments = array_merge([ $method ], $args);
        return call_user_func_array([
            $this,
            'api'
        ], $arguments);
    }

    public function api()
    {
        $args = func_get_args();
        $api  = '';
        if ( count($args) > 0 ) {
            $api = array_shift($args);
        }
        if ( count($args) == 0 ) {
            $args = null;
        }
        $api = strtolower($api);
        switch ( $api ) {
        case 'user':
            return new User($args[0], $this->config);
        case 'me':
            return new Me($this->config);
        case 'markets':
            return new Market($this->config);
        case 'forums':
            return new Forum($this->config);
        }
    }


    public function getAuthUrl()
    {
        return $this->auth->getAuthUrl();
    }

    public function clearCache()
    {
        $this->auth->clearCache();
    }
}
