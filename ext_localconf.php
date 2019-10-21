<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

(function() {
    $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
    $registry = $objectManager->get(\Mediatis\Formrelay\Service\Registry::class);
    $registry->registerDestination(\Mediatis\FormrelayPardot\Destination\Pardot::class);
})();
