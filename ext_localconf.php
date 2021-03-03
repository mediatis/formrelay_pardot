<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

(function() {
    /** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $dispatcher */
    $dispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);

    // relay initalization
    $dispatcher->connect(
        \FormRelay\Core\Service\RegistryInterface::class,
        \Mediatis\Formrelay\Factory\RegistryFactory::SIGNAL_UPDATE_REGISTRY,
        \Mediatis\FormrelayPardot\Initialization::class,
        'initialize'
    );

    // configuration updater
    $dispatcher->connect(
        \Mediatis\Formrelay\Configuration\RouteConfigurationUpdaterInterface::class,
        \Mediatis\Formrelay\Configuration\RouteConfigurationUpdaterInterface::SIGNAL_UPDATE_ROUTE_CONFIGURATION,
        \Mediatis\FormrelayPardot\Configuration\ConfigurationUpdater::class,
        'updateRouteConfiguration'
    );
})();
