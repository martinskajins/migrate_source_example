<?php

/**
 * @file
 * Contains \Drupal\migrate_source_example_csv\Plugin\migrate\source\MigrateSourceExampleCSVImage.
 */

namespace Drupal\migrate_source_example_csv\Plugin\migrate\source;

use Drupal\migrate\Entity\MigrationInterface;
use Drupal\migrate\MigrateException;
use Drupal\migrate\Row;

/**
 * Book image migration.
 *
 * @MigrateSource(
 *   id = "migrate_source_example_csv_image"
 * )
 */
class MigrateSourceExampleCSVImage extends MigrateSourceExampleCSV {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $migration);

    // Source base path is required.
    if (empty($this->configuration['source_base_path'])) {
      throw new MigrateException('You must declare the "source_base_path" to the image source folder in your source settings.');
    }
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
