<?php
namespace EWW\Dpf\Security;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

class ResearcherAuthorization extends Authorization
{
    /**
     *
     * @param string $arttribute
     */
    public function checkAttributePermission($attribute)
    {
        switch ($attribute) {
            case 'EWW\Dpf\Controller\DocumentController::defaultAction':
            case 'EWW\Dpf\Controller\DocumentController::myPublicationsAction':
            case 'EWW\Dpf\Controller\DocumentFormBackofficeController::deleteAction':
            case 'EWW\Dpf\Controller\DocumentFormBackofficeController::cancelAction':
            case 'EWW\Dpf\Controller\DocumentFormBackofficeController::editAction':
            case 'EWW\Dpf\Controller\DocumentFormBackofficeController::updateAction':
            case 'EWW\Dpf\Controller\DocumentFormBackofficeController::newAction':
            case 'EWW\Dpf\Controller\DocumentFormBackofficeController::createAction':
            case 'EWW\Dpf\Controller\SearchController::listAction':
            case 'EWW\Dpf\Controller\SearchController::searchAction':
            case 'EWW\Dpf\Controller\SearchController::extendedSearchAction':
            case 'EWW\Dpf\Controller\SearchController::latestAction':
            case 'EWW\Dpf\Controller\SearchController::nextResultsAction': {
                return TRUE;
                break;
            }

            default: return FALSE;
        }
    }

}