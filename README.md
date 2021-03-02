# mjwcividbtools

This is a really dangerous (destructive) extension, useful for development / initial deployment.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v7.x
* CiviCRM 5.13+

## Installation

If you are going to use this extension you should really know a lot more than how to install CiviCRM extensions.

## Usage

Navigate to:
* civicrm/admin/db/cleardata - to show a form that allows deleting ALL CiviCRM data

## Example

1. Create a staging copy of the live database. Then on staging DB:
2. Delete log tables (if not required).
3. Delete config tables:
   On cleardata form click "Get list of tables to clear" to download a CSV of all tables that will be cleared.
Insert that in the `table1,table2` below:
```sql
SELECT CONCAT( 'DROP TABLE ', GROUP_CONCAT(table_name) , ';' )
AS statement FROM information_schema.tables
WHERE table_schema = 'civi_db' AND table_name NOT IN (table1,table2);
```

4. Then using (eg. dbeaver) do a DB export (without CREATE/DROP/DEFINER).
5. Now run the "Clear data from tables" on the new DB.
6. Now do a DB restore to the new DB.
7. Clear `civicrm_uf_match` and run "Synchronise users to contacts"

All done!
