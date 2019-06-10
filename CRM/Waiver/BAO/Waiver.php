<?php

class CRM_Waiver_BAO_Waiver {

  /**
   * Sort by waiver Date.
   */
  public static function getMultiRecordFieldList() {
    $wDateColumnKey = NULL;
    if (!empty($_GET['columns'])) {
      foreach ($_GET['columns'] as $key => $value) {
        if (strpos($value['data'], 'waiver_date') === 0) {
          $wDateColumnKey = $key;
        }
      }
    }
    if (empty($_GET['order'])) {
      $_GET['order'] = [
        [
          'column' => $wDateColumnKey,
          'dir' => 'desc',
        ]
      ];
    }
    CRM_Custom_Page_AJAX::getMultiRecordFieldList();
  }

  /**
   * Get latest waiver record to display on search results.
   */
  public static function getLatestWaiver($fieldID, $entityID) {
    $waiverDateColumn = 'waiver_date_7';

    list(, $customFieldID) = explode('_', $fieldID);
    $customFieldID = trim($customFieldID);

    if (is_numeric($customFieldID)) {
      $columnNameDAO = CRM_Core_DAO::executeQuery("
        SELECT ccf.column_name, ccf.custom_group_id, ccg.table_name
        FROM civicrm_custom_field ccf
          LEFT JOIN civicrm_custom_group ccg ON ccf.custom_group_id = ccg.id
        WHERE ccf.id = {$customFieldID}");
      $columnNameDAO->fetch();


      $fieldValue = CRM_Core_DAO::singleValueQuery(
        "SELECT {$columnNameDAO->column_name}
        FROM {$columnNameDAO->table_name}
        WHERE entity_id = {$entityID}
        ORDER BY {$waiverDateColumn} DESC
        LIMIT 1");

      $returnValues = [];
      $returnProperities = [
        'data_type',
        'date_format',
      ];
      $param = ['id' => $customFieldID];
      CRM_Core_DAO::commonRetrieve('CRM_Core_DAO_CustomField', $param, $returnValues, $returnProperities);
      if ($returnValues['data_type'] == 'Date') {
        $actualPHPFormats = CRM_Utils_Date::datePluginToPHPFormats();
        $dateFormat = (array) CRM_Utils_Array::value($returnValues['date_format'], $actualPHPFormats);
        $fieldValue = CRM_Utils_Date::processDate($fieldValue, NULL, FALSE, implode(" ", $dateFormat));
      }

      return $fieldValue;
    }
    return NULL;
  }

}
