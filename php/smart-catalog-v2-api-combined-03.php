<style media="screen">

details {
width: 100%;
min-height: 5px;
max-width: 700px;
padding: 15px 10px 15px 10px;
margin: 3 auto;
color: #273d5e;
position: relative;
font-size: 16px;
font-family: 'akagi-pro', sans-serif;
border-top: 1px solid rgba(0,0,0,.1);
border-bottom: 1px solid rgba(0,0,0,.1);
box-sizing: border-box;
transition: all .3s;
}

details + details {
margin-top: 20px;
}

details[open] {
  font-family: 'akagi-pro', sans-serif;
  font-size: 22px;
  min-height: 50px;
  background-color: #f6f7f8;
  /* box-shadow: 2px 2px 20px rgba(0,0,0,.2); */
}

details p {
color: #96999d;
}

summary {
display: flex;
justify-content: space-between;
cursor: pointer;
}

summary:focus {
outline: none;
}

summary::-webkit-details-marker {
display: none
}

.control-icon {
transition: .3s ease;
pointer-events: none;
}

.control-icon-close {
display: none;
}

details[open] .control-icon-close {
display: initial;
transition: .3s ease;
}

details[open] .control-icon-expand {
display: none;
}

details[open] summary:hover::after {
animation: pulse 1s ease;
}

@keyframes pulse {
25% {
  transform: scale(1.1);
}
50% {
  transform: scale(1);
}
75% {
  transform: scale(1.1);
}
100% {
  transform: scale(1);
}
}
</style>

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
if (isset($program_data->catalog->Minor)) {
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
    $minor = $program_data->catalog->Minor;
    $program_title = $degree->title;
    $minor_title = $minor->title;
    $content = $degree->content;
    $minor_content = $minor->content;
    $requirements = $degree->Degree_Requirements;
    $minor_requirements = $minor->Degree_Requirements;
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
    // WHOLE RESULT FROM SMART CATALOG
    if(empty($degree)){
      print "<div style='padding-bottom:120px;margin-bottom:120px'>";
      print "<h2 class='tab-heading'>" . $minor_title . "</h2>";
      print $minor_content;
      display_degree_requirements($minor_requirements);
      print "</div>";

    } else {
    print "<div style='padding-bottom:120px;margin-bottom:120px'>";
    print "<h2 class='tab-heading'>" . $program_title . "</h2>";
    print $content;
    display_degree_requirements($requirements);
    print "</div>";

  }
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
            print "<div style='padding-bottom:20px';margin-bottom:20px>";
            process_requirement($requirement);
            print "</div>";
        }
    } else {
        process_requirement($requirements);
    }
}

function process_requirement($requirement) {
    print "<h3>" . $requirement->title . "</h3>";
    print $requirement->content;

    #dd($requirement->Requirements_List);
    if (isset($requirement->Requirements_List)) {
        $requirements_list = $requirement->Requirements_List;

        #print count($requirements_list);
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

    if (isset($requirements_list->Course_List)) {

        $courses = $requirements_list->Course_List->course;
        display_courses($courses);

    }

    // check for nested Requirements_List
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
    }  //else {
//        $courses = $requirements_list->Course_List->course;
//        display_courses($courses);
//    }
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
            $course_data = get_course_details($course->guid);
        } else {
            // for non-Messiah courses we host for some reason
            $c = $course;
            $course = new StdClass();
            $course->name = $c->name;
            #$course_data->description = "No course description has been provided";
            $course->subject_code = $c->number;
        }
        ?>

<?php  if(!empty($course->subject_code) && !empty($course->name) ) { ?>

        <div style="visibility: hidden; position: absolute; width: 0px; height: 0px;">
  <svg xmlns="http://www.w3.org/2000/svg">
    <symbol viewBox="0 0 24 24" id="expand-more">
      <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/><path d="M0 0h24v24H0z" fill="none"/>
    </symbol>
    <symbol viewBox="0 0 24 24" id="close">
      <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/>
    </symbol>
  </svg>
</div>


<details>
  <summary>
    <?php print $course->name;?>
    <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
    <svg class="control-icon control-icon-close" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
  </summary>
</br>
  <p><?php print $course_data->description;?></p>
  <p><?php print $course->subject_code;?> <?php print $course->number;?> / <?php print $course->credits;?> Credits</p>

</details>
<?php } ?>


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
