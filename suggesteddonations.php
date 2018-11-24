<?php

require_once 'suggesteddonations.civix.php';
use CRM_Suggesteddonations_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function suggesteddonations_civicrm_config(&$config) {
  _suggesteddonations_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function suggesteddonations_civicrm_xmlMenu(&$files) {
  _suggesteddonations_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function suggesteddonations_civicrm_install() {
  _suggesteddonations_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function suggesteddonations_civicrm_postInstall() {
  _suggesteddonations_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function suggesteddonations_civicrm_uninstall() {
  _suggesteddonations_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function suggesteddonations_civicrm_enable() {
  _suggesteddonations_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function suggesteddonations_civicrm_disable() {
  _suggesteddonations_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function suggesteddonations_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _suggesteddonations_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function suggesteddonations_civicrm_managed(&$entities) {
  _suggesteddonations_civix_civicrm_managed($entities);
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
function suggesteddonations_civicrm_caseTypes(&$caseTypes) {
  _suggesteddonations_civix_civicrm_caseTypes($caseTypes);
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
function suggesteddonations_civicrm_angularModules(&$angularModules) {
  _suggesteddonations_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function suggesteddonations_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _suggesteddonations_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function suggesteddonations_civicrm_entityTypes(&$entityTypes) {
  _suggesteddonations_civix_civicrm_entityTypes($entityTypes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function suggesteddonations_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 */
function suggesteddonations_civicrm_navigationMenu(&$menu) {
  _suggesteddonations_civix_insert_navigation_menu($menu, 'Administer', array(
    'label' => E::ts('Suggested Donation Settings'),
    'name' => 'suggested_donation_settings',
    'url' => 'civicrm/admin/setting/suggesteddonation',
    'permission' => 'administer CiviCRM',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _suggesteddonations_civix_navigationMenu($menu);
} // */

function suggesteddonations_civicrm_tokens(&$tokens) {
  $tokens['suggesteddonations'] = array(
    'suggesteddonations.largest' => ts("Largest Donation"),
  );

  $increments = Civi::settings()->get('sd_increments');
  foreach (explode(',', $increments) as $increment) {
    //ensure we have a numeric value
    if (is_numeric($increment)) {
      $tokens['suggesteddonations']['suggesteddonations.largest'.$increment] = ts('Largest Donation + ').$increment;
    }
  }
}

function suggesteddonations_civicrm_tokenValues(&$values, $cids, $job = null, $tokens = array(), $context = null) {
  //Civi::log()->debug('', ['$tokens' => $tokens, '$values' => $values]);

  if (!empty($tokens['suggesteddonations'])) {
    //TODO better validation of increments and fts...
    $increments = explode(',', Civi::settings()->get('sd_increments'));
    $increments = array_map('trim', $increments);

    $fts = Civi::settings()->get('sd_financialtypes');
    $fts = (!is_array($fts)) ? array($fts) : $fts;
    $fts = implode(',', $fts);

    $defaultAmt = Civi::settings()->get('sd_defaultamt');

    /*Civi::log()->debug('', [
      'increments' => $increments,
      'sd_financialtypes' => Civi::settings()->get('sd_financialtypes'),
      'fts' => $fts,
      'defaultAmt' => $defaultAmt,
    ]);*/

    foreach ($cids as $cid) {
      //get largest past donation
      $largest = CRM_Core_DAO::singleValueQuery("
        SELECT MAX(total_amount)
        FROM civicrm_contribution
        WHERE contact_id = %1
          AND financial_type_id IN (%2)
      ", [
        1 => [$cid, 'Positive'],
        2 => [$fts, 'String'],
      ]);

      if (empty($largest)) {
        $largest = $defaultAmt;
      }

      //set largest
      $values[$cid]['suggesteddonations.largest'] = number_format($largest, 0);
      $values[$cid]['largest'] = $largest;

      foreach ($increments as $increment) {
        if (is_numeric($increment)) {
          $tokens['suggesteddonations']['suggesteddonations.largest+'.$increment] = ts('Largest Previous Donation + ').$increment;

          $amt = number_format($largest * (1 + $increment * 0.01), 0);
          $key = 'largest'.$increment;
          $values[$cid]["suggesteddonations.{$key}"] = $amt;
          $values[$cid][$key] = $amt;
        }
      }
    }
  }
}
