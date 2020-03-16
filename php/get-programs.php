<?php


$nocrypt = "Y";
require_once "bootstrap.php";

// load file
$course_data_json = $contents = file_get_contents('/var/www/jadu/public_html/a/cache/ug-related-programs.json', false);
$course_data = json_decode($course_data_json);

// spin through and build a unique list from
// ->subject_code
// ->subject_name
$programs = array();
$previous_course_code = "";

//TODO:
// spin through building an array to spit out to the screen to choose what programs
foreach ($course_data->items as $program) {
    $program_path = $program->category_id;
    $program_title = $program->entry_title;

    if ($previous_course_code != $program_path) {
        array_push($programs, $program_path);
    }

    $previous_course_code = $program_path;
}

// HIDE MINORS

// foreach($programs as $key => $one) {
//     if(strpos($one, 'Minor') !== false)
//         unset($programs[$key]);
// }

// sort($programs);
print json_encode($programs);
