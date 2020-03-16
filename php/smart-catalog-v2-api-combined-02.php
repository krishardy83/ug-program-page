<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>

<script type="text/javascript">

// Create div to contain each course option
var j=0;
$('.tabcontent-col-panel').each(function(){
    j++;
    var newID='panelView'+j;
    $(this).attr('id',newID);
    $(this).val(j);
});

function disableScroll() {
    // Get the current page scroll position
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

        // if any scroll is attempted, set this to the previous value
        window.onscroll = function() {
            window.scrollTo(scrollLeft, scrollTop);
        };
}

function enableScroll() {
    window.onscroll = function() {};
}

function load(index){

  if(index == 1){
      console.log(index);
    $("#panelView1").html(html_data1);
  }

  else if(index == 2){
      console.log(index);
    $("#panelView1").html(html_data2);
  }

  else if(index == 3){
      console.log(index);
    $("#panelView1").html(html_data3);
  }
  else if(index == 4){
      console.log(index);
    $("#panelView1").html(html_data4);
  }

  else{
    // CONTENT ASSIGNED TO DYNAMIC DIVS
  var content = $("#panelView"+index).html();
  // DIVS PASSED ON TO MAIN DIV
  $("#panelView1").html(content);
}
}

(function(){
// Slide In Panel - by CodyHouse.co
var panelTriggers = document.getElementsByClassName('js-cd-panel-trigger');
if( panelTriggers.length > 0 ) {
for(var i = 0; i < panelTriggers.length; i++) {
  (function(i){

    var panelClass = 'js-cd-panel-'+panelTriggers[i].getAttribute('data-panel'),
      panel = document.getElementsByClassName(panelClass)[0];

    // open panel when clicking on trigger btn
    panelTriggers[i].addEventListener('click', function(event){
      // load(i);
      event.preventDefault();
      addClass(panel, 'cd-panel--is-visible');
      disableScroll();

    });
    //close panel when clicking on 'x' or outside the panel
    panel.addEventListener('click', function(event){
      if( hasClass(event.target, 'js-cd-close') || hasClass(event.target, panelClass)) {
        event.preventDefault();
        removeClass(panel, 'cd-panel--is-visible');
        enableScroll();
      }
    });
  })(i);
}
}


//class manipulations - needed if classList is not supported
//https://jaketrent.com/post/addremove-classes-raw-javascript/
function hasClass(el, className) {
  if (el.classList) return el.classList.contains(className);
  else return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
}
function addClass(el, className) {
if (el.classList) el.classList.add(className);
else if (!hasClass(el, className)) el.className += " " + className;
}
function removeClass(el, className) {
  if (el.classList) el.classList.remove(className);
  else if (hasClass(el, className)) {
    var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
    el.className=el.className.replace(reg, ' ');
  }
}
})();

</script>

<style media="screen">

.messiah-accordions{
	/* margin-top: 27px; */
}

.messiah-accordions .accordion{
	font-family: 'akagi-pro', sans-serif;
  font-weight: 300;
	font-size: 18px;
}

.messiah-accordions .accordion-2{
	font-size: 24px;
	font-family:'priori-sans', sans-serif;
	font-weight: 400;
}

.messiah-accordions .accordion,
.messiah-accordions .accordion-2 {
	position:relative;
	font-style: normal;
	background-color: transparent;
	border: 0;
	color: #273d5e;
	cursor: pointer;
	padding: 15px;
	width: 100%;
	border-top: 1px solid #e7e6e6;
	text-align: left;
	outline: none;
	transition: all .4s;
	-webkit-transition: all .4s;
	/* border-bottom: 1px solid #e7e6e6; */
}

.messiah-accordions .accordion-icon {
	width: 25px;
	display: inline-table;
	vertical-align: middle;
}

.messiah-accordions .accordion:hover,
.messiah-accordions .accordion-2:hover{
	color: #618aa9;
}

.separator{
	margin: 0;
	border-top: 1px solid #e7e6e6;
	border-bottom: 0;
}

.messiah-accordions .accordion:after {
    content: url("/a/ugrad-program-pages/iconmonstr-arrow-25-24.png");
	position: absolute;
    top: 50%;
    right: 15px;
    transform: translate(0, -50%);
    line-height: left;
    margin-top: 3px;
}

.messiah-accordions .accordion-2:after {
    content: url("/a/ugrad-program-pages/iconmonstr-arrow-25-24.png");
	position: absolute;
    right: 15px;
    top: 50%;
    transform: translate(0, -50%);
    margin-top: 3px;
}

