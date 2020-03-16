<?php
// Different Cases for api calls
// Case 1: catalog->Degree->Requirements_List->Courses_List->Courses
// Case 2: catalog->Requirements_List->Courses_List->Courses
// Case 3: catalog->Certificate->Degree_Requirements->Requirements_List->Course_List->Courses
// Case 4: catalog->Degree_Requirements->Requirements_List->Course_List->Courses

$has_concentrations = false;

$guid = $_GET['guid'];

if (isset($_GET['concentrationguid'])) {
    $concentrationguid = $_GET['concentrationguid'];
    $has_concentrations = true;
    $case = 2;
}

if ($case == 2) {
    // Concentration Requirements
    $concentration_data = get_program_details($concentrationguid, 'array');
    main($concentration_data);
}

// Run for all Cases (gets main guid data, which could represent Core Courses (Case 2) or Degree ID (Case 1)
$program_data = get_program_details($guid, 'array');


// Determine if this is Case 1 or 3
if (isset($program_data->catalog->Degree)) {
    $case = 1;
}

if (isset($program_data->catalog->Certificate)) {
    $case = 3;
}

if (isset($program_data->catalog->Degree_Requirements)) {
    $case = 4;
    $requirements = $program_data->catalog->Degree_Requirements;
}


if ($case == 1) {
    $degree = $program_data->catalog->Degree;
    $program_title = $degree->title;
    $content = $degree->content;
    $requirements = $degree->Degree_Requirements;
}

if ($case == 2) {
    main($program_data);
}

if ($case == 3) {
    $certificate = $program_data->catalog->Certificate;
    $program_title = $certificate->title;
    $content = $certificate->content;
    $requirements = $certificate->Degree_Requirements;
}

if ($case == 1 || $case == 3 || $case == 4) {
    // Render content
    print "<h2 class='tab-heading'>" . $program_title . "</h2>";
    print $content;

    display_degree_requirements($requirements);
}


// Functions

function main($program_data)
{
    $requirements_list = $program_data->catalog->Requirements_List;
    //dd($requirements_list);
    display_requirements($requirements_list);
}


function get_program_details($guid, $return_type)
{
    include_once 'custom/class.JaduHTTPRequest.php';
    $param_url = "https://iq3prod1.smartcatalogiq.com/apis/CustomCatalogAPI?iqguid=" . $guid . "&format=json";
    $r = new JaduHTTPRequest($param_url);
    $program_data_json = $r->DownloadToString();

    if ($return_type == "array") {
        $program_data = json_decode($program_data_json);
        return $program_data;
    } else {
        return $program_data_json;
    }
}

function display_degree_requirements($requirements)
{
    if (count($requirements) > 1) {
        foreach ($requirements as $requirement) {
            process_requirement($requirement);
        }
    } else {
        process_requirement($requirements);
    }
}

function process_requirement($requirement) {
    print "<h3>" . $requirement->title . "</h3>";

    print $requirement->content;

    if (isset($requirement->Requirements_List)) {
        $requirements_list = $requirement->Requirements_List;

        if (count($requirements_list) > 1) {
            foreach ($requirements_list as $requirement_list_item) {
                process_requirements_list($requirement_list_item);
            }
        } else {
            process_requirements_list($requirements_list);
        }
    }
}

function process_requirements_list ($requirements_list) {
    print "<h4>" . $requirements_list->title . "</h4>";

    $req_narrative  = $requirements_list->req_narrative;
    $req_note = $requirements_list->req_note;

    if (!empty($req_narrative)) {
        print $req_narrative;
    }

    if (!empty($req_note)) {
        print $req_note;
    }

    // check for nested Requirements_List
    if (isset($requirements_list->Requirements_List)) {
        // deal with nested list
        $nested_requirement_list = $requirements_list->Requirements_List;

        if (count($nested_requirement_list > 1)) {
            foreach ($nested_requirement_list as $nested_requirement_list_item) {
                process_requirements_list($nested_requirement_list_item);
            }
        } else {
            process_requirements_list($nested_requirement_list);
        }
    } else {
        $courses = $requirements_list->Course_List->course;
        display_courses($courses);
    }
}

function display_requirements($requirements_list)
{
    $program_title = $requirements_list->title;
    $req_narrative  = $requirements_list->req_narrative;
    $req_note = $requirements_list->req_note;

    // Render content
    print "<h2 class='tab-heading'>" . $program_title . "</h2>";
    if (!empty($req_narrative)) {
        print $req_narrative;
    }

    if (!empty($req_note)) {
        print $req_note;
    }

    // display courses for this Requirements_List before checking for nested list(s)
    $courses = $requirements_list->Course_List->course;
    display_courses($courses);

    if (isset($requirements_list->Requirements_List)) {
        // deal with nested list
        $nested_requirement_list = $requirements_list->Requirements_List;

        if (count($nested_requirement_list) > 1) {
            foreach ($nested_requirement_list as $nested_requirement_list_item) {
                process_requirements_list($nested_requirement_list_item);
            }
        } else {
            process_requirements_list($nested_requirement_list);
        }
    } else {
        // These are displayed above.
        //        //dd($requirements_list);
        //        $courses = $requirements_list->Course_List->course;
        //        display_courses($courses);
    }

}

function display_courses($courses)
{
    foreach ($courses as $course) {
        $guid = str_replace("{", "", $course->guid);
        $guid = str_replace("}", "", $guid);

        if (!empty($course->subject_name . $course->subject_code)) {
            #$course_data = get_course_details($course->guid);
        } else {
            // for non-Messiah courses we host for some reason
            $course = new StdClass();
            $course->name = $course->name;
            #$course_data->description = "No course description has been provided";
            $course->subject_code = $course->number;
        }
        ?>
        <div class='widget widget__grad-pages-accordion'>
            <div class='messiah-accordion'>
                <button class='accordion acc expand' id="<?php print $guid;?>"><span class='btn-text'><?php print $course->name;?></span></button>
                <div class='panel'>
                    <p><div id="course-<?php print $guid;?>"></div></p>
                    <p><?php print $course->subject_code;?> <?php print $course->number;?> / <?php print $course->credits;?> Credits</p>
                </div>
            </div>
        </div>

        <?php
    }
}


function xdisplay_courses($courses)
{
    foreach ($courses as $course) {
        if (!empty($course->subject_name . $course->subject_code)) {
            $course_data = get_course_details($course->guid);
        } else {
            // for non-Messiah courses we host for some reason
            $course_data = new StdClass();
            $course_data->name = $course->name;
            $course_data->description = "No course description has been provided";
            $course_data->subject_code = $course->number;
        }
        ?>
        <div class='widget widget__grad-pages-accordion'>
            <div class='messiah-accordion'>
                <button class='accordion acc'><span class='btn-text'><?php print $course_data->name;?></span></button>
                <div class='panel'>
                    <p><?php print $course_data->description;?></p>
                    <p><?php print $course->subject_code;?> <?php print $course->number;?> / <?php print $course->credits;?> Credits</p>
                </div>
            </div>
        </div>

    <?php
    }
}


function get_course_details($course_id)
{
    include_once 'custom/class.JaduHTTPRequest.php';
    $param_url = "https://iq3prod1.smartcatalogiq.com/APIs/courseAPI?iqguid=" . $course_id . "&format=json";
    $r = new JaduHTTPRequest($param_url);
    $course_data_json = $r->DownloadToString();
    $course_data = json_decode($course_data_json);

    return $course_data->courses->course;
}

function dd($var) {
    print "<pre>";
    print_r($var);
    print "</pre>";
    exit();
}
