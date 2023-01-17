<?php

namespace Julio\EndpointDocs\Src\Contracts;

use Julio\EndpointDocs\Src\Structures\{
    AuthStructure,
    BasicStructure,
    ParamsStructure,
};

abstract class Action
{
    protected AuthStructure $authStructure;
    protected ParamsStructure $paramsStructure;
    protected BasicStructure $basicStructure;

    public function __construct()
    {
        $this->authStructure = new AuthStructure();
        $this->paramsStructure = new ParamsStructure();
        $this->basicStructure = new BasicStructure();
    }
}