.messiah-accordions .accordion-2 span {
    margin-left: 45px;
}

.messiah-accordions .accordion-2.acc-admissions:before,
.messiah-accordions .accordion-2.acc-dates:before,
.messiah-accordions .accordion-2.acc-apply:before,
.messiah-accordions .accordion-2.acc-resources:before{
	position: absolute;
}

.messiah-accordions .accordion-2.acc-admissions:before{
	content: url("/a/ugrad-program-pages/iconmonstr-arrow-25-24.png");
}

.messiah-accordions .accordion-2.acc-dates:before{
	content: url("/a/ugrad-program-pages/iconmonstr-arrow-25-24.png");
}

.messiah-accordions .accordion-2.acc-apply:before{
	content: url("/a/ugrad-program-pages/iconmonstr-arrow-25-24.png");
}

.messiah-accordions .accordion-2.acc-resources:before{
	content: url("/a/ugrad-program-pages/iconmonstr-arrow-25-24.png");
}

.messiah-accordions button.accordion.active:after {
    content: url("/a/ugrad-program-pages/iconmonstr-arrow-25-24.png");
}

.messiah-accordions button.accordion-2.active:after {
    content: url("/a/ugrad-program-pages/iconmonstr-arrow-25-24.png");
}

</style>

<?php
// Different Cases for api calls
// Case 1: catalog->Degree->Requirements_List->Courses_List->Courses
// Case 2: catalog->Requirements_List->Courses_List->Courses
// Case 3: catalog->Certificate->Degree_Requirements->Requirements_List->Course_List->Courses
// Case 4: catalog->Degree_Requirements->Requirements_List->Course_List->Courses

$has_concentrations = false;

$smart_catalog_degree_id = $_GET['guid'];
$smart_catalog_degree_id = preg_replace('/\.$/', '', $smart_catalog_degree_id); //Remove dot at end if exists
$guid = explode('|', $smart_catalog_degree_id); //split string into array seperated by '| '

$i = 0;

foreach($guid as $all_key=>$value):
  $i++;
  $result = get_program_details($value, 'array');
  $course_name = $result->catalog->Degree->title;
  $minor_name = $result->catalog->Minor->title;
  $requirements = $result->catalog->Requirements_List;
  $courses_list = $requirements->Course_List->course;
  if(!empty($smart_catalog_degree_id)){
  ?>


  <div  class='widget widget__grad-pages-accordion'>
      <div class='messiah-accordions'>
            <?php if (empty($course_name)){?>
            <button class='accordion acc' onclick='load(<?php print $i;?>)' id='<?php print $value;?>'> <span class='btn-text'><a style="display:block; outline:none" data-index='<?php print $i?>' class='cd-btn js-cd-panel-trigger' data-panel='main'> <?php print $minor_name;?> </a></span></button>
          <?php } else { ?>
            <button class='accordion acc' onclick='load(<?php print $i;?>)' id='<?php print $value;?>'> <span class='btn-text'><a style="display:block; outline:none" data-index='<?php print $i?>' class='cd-btn js-cd-panel-trigger' data-panel='main'> <?php print $course_name;?> </a></span></button>
            <?php
          } ?>
      </div>
    </div>
        <div class="cd-panel cd-panel--from-right js-cd-panel-main">
          <header class="cd-panel__header">
            <a href="#<?php print $i?>" class="cd-panel__close js-cd-close">Close</a>
          </header>
          <div class="cd-panel__container">
            <div class="cd-panel__content">
              <!-- CONTENT FROM BANNER WILL GO HERE -->
              <div class="tabcontent-col-panel" id="panelView">
                      <!-- [Dynamic Content Here] -->
              </div>
             <!-- cd-panel__content -->
           <!-- cd-panel__container -->
        </div>
      </div>
  </div>
<?php
}
endforeach;


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
    // print $content;
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
    // print "<h3>" . $requirement->title . "</h3>";
    // print $requirement->content;

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
    // print "<h4>" . $requirements_list->title . "</h4>";

    $req_narrative  = $requirements_list->req_narrative;
    $req_note = $requirements_list->req_note;

    if (!empty($req_narrative)) {
        // print $req_narrative;
    }

    if (!empty($req_note)) {
        // print $req_note;
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
        // print $req_narrative;
    }

    if (!empty($req_note)) {
        // print $req_note;
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
            $c = $course;
            $course = new StdClass();
            $course->name = $c->name;
            #$course_data->description = "No course description has been provided";
            $course->subject_code = $c->number;
        }
        ?>


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

?>
