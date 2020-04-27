<?php
    /*
     * This is the cache job that creates a .json file when it is run.
     * This is setup for On Demand, since the data doesnt' change that often
     */

    // I use a variation of this bootstrap file in all of my applications.  It lets me setup some important variables
    // for this particuar page we use the CUSTOM_APP_ROOT variable in the $cachefile setting
    require_once "bootstrap.php";

    // Set the URL of the API url
    $remotepath = "https://www.messiah.edu/a/api/ugRelatedProgramsJSONP.php?directoryID=1&live_only=Y&apiKey=a38737a6a302f5f0390169114b6640a6&categoryID=-1";

    // Create the cache filename
    // Full URL will become: https://www.messiah.edu/a/cache/ug-related-programs.json
    $cachefile = CUSTOM_APP_ROOT . "/cache/ug-related-programs.json";

    // This is the best way to use the PHP call file_get_contents
    // Set the options for the call - faking a user agent
    $options = array(
        'method' => "GET",
        'header' => "Accept-language: en\r\n" .
            "User-Agent: Mozilla/5.0 (Windows; U; MSIE 7.0; Windows NT 6.0; en-US)\r\n"
    );

    // This creats a stream context for the get using the options
    $context = stream_context_create(array('http' => $options));

    // This assembles the stream context with the url
    $contents = file_get_contents($remotepath, false, $context);

    // This takes the contents of the remote call, whatever that happens to be (json in our case) and saves it in our cache file
    file_put_contents($cachefile, $contents, LOCK_EX);

    // This is mostly just a status message with a link to the file it (re)generated so you can click and view it
    // since it is _just_ a status message, I don't care about proper HMTL formatting.  You could spruce this up and make it
    // a nice looking status page with some design, but I didn't bother.
    print $cachefile . " file updated.<br/>";
    print "<a href='" . str_replace('/var/www/jadu/public_html', '', $cachefile) . "' target='_blank'>" . str_replace('/var/www/jadu/public_html', '', $cachefile) . "</a>";
    print "<br/>";

