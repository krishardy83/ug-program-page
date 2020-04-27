<?php
/*
 * JSON API for related programs using the Academic Programs Jadu Directory
 *
 * JSON fields in response:
 *   Course number
 *   Course name
 *   QuEST Curriculum
 *   Course description
 *   Professor
 *   Credits
 *   Pre-requisites
 *   Dual enroll
 *   Summer term
 *   ADP-GE
 *
 * The following block loads all of the libraries to get the
 * Jadu environment setup for directory usage
 **
 */
    include_once('API/Resource/Abstract.php');
    include_once('JaduCategories.php');
    include_once('directoryBuilder/JaduDirectories.php');
    include_once('directoryBuilder/JaduDirectoryEntries.php');
    include_once('directoryBuilder/JaduDirectoryEntryValues.php');
    include_once('directoryBuilder/JaduDirectoryFields.php');
    include_once('directoryBuilder/JaduDirectoryFieldTypes.php');
    include_once('utilities/JaduGoogleMaps.php');
    include_once("JaduMetadata.php");
    require_once('directoryBuilder/JaduDirectories.php');
    require_once('directoryBuilder/JaduDirectoryCategoryTree.php');
    require_once('directoryBuilder/JaduDirectoryCategoryInformation.php');
    require_once('directoryBuilder/JaduDirectoryEntries.php');
    require_once('directoryBuilder/JaduDirectoryCategoryAdverts.php');
    require_once('directoryBuilder/JaduDirectoryFields.php');
    require_once('directoryBuilder/JaduDirectoryEntryValues.php');
    require_once('directoryBuilder/JaduDirectoryFieldTypes.php');
    require_once('directoryBuilder/JaduDirectorySettings.php');
    require_once('directoryBuilder/JaduDirectoryCategoryFields.php');
    require_once('directoryBuilder/JaduDirectoryFieldDefaultValues.php');
    require_once('directoryBuilder/JaduDirectoryUserEntries.php');
    require_once('directoryBuilder/JaduDirectoryUserEntryValues.php');

    // Messiah College custom library to deal with catetories
    require "custom/academics/class.MessiahDirectoryCategoryHelper.php";
    $directoryhelper = new MessiahDirectoryCategoryHelper;

    // Obtain querystring parameters if they exist.
    // Hint - they ALL have to or else it is an invalid call
    $categoryID = $_GET['categoryID'];
    $directoryID = $_GET['directoryID'];
    $apiKey = $_GET['apiKey'];

    if (empty($categoryID) || empty($directoryID) || empty($apiKey)) {
        print "invalid call";
        exit();
    }

	// Make sure the API key matches this hard coded value (lame, but it works)
	if ($apiKey != "a38737a6a302f5f0390169114b6640a6") {
		print "invalid api key";
		exit();
	}

	$offset = 0; 	// set default offset to beginning of the list
	$return_max = 100;	// set max returned items

	if (isset($_GET['offset'])) {
		$offset = $_GET['offset'];
	}

	if (isset($_GET['return'])) {
		$return_max = $_GET['return'];
	} else {
		$return_max = 5000;
	}

	// All the fields we want to return in this API
	$fields = array("Course number","Course name","QuEST Curriculum","Course description","Professor","Credits","Pre-requisites","Dual enroll","ADP","Summer term");

	$prefix = "";
	$sufffix = "";

    $prefix = "
{
   \"items\": ";
			$suffix = "
}";

	// Default to live_only = false unless speficied in the url
    $live_only = false;
	if (isset($_GET['live_only']) && $_GET['live_only'] == 'Y') {
        $live_only = true;
    }

    // Jadu library call getAllDirectoryEntriesUnderCategory
	// Get all directory records for this directory and category and live only flag
	$short_entries = getAllDirectoryEntriesUnderCategory ($directoryID, $categoryID, '', $live_only);

	// Get the field list for the directory (we'll manipulate this list shortly to limit the fields)
	$field_list = getAllDirectoryFields($directoryID, false);

	// Set some default arrays
	$field_array = array();
	$new_array = array();

	// Initialize some variables we'll need in a bit
	$return_set_counter = 0;	                    // keep track of how many items we've added to the array
	$local_counter = 0; 		                    // keep track of the number of times we've looped through the items
	$number_of_records = count($short_entries);     // need to know how many results we have for looping below

	/*
	 * This section needs some explaining and it has to do with how Jadu handles directories
	 * in the database.  There is limited information for each entry in a table, and this allows
	 * you to view a quick list.  If you want all the custom fields that have been configured
	 * you then need to take each entryID and make a call to get all the additional data. It is
	 * convoluted and basically a crap way to do it, but it is what it is.
	 *
	 * We'll check the offset parameter coming in (this allows you to paginate if needed.
	 * If the offset is less than the number or records, we're good and can start a loop
	 *
	 * Then we'll loop through the results from above, and grab the rest of the directory data
	 */
    if ($offset < $number_of_records) {
        // loop through all the short entries in the directory
        foreach ($short_entries as $short_entry) {
            // grab the entryID and entryTitle from the default fields in the short entry
            $major_name = "";
            $entryID = $short_entry->id;
            $entryTitle = $short_entry->title;
            $live = $short_entry->live;

            // this if statement limits the number of records we're returning and skips records if we've grown too large
            if ($local_counter >= $offset && $return_set_counter < $return_max) {
                $field_array[$entryID]['entry_id'] = $entryID;
                $field_array[$entryID]['entry_title'] = $entryTitle;
                $field_array[$entryID]['live'] = $live;

                $return_set_counter++;	// keep track of how many records we've added to the array
                $add_this = true;
            } else {
                $add_this = false;
            }

            // Obtain the entry category(ies) assigned to the short entry, this is an array of category information
            // (more than you'd ever want to know about a category)
            $entry_categories = getCategoriesAssignedToEntry($entryID, 'DIRECTORY');

            #$field_array[$entryID]['category_name'] = "";
            $entry_category_id = "";

            // if we have a category, get the specific category id
            if (!empty($entry_categories)) {
                // flatten the array into a comma separated string
                $entry_category_id = implode(",", $entry_categories);

                // obtain the category name for this directory entry
                $category_name = $directoryhelper->get_directory_category_name ($directoryID, $entry_category_id);

                if (!empty($category_name)) {
                    foreach ($category_name as $cat) {
                        $major_name = $cat['title'];
                        #$field_array[$entryID]['category_name'] = $cat['title'];
                    }
                }
            }

            // If we're inside the max return bounds (remember the $add_this flag above) we'll add some information
            // to the $field_array array
            if ($add_this) {
                $field_array[$entryID]['category_name'] = $major_name;
                $field_array[$entryID]['category_id'] = $entry_category_id;
            }

            // Here we loop through all the fields in this directory and get the value for the entryID for each field
            // This is terribly inefficient, but since it is batched, it doesn't matter.
            foreach ($field_list as $field) {
                if (in_array($field->title, $fields)) {

                    // grab the field if and field title which will be used in the array after its processed
                    $fieldID = $field->id;
                    $fieldTitle = $field->title;

                    // Each item has meta data, we'll get that as well (not sure we really need this)
                    $field_metadata = getMetadataForItem('JaduDirectoryEntryMetadata', $entryID);

                    // get the entry value for this field
                    $EntryValue = getDirectoryEntryValue($entryID, $fieldID);

                    // get the actual value from the returned array above
                    $fieldValue = $EntryValue->value;

                    // remove extra line returns from the value if text or html
                    $fieldValue = str_replace("\r\n", "<br/>", $fieldValue);

                    // IMPORTANT NOTE:
                    // The JSON format uses a key / value pair, and there is no good method to get a key from a Jadu directory or entry
                    // I built the following method that is FAR from ideal, because if/when the field name changes in Jadu
                    // For example:  Lets use the field "Program peek" in the directory.  Currently with my code below, that will produce
                    // a json key of "program-peek" which works well.  If Kris decides to change that field to "Program peek text" the new
                    // json key will now be named "program-peek-text" which will then break any code that was previously using "program-peek"
                    // I experimented with other types of keys (hashed value for the field ID, and other combinations) to keep them from changing
                    // but it becomes cumbersom when you need to develop using the json response, you have no idea what is what
                    //
                    // All that said, the following will take the field name and create a json compliant key name
                    $field_index = preg_replace('/[^A-Za-z0-9\_]/', '', strtolower(str_replace(" ", "_", $fieldTitle)));
                    $field_index = str_replace("__", "_", $field_index);
                    $field_index = trim($field_index, "_");

                    // If above we've decided to add this, we'll add it to our overall field array.
                    // this will be converted to json later.
                    // This could be refactored and potentially skip a lot of the looping by wrapping the code above in the true condition.
                    // I'll save that for later after I have it working.
                    if ($add_this) {
                        // Add the value and keywords to the array (again not sure we need keywords, but we'll keep 'em)
                        $field_array[$entryID][$field_index] = $fieldValue;
                        $field_array[$entryID]['keywords'] = $field_metadata->subject;
                    }
                }
            }
            // increase our loop counter
            $local_counter++;
        }
    }

//	$indexedOnly = array();
//
//	foreach ($field_array as $row) {
//	    $indexedOnly[] = array_values($field_array);
//	}


	print $prefix;
	echo json_encode(array_values($field_array));
	print $suffix;

	#$json_string = $prefix . json_encode(array_values($field_array)) . $suffix;

	#$json = json_decode($json_string);
	#echo json_encode($json, JSON_PRETTY_PRINT);

	function get_directory_category_name ($directory_id, $parent_id, $category_id) {
		global $db;

		$query = "select id,title,position,parentID
				from JaduDirectoryCategoryTree
				where directoryID = " . $directory_id . "
				and parentID = " . $parent_id . "
				and id = " . $category_id . "
				order by title";
#print $sql;
		$result = $db->Execute($query);

		return $result;
	}
