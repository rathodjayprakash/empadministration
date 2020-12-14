<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Ms.Empadministration',
            'Empadministration',
            'Employee Administration'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('empadministration', 'Configuration/TypoScript', 'Employee Administration');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_empadministration_domain_model_office', 'EXT:empadministration/Resources/Private/Language/locallang_csh_tx_empadministration_domain_model_office.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_empadministration_domain_model_office');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_empadministration_domain_model_department', 'EXT:empadministration/Resources/Private/Language/locallang_csh_tx_empadministration_domain_model_department.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_empadministration_domain_model_department');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_empadministration_domain_model_employee', 'EXT:empadministration/Resources/Private/Language/locallang_csh_tx_empadministration_domain_model_employee.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_empadministration_domain_model_employee');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_empadministration_domain_model_project', 'EXT:empadministration/Resources/Private/Language/locallang_csh_tx_empadministration_domain_model_project.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_empadministration_domain_model_project');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_empadministration_domain_model_positions', 'EXT:empadministration/Resources/Private/Language/locallang_csh_tx_empadministration_domain_model_positions.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_empadministration_domain_model_positions');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_empadministration_domain_model_projectassignment', 'EXT:empadministration/Resources/Private/Language/locallang_csh_tx_empadministration_domain_model_projectassignment.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_empadministration_domain_model_projectassignment');

    }
);
