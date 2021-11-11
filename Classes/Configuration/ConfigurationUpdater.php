<?php

namespace Mediatis\FormrelayPardot\Configuration;

use Mediatis\Formrelay\Configuration\RouteConfigurationUpdaterInterface;

class ConfigurationUpdater implements RouteConfigurationUpdaterInterface
{
    protected function updateUrlConfiguration(array &$routeConfiguration)
    {
        if (array_key_exists('pardotUrl', $routeConfiguration)) {
            if (!array_key_exists('url', $routeConfiguration)) {
                $routeConfiguration['url'] = $routeConfiguration['pardotUrl'];
            }
            unset($routeConfiguration['pardotUrl']);
        }
    }

    public function updateRouteConfiguration(string $routeName, array &$routeConfiguration)
    {
        if ($routeName === 'pardot') {
            $this->updateUrlConfiguration($routeConfiguration);
        }
    }
}
