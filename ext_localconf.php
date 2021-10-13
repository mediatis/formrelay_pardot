<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

(function () {
    // relay initalization
    \Mediatis\Formrelay\Utility\RegistrationUtility::registerInitialization(\Mediatis\FormrelayPardot\Initialization::class);

    /** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $dispatcher */
    $dispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);

    // configuration updater
    \Mediatis\Formrelay\Utility\RegistrationUtility::registerRouteConfigurationUpdater(\Mediatis\FormrelayPardot\Configuration\ConfigurationUpdater::class);
})();
