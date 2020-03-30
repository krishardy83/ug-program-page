<?php #session_start();

/**********************************************************************
 *  Author: Jonathan Wheat (jonathan.p.wheat@gmail.com)
 *  Web...: http://twitter.com/jonathanpwheat
 *  Name..: Messiah College Academic Listing
 *  Desc..: Core Application Startup File
 */

/**********************************************************************
 *   Set up Constants
 */
define('APP_NAME', 'Messiah College - UnderGrad Program Pages');
define('APP_OWNER', 'Messiah College');
define('APP_AUTHOR', 'Jonathan P. Wheat');
define('APP_VERSION', '1.00');
define('APP_COPYRIGHT', '&copy; ' . date('Y'));

define('SYSTEM_EMAIL', 'jwheat@messiah.edu');

/**********************************************************************
 *   Determine which instance we're working with - DEV / PROD and set the DOCROOT
 */
define('CUSTOM_APP_ROOT', '/var/www/jadu/public_html/a');
define('CUSTOM_WEB_ROOT', '/a');

define('MC_APPLICATION_ROOT', 'ugrad-program-pages');

define('DOCROOT', '/var/www/jadu/public_html/a/' . MC_APPLICATION_ROOT);
define('WEBROOT', '/a/' . MC_APPLICATION_ROOT);

$hero_image = "placeholder_pixel.png";

function get_entryid_by_slug($url_slug)
{
    global $db;

    $query = "select v.entryID
                from JaduDirectoryFields f
                
                join JaduDirectoryEntryValues v
                on v.fieldID = f.id
                where f.directoryID = 1
                and f.title = 'URL slug'
                and v.value = '" . $url_slug . "'";

    $result = $db->Execute($query);

    $rowcount = $db->Affected_Rows($result);

    if ($rowcount > 0) {
        $row = $result->fields;
        return $row['entryID'];
    } else {
        return "";
    }

}