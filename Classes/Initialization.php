<?php

namespace Mediatis\FormrelayPardot;

use FormRelay\Core\Service\RegistryInterface;
use FormRelay\Pardot\PardotInitialization;
use FormRelay\Request\Route\RequestRoute;

class Initialization
{
    public function initialize(RegistryInterface $registry)
    {
        PardotInitialization::initialize($registry);
        $registry->deleteRoute(RequestRoute::class);
    }
}
