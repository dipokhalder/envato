<?php

namespace Dipokhalder\Envato\Api;
class Me extends AbstractApi
{

    function __construct( $config )
    {
        $this->config = $config;
        parent::__construct();
    }

    public function sale( $code )
    {
        return $this->get('/v3/market/author/sale?code=' . $code);
    }

}
