<?php

namespace Mediatis\FormrelayPardot;

use FormRelay\Core\Service\RegistryInterface;
use FormRelay\Pardot\PardotInitialization;

class Initialization
{
    public function initialize(RegistryInterface $registry)
    {
        PardotInitialization::initialize($registry);
    }
}
