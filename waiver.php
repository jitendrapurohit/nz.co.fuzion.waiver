<?php

require_once 'waiver.civix.php';
use CRM_Waiver_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function waiver_civicrm_config(&$config) {
  _waiver_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function waiver_civicrm_xmlMenu(&$files) {
  $files[] = dirname(__FILE__) . '/xml/waiver.xml';
  _waiver_civix_civicrm_xmlMenu($files);
}

function waiver_civicrm_searchColumns( $objectName, &$headers, &$rows, &$selector) {
  if ($objectName == 'contact') {
    $customFieldIDs = [];
    foreach ($headers as $key => $column) {
      if (strpos($column['name'], 'Waiver') === 0 && strpos($column['sort'], 'custom_') === 0 ) {
        $customFieldIDs[] = $column['sort'];
      }
    }
    if (!empty($customFieldIDs)) {
      foreach ($rows as $contactID => $values) {
        foreach ($customFieldIDs as $fieldID) {
          $latestValue = CRM_Waiver_BAO_Waiver::getLatestWaiver($fieldID, $contactID);
          if (!empty($latestValue)) {
            $rows[$contactID][$fieldID] = $latestValue;
          }
        }
      }
    }
  }
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function waiver_civicrm_install() {
  _waiver_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function waiver_civicrm_postInstall() {
  _waiver_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function waiver_civicrm_uninstall() {
  _waiver_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function waiver_civicrm_enable() {
  _waiver_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function waiver_civicrm_disable() {
  _waiver_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function waiver_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _waiver_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function waiver_civicrm_managed(&$entities) {
  _waiver_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function waiver_civicrm_caseTypes(&$caseTypes) {
  _waiver_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function waiver_civicrm_angularModules(&$angularModules) {
  _waiver_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function waiver_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _waiver_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function waiver_civicrm_entityTypes(&$entityTypes) {
  _waiver_civix_civicrm_entityTypes($entityTypes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function waiver_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function waiver_civicrm_navigationMenu(&$menu) {
  _waiver_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _waiver_civix_navigationMenu($menu);
} // */
