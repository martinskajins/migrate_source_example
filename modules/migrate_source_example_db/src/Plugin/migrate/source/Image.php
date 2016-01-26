<?php

/**
 * @file
 * Contains \Drupal\migrate_source_example_db\Plugin\migrate\source\Image.
 */

namespace Drupal\migrate_source_example_db\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Extract files from database.
 *
 * @MigrateSource(
 *   id = "migrate_source_example_db_image"
 * )
 */
class Image extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    return $this->select('migrate_source_example_db_files', 'u')
      ->fields('u', array('fid','filename'));
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields['fid'] = $this->t('File ID');
    $fields['filename'] = $this->t('File name');
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return array(
      'fid' => array(
        'type' => 'integer',
        'alias' => 'u',
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    parent::prepareRow($row);
    // Get filename property value.
    $filename = $row->getSourceProperty('filename');
    // Prepare base path.
    $base_path = trim($this->configuration['source_base_path'], '/');
    // Set "full_path" property to point to the full path of the image.
    $base_module_path = drupal_get_path('module', 'migrate_source_example');
    $row->setSourceProperty('full_path', $base_module_path . '/' . $base_path . '/' . $filename);
  }

}
