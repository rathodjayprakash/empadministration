<?php

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Ms.Empadministration',
    'EmpadminNewEmployee',
    'For Administrator - New Employee'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Ms.Empadministration',
    'EmpadminNewProject',
    'For Administrator - New Project'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Ms.Empadministration',
    'EmpadminNewDepartment',
    'For Administrator - New Department'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Ms.Empadministration',
    'EmpadminInfo',
    'For Employee - Show info'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Ms.Empadministration',
    'EmpadminProjectHours',
    'For Employee - Project Hours'
);


// Flexform for Employee
$pluginSignature = 'empadministration_empadminnewemployee';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    // Flexform configuration schema file
    'FILE:EXT:empadministration/Configuration/FlexForms/Employee_FlexForm.xml'
);
// Flexform for Employee