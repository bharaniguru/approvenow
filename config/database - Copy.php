<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'spine';
$active_record = TRUE;
$tnsname = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.6.3)(PORT = 1521))
        (CONNECT_DATA = (SERVER = DEDICATED) (SID = spine)))';
  //$pooled = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.6.3)(PORT = 1521))
  //      (CONNECT_DATA = (SERVER = DEDICATED) (SID = spine) (SERVER=POOLED)))';     
$db['spine']['hostname'] = $tnsname;
$db['spine']['username'] = 'spine';
$db['spine']['password'] = 'spine';
$db['spine']['database'] = 'spineDB';
$db['spine']['dbdriver'] = 'oci8';
//$db['default']['pooled']=$pooled;
//$db['default']['dsn']=$pooled.
//'://' . $db['default']['username'] .
//':' . $db['default']['password'].
//'@' . $db['default']['hostname'] .
//'/' . $db['default']['database'];
$db['spine']['dbprefix'] = '';
$db['spine']['pconnect'] = TRUE;
$db['spine']['db_debug'] = TRUE;
$db['spine']['cache_on'] = FALSE;
$db['spine']['cachedir'] = '';
$db['spine']['char_set'] = 'utf8';
$db['spine']['dbcollat'] = 'utf8_general_ci';
$db['spine']['swap_pre'] = '';
$db['spine']['autoinit'] = TRUE;
$db['spine']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */