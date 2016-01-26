# Migrate source example

`migrate_source_example` is a module that contains a set of sub-modules that provide content migrations from different 
sources.

Currently features migrations from following sources:
1. CSV files;
2. External (non-Drupal) database tables.

## Installation

1. Install Drupal 8 compatible `drush`.
2. Install Drupal 8 using `Standard` profile.
3. Download `migrate_tools` contrib module into `modules/contrib/migrate_tools` (see [instructions](https://www.drupal.org/project/migrate_tools/git-instructions)).
4. Download `migrate_plus` contrib module into `modules/contrib/migrate_plus` (see [instructions](https://www.drupal.org/project/migrate_plus/git-instructions)).
5. Enable `migrate_source_example` module (`drush en migrate_source_example`).

### Installation of CSV migration example module
1. Download `migrate_source_csv` contrib module into `modules/contrib/migrate_source_csv` (see [instructions](https://www.drupal.org/project/migrate_source_csv/git-instructions)).
1. Enable `migrate_source_example_csv` module (`drush en migrate_source_example_csv`).
  
## Usage

1. Run `drush ms` to see all migrations.
2. Run `drush mi --group=[GROUP]` to import content from specific example group.

## Data source

CSV file content is synced from a [Google Spreadsheet](https://goo.gl/Iq2Tk6).
