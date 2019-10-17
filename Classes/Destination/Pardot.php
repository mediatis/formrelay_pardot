<?php

namespace Mediatis\FormrelayPardot\Destination;

use Mediatis\Formrelay\Destination\AbstractDestination;
use Mediatis\Formrelay\DataDispatcher\RequestDispatcher;

class Pardot extends AbstractDestination
{
    public function getExtensionKey(): string
    {
        return "tx_formrelay_pardot";
    }

    protected function getDispatcher(array $conf, array $data, array $context)
    {
        $cookies = [];
        foreach ($_COOKIE as $key => $value) {
            if (preg_match('/^visitor_id[0-9]+$/', $key)) {
                $cookies[$key] = $value;
            }
        }
        $pardotUrl = $conf['pardotUrl'];
        return $this->objectManager->get(RequestDispatcher::class, $pardotUrl, $cookies);
    }
}
