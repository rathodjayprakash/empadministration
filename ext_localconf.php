<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Ms.Empadministration',
            'Empadministration',
            [
                'Office' => 'list, show, new, create, edit, update, delete',
                // 'Department' => 'list, show, new, create, edit, update, delete',
                // 'Employee' => 'list, show, new, create, edit, update, delete',
                // 'Project' => 'list, show, new, create, edit, update, delete',
                'Positions' => 'list, show, new, create, edit, update, delete',
                // 'ProjectAssignment' => 'list, show, new, create, edit, update, delete'
            ],
            // non-cacheable actions
            [
                'Office' => 'create, update, delete',
                // 'Department' => 'create, update, delete',
                // 'Employee' => 'create, update, delete',
                // 'Project' => 'create, update, delete',
                'Positions' => 'create, update, delete',
                // 'ProjectAssignment' => 'create, update, delete'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Ms.Empadministration',
            'EmpadminNewEmployee',
            [
                'Employee' => 'list, show, new, create, edit, update, delete',
            ],
            // non-cacheable actions
            [
                'Employee' => 'create, update, delete',
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Ms.Empadministration',
            'EmpadminNewProject',
            [
                'Project' => 'list, show, new, create, edit, update, delete',
            ],
            // non-cacheable actions
            [
                'Project' => 'create, update, delete',
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Ms.Empadministration',
            'EmpadminNewDepartment',
            [
                'Department' => 'list, show, new, create, edit, update, delete',
            ],
            // non-cacheable actions
            [
                'Department' => 'create, update, delete',
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Ms.Empadministration',
            'EmpadminInfo',
            [
                'Employee' => 'myinfo',
            ],
            // non-cacheable actions
            [
                'Employee' => 'myinfo',
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Ms.Empadministration',
            'EmpadminProjectHours',
            [
                'ProjectAssignment' => 'list, show, new, create, edit, update, delete',
            ],
            // non-cacheable actions
            [
                'ProjectAssignment' => 'create, update, delete',
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        empadministration {
                            iconIdentifier = empadministration-plugin-empadministration
                            title = LLL:EXT:empadministration/Resources/Private/Language/locallang_db.xlf:tx_empadministration_empadministration.name
                            description = LLL:EXT:empadministration/Resources/Private/Language/locallang_db.xlf:tx_empadministration_empadministration.description
                            tt_content_defValues {
                                CType = list
                                list_type = empadministration_empadministration
                            }
                        }
                    }
                    show = *
                }
           }'
        );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'empadministration-plugin-empadministration',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:empadministration/Resources/Public/Icons/user_plugin_empadministration.svg']
			);
		
    }
);


if (TYPO3_MODE=="FE" )   {
    $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
    $pageRenderer->loadRequireJsModule('TYPO3/CMS/Empadministration/MyMagicModule');
}