<?php

// ALUMNI OUTCOMES Widget
$param_text = "% of the Class of 2018 respondents were employed or in graduate school within 6-9 months of graduation.";
$param_percentage = 100;
$folder = '/site/custom_scripts/styles/';
$version = 13;

# if (!class_exists('MessiahDirectoryCategoryHelper')) {
   require_once "custom/academics/class.MessiahDirectoryCategoryHelper.php";
# }

$directoryhelper = new MessiahDirectoryCategoryHelper;
define('WEBROOT', '/a/academics/listing');

$major_html = "";
$param_department = "";

$api_key = "a38737a6a302f5f0390169114b6640a6";
$directory_id = 1;

if ($param_department == '%' . 'PARAM_DEPARTMENT%' || $param_department == '') {
   $param_department = '%PARAM_DEPARTMENT%';
   $param_previous = $param_department;
}
if ($param_hidefilter == '%' . 'PARAM_HIDEFILTER%' || $param_hidefilter == '') {
   $param_hidefilter = '%PARAM_HIDEFILTER%';
}


$filtered_id = "";

if (isset($_GET['s'])) {
   $params = $_GET['s'];
   $param_array = explode(":", $params);
   if ($param_array[0] != "") {
       $param_department = $param_array[1];
       $param_previous = $param_array[1];
       $filtered_id = $param_array[0];

       $major_html = "<option value=''>Remove Filter</option>";
   }
}


$directory_api_url = "http://www.messiah.edu/site/custom_scripts/api/directoriesByCategory.php?directoryID=".$directory_id."&categoryID=" . $param_department;

$options = array(
 'http'=>array(
   'method'=>"GET",
   'header'=>"Accept-language: en\r\n" .
             "Cookie: foo=bar\r\n" .  // check function.stream-context-create on php.net
             "User-Agent: JaduWidget/1.0"
 )
);

$context = stream_context_create($options);
$json = file_get_contents($directory_api_url, false, $context);
$array = json_decode($json,TRUE);

$a_program = array();
$a_work = array();
$a_do = array();
$a_study = array();


       // $record_id = $major['entry_id'];
       $alumni_title = $program_name;
       $alumni_program_name = $program_name;
       $alumni_work = $where_they_work_separate__with_a_comma;
       $alumni_do = $what_they_do_separate__with_a_comma;
       $alumni_study = $where_they_study_separate__with_a_comma;

       if ( !empty($alumni_work) || !empty($alumni_do) || !empty($alumni_study) ) {
           if (!empty($alumni_program_name)) {
               $p_name = trim($alumni_program_name);
               $p_id = $record_id;

               $tmp_arr = array();
               array_push($tmp_arr, $p_id);
               array_push($tmp_arr, $p_name);
               array_push($a_program, $tmp_arr);
           }
       }

       if ($filtered_id == "") {
               $current_filter = "all majors";
               if (!empty($alumni_work)) {
                   #check for comma
                   if (strpos($alumni_work, ",")) {
                       $tmp_work = explode(",",$alumni_work);
                       foreach ($tmp_work as $t) {
                           if (!empty($t)) {
                               array_push($a_work, trim($t));
                           }
                       }
                   } else {
                       array_push($a_work,$alumni_work);
                   }
               }

               if (!empty($alumni_do)) {
                   if (strpos($alumni_do, ",") === FALSE) {
                       array_push($a_do,$alumni_do);
                   } else {
                       $tmp_do = explode(",",$alumni_do);
                       foreach ($tmp_do as $t) {
                           if (!empty($t)) {
                               array_push($a_do, trim($t));
                           }
                       }
                   }
               }

               if (!empty($alumni_study)) {
                   if (strpos($alumni_study, ",") === FALSE) {
                       array_push($a_study,$alumni_study);
                   } else {
                       $tmp_study = explode(",",$alumni_study);
                       foreach ($tmp_study as $t) {
                           if (!empty($t)) {
                               array_push($a_study, trim($t));
                           }
                       }
                   }
               }

       } else {
           if ($record_id == $filtered_id) {
               $current_filter = $alumni_program_name;
               if (!empty($alumni_work)) {
                   #check for comma
                   if (strpos($alumni_work, ",")) {
                       $tmp_work = explode(",",$alumni_work);
                       foreach ($tmp_work as $t) {
                           if (!empty($t)) {
                               array_push($a_work, trim($t));
                           }
                       }
                   } else {
                       array_push($a_work,$alumni_work);
                   }
               }

               if (!empty($alumni_do)) {
                   if (strpos($alumni_do, ",") === FALSE) {
                       array_push($a_do,$alumni_do);
                   } else {
                       $tmp_do = explode(",",$alumni_do);
                       foreach ($tmp_do as $t) {
                           if (!empty($t)) {
                               array_push($a_do, trim($t));
                           }
                       }
                   }
               }

               if (!empty($alumni_study)) {
                   if (strpos($alumni_study, ",") === FALSE) {
                       array_push($a_study,$alumni_study);
                   } else {
                       $tmp_study = explode(",",$alumni_study);
                       foreach ($tmp_study as $t) {
                           if (!empty($t)) {
                               array_push($a_study, trim($t));
                           }
                       }
                   }
               }
           }
       }


$work_array = array_unique($a_work);
$do_array = array_unique($a_do);
$study_array = array_unique($a_study);

sort($work_array);
sort($do_array);
sort($study_array);
?>

<script src='/site/javascript/addclass.js'></script>
<script src='/site/javascript/chart.js'></script>

<style media="screen">

.cd-nugget-info {
  display: block;
  font-family: "Droid Serif", serif;
  color: #fff;
  margin: 20px auto 0;
  font-size: 1.2rem;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  width: 120px;
  position: relative;
}
.cd-nugget-info::after {
  content: '';
  position: absolute;
  display: inline-block;
  top: 16px;
  left: 50%;
  -webkit-transform: translateX(-50%);
  -moz-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -o-transform: translateX(-50%);
  transform: translateX(-50%);
  height: 1px;
  width: 0%;
  background-color: white;
  -webkit-transition: all 0.2s;
  -moz-transition: all 0.2s;
  transition: all 0.2s;
}
.cd-nugget-info:hover::after {
  width: 100%;
}

/* --------------------------------
Slide In Panel - by CodyHouse.co
-------------------------------- */
.cd-main-content {
  /* text-align: center; */
}

.cd-main-content h1 {
  font-size: 2rem;
  color: #64788c;
  padding: 4em 0;
}

.cd-btn {
  color: #273d5e;
  font-family: 'akagi-pro', sans-serif;
  font-size: 18px;
  padding: 2px;

}

.cd-btn:hover {
  color: #618aa9;
	text-decoration: none;
}

@media only screen and (min-width: 1170px) {
  .cd-main-content h1 {
    font-size: 3.2rem;
  }
}

.cd-panel {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  z-index:99;
  visibility: hidden;
  -webkit-transition: visibility 0s 0.6s;
  transition: visibility 0s 0.6s;
  padding-bottom: 30px;
  margin-bottom: 30px;
}

.cd-panel::after {
  /* overlay layer */
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: transparent;
  cursor: pointer;
  -webkit-transition: background 0.3s 0.3s;
  transition: background 0.3s 0.3s;
  padding-bottom: 30px;
  margin-bottom: 30px;
}

.cd-panel.cd-panel--is-visible {
  visibility: visible;
  -webkit-transition: visibility 0s 0s;
  transition: visibility 0s 0s;
  padding-bottom: 30px;
  margin-bottom: 30px;
}

.cd-panel.cd-panel--is-visible::after {
  background: rgba(0, 0, 0, 0.6);
  -webkit-transition: background 0.3s 0s;
  transition: background 0.3s 0s;
  padding-bottom: 30px;
  margin-bottom: 30px;
}

.cd-panel__header {
  position: fixed;
  width: 90%;
  height: 50px;
  line-height: 50px;
  background: rgba(255, 255, 255, 0.96);
  z-index: 2;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.08);
          box-shadow: 0 1px 1px rgba(0, 0, 0, 0.08);
  -webkit-transition: -webkit-transform 0.3s 0s;
  transition: -webkit-transform 0.3s 0s;
  transition: transform 0.3s 0s;
  transition: transform 0.3s 0s, -webkit-transform 0.3s 0s;
  -webkit-transform: translateY(-50px);
      -ms-transform: translateY(-50px);
          transform: translateY(-50px);
}

.cd-panel__header h1 {
  padding-left: 5%;
}

.cd-panel--from-right .cd-panel__header {
  right: 0;
}

.cd-panel--from-left .cd-panel__header {
  left: 0;
}

.cd-panel--is-visible .cd-panel__header {
  -webkit-transition: -webkit-transform 0.3s 0.3s;
  transition: -webkit-transform 0.3s 0.3s;
  transition: transform 0.3s 0.3s;
  transition: transform 0.3s 0.3s, -webkit-transform 0.3s 0.3s;
  -webkit-transform: translateY(0px);
      -ms-transform: translateY(0px);
          transform: translateY(0px);
}

@media only screen and (min-width: 768px) {
  .cd-panel__header {
    width: 70%;
  }
}

@media only screen and (min-width: 1170px) {
  .cd-panel__header {
    width: 50%;
  }
}

.cd-panel__close {
  position: absolute;
  top: 0;
  right: 0;
  height: 100%;
  width: 60px;
  /* image replacement */
  display: inline-block;
  overflow: hidden;
  text-indent: 100%;
  white-space: nowrap;
}

.cd-panel__close::before, .cd-panel__close::after {
  /* close icon created in CSS */
  content: '';
  position: absolute;
  top: 22px;
  left: 20px;
  height: 3px;
  width: 20px;
  background-color: #424f5c;
  /* this fixes a bug where pseudo elements are slighty off position */
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
}

.cd-panel__close::before {
  -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
          transform: rotate(45deg);
}

.cd-panel__close::after {
  -webkit-transform: rotate(-45deg);
      -ms-transform: rotate(-45deg);
          transform: rotate(-45deg);
}

.cd-panel__close:hover {
  background-color: #424f5c;
}

.cd-panel__close:hover::before, .cd-panel__close:hover::after {
  background-color: #ffffff;
  -webkit-transition: -webkit-transform 0.3s;
  transition: -webkit-transform 0.3s;
  transition: transform 0.3s;
  transition: transform 0.3s, -webkit-transform 0.3s;
}

.cd-panel__close:hover::before {
  -webkit-transform: rotate(220deg);
      -ms-transform: rotate(220deg);
          transform: rotate(220deg);
}

.cd-panel__close:hover::after {
  -webkit-transform: rotate(135deg);
      -ms-transform: rotate(135deg);
          transform: rotate(135deg);
}

.cd-panel--is-visible .cd-panel__close::before {
  -webkit-animation: cd-close-1 0.6s 0.3s;
          animation: cd-close-1 0.6s 0.3s;
}

.cd-panel--is-visible .cd-panel__close::after {
  -webkit-animation: cd-close-2 0.6s 0.3s;
          animation: cd-close-2 0.6s 0.3s;
}

@-webkit-keyframes cd-close-1 {
  0%, 50% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
  }
}

@keyframes cd-close-1 {
  0%, 50% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
  }
}

@-webkit-keyframes cd-close-2 {
  0%, 50% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
  }
}

@keyframes cd-close-2 {
  0%, 50% {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
  }
}

.cd-panel__container {
  position: fixed;
  width: 90%;
  height: 100%;
  top: 0;
  background: #ffffff;
  z-index: 1;
  -webkit-transition: -webkit-transform 0.3s 0.3s;
  transition: -webkit-transform 0.3s 0.3s;
  transition: transform 0.3s 0.3s;
  transition: transform 0.3s 0.3s, -webkit-transform 0.3s 0.3s;
  padding-bottom: 30px;
  margin-bottom: 30px;
}

.cd-panel--from-right .cd-panel__container {
  right: 0;
  -webkit-transform: translate3d(100%, 0, 0);
          transform: translate3d(100%, 0, 0);
}

.cd-panel--from-left .cd-panel__container {
  left: 0;
  -webkit-transform: translate3d(-100%, 0, 0);
          transform: translate3d(-100%, 0, 0);
}

.cd-panel--is-visible .cd-panel__container {
  -webkit-transform: translate3d(0, 0, 0);
          transform: translate3d(0, 0, 0);
  -webkit-transition-delay: 0s;
          transition-delay: 0s;
}

@media only screen and (min-width: 768px) {
  .cd-panel__container {
    width: 70%;
  }
}

@media only screen and (min-width: 1170px) {
  .cd-panel__container {
    width: 50%;
  }
}

.cd-panel__content {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding: 70px 5%;
  overflow: auto;
  /* smooth scrolling on touch devices */
  -webkit-overflow-scrolling: touch;
  padding-bottom: 30px;
  margin-bottom: 30px;
}

.cd-panel__content p {
  margin-top: 0;
  color: #555555;
  font-size: 16px;
  font-family: 'akagi-pro', sans-serif;
  font-weight: 300;
  font-style: normal;
  line-height: 24px;
}

.cd-panel__content li {
  margin-top: 0;
  color: #555555;
  font-size: 16px;
  font-family: 'akagi-pro', sans-serif;
  font-weight: 300;
  font-style: normal;
  line-height: 24px;
}

.cd-panel__content table{
  padding-top: 40px;
  margin-top: 40px;
}

.cd-panel__content td {
  color: #555555;
  font-size: 16px;
  font-family: 'akagi-pro', sans-serif;
  font-weight: 300;
  font-style: normal;
  line-height: 24px;
  width: 100%;
}

table {
  padding-top: 40px;
  margin-top: 40px;
}

td {
  color: #555555;
  font-size: 16px;
  font-family: 'akagi-pro', sans-serif;
  font-weight: 300;
  font-style: normal;
  line-height: 24px;
  width: 100%;
}

.cd-panel__content p:first-of-type {
  margin-top: 0;
}

@media only screen and (min-width: 768px) {
  .cd-panel__content p {
    font-size: 16px;
    line-height: 1.6;
  }
}

.stats-text p{
  width: 54%;
position: absolute;
bottom: 43px;
left: 4%;
text-align: center;
font: 32px/37px 'priori-sans-bold', Arial, Helvetica, sans-serif;
color: #fff;
}



</style>

<script type="text/javascript">


window.onload = function() {
  loadCourses();
};

</script>



<link type="text/css" rel="stylesheet" href="<?php echo $folder; ?>mc-programs.css"/>
<header class="header-img-container">
    <?php if (!empty($hero_image)) { ?>
        <img src="/images/<?php print $hero_image; ?>" alt="" />
    <?php
}
?>

        <div class="header-info-container">
            <div class="header-info">
              <?php if($degree_type == "none"){ ?>
                <h1 class="header-info__title"><?php print $program_name; ?>  </span>
                </h1>
              <?php } else { ?>
                <h1 class="header-info__title"><?php print $program_name; ?>
                  <?php
                  foreach($degree_type_array as $key=>$value):
                    ?>
                    <span class="degree-type-1"><?php print $value; ?></span>
                      <?php  endforeach;?>
                          </h1>
              <?php }?>
                <?php if ($concentration == "Yes") {
                    print "<span class='filter filter-programs cursor-pointer concentration' data-filter='concentration'><span class='badge'></span> Concentration</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                } ?>
                <?php if ($major == "Yes") {
                    print "<span class='filter filter-programs cursor-pointer major1' data-filter='major1'><span class='badge'></span> Major</span> &nbsp;&nbsp;&nbsp;&nbsp;";
                } ?>
                <?php if ($minor == "Yes") {
                    print "<span class='filter filter-programs cursor-pointer minor' data-filter='minor'><span class='badge'></span> Minor</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                } ?>
                <?php if ($accelerated == "Yes") {
                    print "<span class='filter filter-programs cursor-pointer accelerated' data-filter='accelerated'><span class='badge'></span> Accelerated</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                } ?>
                <?php if ($preprofessional_programs == "Yes") {
                    print "<span class='filter filter-programs cursor-pointer preprofessional_programs' data-filter='preprofessional_programs'><span class='badge'></span> Preprofessional Programs</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                } ?>
                <?php if ($allied_program == "Yes") {
                    print "<span class='filter filter-programs cursor-pointer allied_program' data-filter='allied_program'><span class='badge'></span> Allied Program</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                } ?>
                <?php if ($early_assurance == "Yes") {
                    print "<span class='filter filter-programs cursor-pointer early_assurance' data-filter='early_assurance'><span class='badge'></span> Early Assurance</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                } ?>
                <?php if ($undergrad_certificate == "Yes") {
                    print "<span class='filter filter-programs cursor-pointer undergrad_certificate' data-filter='undergrad_certificate'><span class='badge'></span> Undergrad Certificate</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                } ?>
                <?php if ($teaching_certification == "Yes") {
                   // print "*" . $teaching_certification . "*";
                print "<span class='filter filter-programs cursor-pointer teaching' data-filter='teaching'><span class='badge'></span>Teaching Certification</span>&nbsp;&nbsp;&nbsp;&nbsp;";
              } ?>

                <?php if ($program_format == "Online") {
                    print "<span class=\"header-info__online\">online</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                } ?>
                <?php if ($program_format == "Hybrid") {
                    print "<span class=\"header-info__hybrid\">hybrid</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                } ?>
                <?php if ($program_format == "Campus") {
                    print "<span class=\"header-info__campus\">campus</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                } ?>
            </div>
        </div>
    </header>

    <!-- BREADCRUMB -->
    <!-- <div class="breadcrumbs-2 bread__wrap">
        <ul class="breadcrumbs-list">
            <li>
                <a href="http://www.messiah.edu/" rel="home">Home</a>
            </li>
            <li>
                <a href="https://www.messiah.edu/academics" rel="academic">Academic</a>
            </li>
            <li>
                <a href="<?php print $department_url; ?>" rel="<?php print $department_name; ?>"><?php print $department_name; ?></a>
            </li>
<?php if (!empty($parent_program)) { ?>
        <li>
                <a href="<?php print $parent_program_url; ?>"><?php print $parent_program; ?></a>
        </li>
    <?php
} ?>
            <li>
                <span><?php print $program_name; ?></span>
            </li>
        </ul>
    </div> -->
    <!-- BREADCRUMB END -->


    <div id="main-content-2">
        <div class="main-holder-2">

            <div class="one-column-2">
                <div id="content">
            <!-- CONTENT -->
                    <div class="main-title clearfix">
                        <h2 class="h2-title"><?php print $program_name; ?></h2>
                        <button class="bookmark-btn">
                            <img src="//home.messiah.edu/~khardy/prototype/grad-program/files/images/program_page_images/bookmark-icon.png" alt="bookmark icon" class="bookmark-img">
                            <span>Bookmark This</span>
                        </button>
                    </div>

                    <div class="page-description">
                        <p><?php print $program_overview; ?></p>
                    </div>
                    <div class="page-tab">
                    <button class="tab-btn overview-btn" onclick="loadContent(event, 'overview',<?php print $overview_tab_id; ?>,'<?php print $program_name; ?>','at Messiah College')" id="overview">Overview</button>
                    <?php if(strpos($smart_catalog_degree_id, "|") !== false && empty($courses__curriculum_tab_id)){?>
                    <button class="tab-btn smart-catalog-btn" onclick="loadContent(event, 'smart-catalog','content','<?php print $program_name; ?>','courses')" id="courses"><?php print $tab_courses_name; ?></button>
                  <?php } else { ?>
                    <button class="tab-btn smart-catalog-btn" onclick="loadContent1(event, 'smart-catalog','content','<?php print $program_name; ?>','courses')" id="courses"><?php print $tab_courses_name; ?></button>
                  <?php } ?>
                    <button class="tab-btn tuition-btn" onclick="loadContent(event, 'tuition',content,'<?php print $program_name; ?>','careers and outcomes')" id="tuition-aid">Alumni Outcomes</button>
                    <button class="tab-btn apply-btn" onclick="loadContent(event, 'apply','content','<?php print $program_name; ?>','')" id="how-to-apply">Career Preparation</button>
                    <?php if(!empty($why_messiah_tab_override)){?>
                    <button  class="tab-btn why-messiah-btn" onclick="loadContent(event, 'why-messiah', 'content' ,'<?php print $program_name; ?>','')" id="why-messiah"><?php print $why_messiah_tab_override  ;?></button>
                      <?php } else { ?>
                    <button  class="tab-btn why-messiah-btn" onclick="loadContent(event, 'why-messiah', 'content' ,'<?php print $program_name; ?>','')" id="why-messiah">Why Messiah?</button>
                    <?php } ?>
                </div>
                </div>
            </div>
        </div>
    </div>


    <div class="tab-content-container">
        <div id="main-content-2">
            <div class="main-holder-2">
                <div class="one-column-2">
                    <div id="content">
                      <!-- LEFT COLUMN -->
                        <div id="Content" class="tabcontent" >

                      <!-- TAB: COUSES & CURRICULUM -->
                      <div id="courses_and_curriculum" style="display:none; position: relative;">

                          <div id="gen-content" class="editor" style="display:none; position:relative;">
                            <div class="float-left">
                      <p>In the <?php print $program_name?> program, you will take a
                        selection of courses that successfully prepare you for
                         a career in a related field. Hands-on experiences and
                          classroom learning within the framework of Christian
                          faith will give you the skills and knowledge to
                          achieve your goals. Our programs offer a wide variety
                           of courses that will not only help you excel in your
                            future career, but challenge you to develop a deeper
                             understanding of your field of study.</p>
                         </div>
                       </div>

                          <div class="float-left">
                            <div id="gen-course-overview" style="display:none;"><p><?php print $course_overview; ?></p></br>
                                <h2 id="course-title" >Course options for <?php print $program_name?>: </h2> </br>
                                <div id="courses-list" class="tabcontent-col-left-list" style="display:none;">
                                  <h3> Loading ... </h3>
                                </div>
                              </div>
                            </div>

                          </div>

                            <!-- TAB: CAREER PREPARATION -->


                            <div id="learning_by_doing" style="display:none;">
                              <div class="float-left" style="">

                              <div id="learning_by_doing_tab" style="display:none;">
                                <p><?php print $learning_by_doing_tab_id; ?></p>
                              </div>

                              <div class="widget-row">
                              <div class="widget-width widget-width__100">

                              <div class="widget widget__content">
                                  <h2>Messiah's unique approach to hands-on learning</h2>
                                  <div class="editor">
                              <p>Learning in the classroom is important but
                                 actually applying that knowledge in a hands-on
                                  way can make all the difference. At Messiah
                                  College, the Experiential Learning Initiative
                                  (ELI) allows Messiah to take this hands-on
                                   learning to a new level by giving students
                                   the opportunity to apply what they have
                                   learned to various real world contexts--such
                                   as an internship/practica, service learning,
                                   off-campus program, holding a student
                                   leadership position, or participating in
                                   undergraduate research.</p>

                              <p><a class="button" href="https://www.messiah.edu/career-prep">Learn more</a></p>

                                  </div>
                              </div>
                            </div>
                            </div>
                            <div class="widget-row">
                            <div class="widget-width widget-width__100">

                            <div class="widget widget__youtube-video">
                            <div id="video_player">
                                <div class="youtube-embed">
                                    <a class="gtm-video" href="https://www.youtube.com/watch?v=0jdsS_xe1bU" data-lity>
                                      <img class="play-button" src="https://www.messiah.edu/site/styles/images/youtube-play.png" alt="Press to play video" />
                                      <img src="https://img.youtube.com/vi/0jdsS_xe1bU/hqdefault.jpg" alt="screen shot of video" /></a>
                                </div>
                              </div>
                              </div>
                            </div>
                            </div>
                            </div>
                          </div>

                            <!-- TAB: ALUMNI OUTCOMES -->

                            <div id="career_and_outcomes" style="display:none;">
                              <div class="float-left" style="position:relative">

                              <h2><?php print $program_name?> careers and outcomes</h2> </br>

                              <h3>Where our grads work</h3>

                              <p>Graduates of the <?php print $program_name?> program
                                 work in positions of leadership in their places
                                  of employment, using the tools and knowledge
                                  a Messiah College education prepared them
                                  with. Each year, eager employers and some of
                                  the nation's best graduate schools welcome
                                  Messiah graduates into their organizations.
                                  <?php print $employment_rate; ?>
                                </p>

                                <p><a class="button" href="<?php print $dept_career_outcomes;?>" target="_blank"> Learn More</a></p>

                                    <!-- WHERE OUR GRAD WORKS WIDGET -->

                                  <?php if(!empty($where_they_work_separate__with_a_comma) && !empty($what_they_do_separate__with_a_comma) && !empty($where_they_study_separate__with_a_comma)){ ?>
                                  <div class="filter-holder">
                                     <label for="select">Filter by major:</label>
                                     <select id="select" class="sel-02 customForm-hidden">
                                         <option class="hidden">Button Style Here</option>
                                         <option>Name of major</option>
                                         <option>Name of major</option>
                                         <option>Name of major</option>
                                         <option>Name of major</option>
                                         <option>Name of major</option>
                                     </select>
                                  </div><!-- / filter holder -->
                                  <div class="block-inform" style="">
                                     <div class="text-inform">
                                         <div class="box-hold">
                                             <div class="box">
                                                 <h2>Where they work</h2>
                                                 <ul>
                                                 <?php foreach ($work_array as $company) {
                                                         print "<li>" . $company . "</li>\n";
                                                       }
                                                 ?>
                                                 </ul>
                                             </div>
                                             <div class="box">
                                                 <h2>What they do</h2>
                                                 <ul>
                                                 <?php foreach ($do_array as $job) {
                                                         print "<li>" . $job . "</li>\n";
                                                       }
                                                 ?>
                                                 </ul>
                                             </div>
                                             <div class="box">
                                                 <h2>Graduate school</h2>
                                                 <ul>
                                                 <?php foreach ($study_array as $maj) {
                                                         print "<li>" . $maj . "</li>\n";
                                                       }
                                                 ?>
                                                 </ul>
                                             </div>
                                         </div>
                                         <div class="box-view">
                                             <a href="#" class="btn-view"><em>View full list</em> <span>collapse list</span></a>
                                         </div>
                                     </div>
                                  </div>

                                <?php } ?>

                                  <!-- PERCENTAGE STATISTICS WIDGET -->
                                  <div class="statistics-hold">
                  	<div class="statistics-block">
                  		<span class="img-hold">
                  			<img src="/site/images/grad_stats_background.jpg" alt="image desxcription" width="832" height="317">
                  		</span>
                  		<div class="stats-text">
                  			<p><?php print $param_percentage;?><?php print $param_text;?></p>
                  			<?php if (!empty($param_url)) { ?>
                  			<?php } ?>
                  		</div>
                  		<div class="statistics-circle">
                  			<span><span class="value"><?php print $param_percentage;?></span>%</span>
                  			<div angle-data="[[34, 2, 0], [360, 2, 10]]" start-data="[[0, 2, 0], [34, 2, 10]]" color-data='["#ffffff", "#00FFFFFF"]' percent-data="<?php print $param_percentage;?>"></div>
                  		</div>
                  	</div>
                  </div>

                              </br>

                                <div class="widget-row">
                                <div class="widget-width widget-width__100">

                                <div class="widget widget__content">
                                    <h3>Our Alumni</h3>
                                    <div class="editor">
                                <p>Regional and national employers seek out
                                   Messiah graduates for their academic
                                    preparation, work ethic and personal
                                    character. The transformation you experience
                                     at Messiah readies you to transform the
                                     lives of others through your chosen career
                                      path.</p>

                                <p><a class="button" href="<?php print $dept_alumni_link;?>" target="_blank">Meet Alumni from the <?php print $department_name;?></a></p>

                                    </div>
                                </div>
                              </div>
                              </div>
                              </div>
                            </div>

                            <!-- TAB: OVERVIEW -->
                            <div class="tabcontent-col-left">
                              <div id="tabcontent-col-left">
                              [Dynamic Content Here]
                              </div>

                              <!-- RELATED PROGRAMS -->
                              <div id="peek-overlay" class="_peek-overlay">
                              </div>
                            </div>

                            <!-- WHY MESSIAH -->
                            <div class="tabcontent-col-why" id="why-content" style="display:none; position:relative">
                              <?php print $why_messiah_tab_content; ?>
                          </div>



                          <!--LEFT CONTENT END -->
                        </div>


                      <!-- RIGHT COLUMN -->
                      <div class="form-col-right">
                          <div class="info-panel">
                            <?php if(!empty($department_url)){?>
                              <a href="<?php print $department_url; ?>" class="view-homepage-btn overlay-color">
                                  <p class="btn-upper-text">Department of
                                  <span class="btn-bottom-text"><?php print $department_name; ?></span></p>
                              </a>
                              <?php } ?>
                              <?php if(!empty($meet_the_faculty_url)){?>
                              <a href="<?php print $meet_the_faculty_url; ?>" class="meet-faculty-btn overlay-color">
                                  <p class="btn-upper-text">meet the
                                  <span class="btn-bottom-text">Faculty</span></p>
                              </a>
                              <?php } ?>
                              <?php if(!empty($view_our_facilities_url)){?>
                               <a href="<?php print $view_our_facilities_url; ?>" class="view-homepage-btn overlay-color ">
                                  <p class="btn-upper-text">View our
                                  <span class="btn-bottom-text">Facilities</span></p>
                              </a>
                              <?php } ?>
                              <a href="https://www.messiah.edu/request-info" class="btn-blue btn-white">
                                  <img src="/site/custom_scripts/styles/ug-program-page/images/program_page_images/request-info-icon.png" alt="request information icon" class ="request-icon" >
                                  <span> Request Info </span>
                              </a>
                              <a href="https://www.messiah.edu/applytoday" class ="btn-blue btn-white">
                                  <img src = "/site/custom_scripts/styles/ug-program-page/images/program_page_images/apply-icon-white.png" alt="apply button icon" class ="apply-icon">
                                  <span>Apply</span>
                              </a>
                              <a href = "#" class ="btn-white" >
                                  <img src = "/site/custom_scripts/styles/ug-program-page/images/program_page_images/admission-requirements-icon.png" alt="admissions icon" class="admissions-icon" >
                                  <span > Admission Requirements </span >
                              </a>
                              <a href = "#" class ="btn-white" >
                                  <img src = "/site/custom_scripts/styles/ug-program-page/images/program_page_images/tuition-icon-20.png" alt="tuition icon" class="tuition-icon" >
                                  <span > Tuition </span>
                              </a>
                              <a href = "#" class ="btn-white" >
                                  <img src = "/site/custom_scripts/styles/ug-program-page/images/program_page_images/scholarships-icon.png" alt="scholarships icon" class="scholarships-icon" >
                                  <span > Scholarships </span>
                              </a>
                          </div>
                      </div>
                      <input type="hidden" id="program-id" value="<?php echo $entryID; ?>">


                      <!-- RIGHT COLUMN END -->

                    </div>
              </div>
            </div>
        </div>
    </div>

    <script id="peek-template" type="text/x-jQuery-tmpl">
        <div class="_peek">
            <div id="peek-related" class="peek-related" style="display: none">
                <h3 class="peek-subtitle">Programs related to</h3>
                <h2 class="peek-title"><?php print $program_name; ?></h2>
                <div class="peek-related-scroll">
                    <div id="peek-related-programs" class="related-wrap">
                    </div>
                </div>
                <div id="related-nav" class="related-nav" style="display: none">
                    <a id="peek-nav-prev" class="peek-nav-button" ><img src="<?php echo $folder; ?>img/programs/peek-prev.png" /></a>
                    <a id="peek-nav-next" class="peek-nav-button" ><img src="<?php echo $folder; ?>img/programs/peek-next.png" /></a>
                </div>
            </div>
        </div>
    </script>

    <script id="peek-related-programs-template" type="text/x-jQuery-tmpl">
        <div class="related-single open-subpeek" data-index="${index}">
            <div class="single-img">
                {{if (thumbnail_small == '') }}
                <img src="//www.messiah.edu/site/custom_scripts/images/default_thumbnail.png"/>
                {{else}}
                <img src="//www.messiah.edu/images/${thumbnail_small}"/>
                {{/if}}
            </div>
            <div class="info">
                <h4>${program_name}</h4>
                {{if ((major == 'Yes') || (major == 'yes')) }}<span class="major"><span class="badge"></span></span>{{/if}}
                {{if ((minor == 'Yes') || (minor == 'yes')) }}<span class="minor"><span class="badge"></span></span>{{/if}}
                {{if ((concentration == 'Yes') || (concentration == 'yes')) }}<span class="concentration"><span class="badge"></span></span>{{/if}}
                {{if ((preprofessional_programs == 'Yes') || (preprofessional_programs == 'yes')) }}<span class="prepro"><span class="badge"></span></span>{{/if}}
                {{if ((allied_program == 'Yes') || (allied_program == 'yes')) }}<span class="dual-degree"><span class="badge"></span></span>{{/if}}
                {{if ((teaching_certification == 'Yes') || (teaching_certification == 'yes')) }}<span class="teaching"><span class="badge"></span></span>{{/if}}
                {{if ((accelerated == 'Yes') || (accelerated == 'yes')) }}<span class="accelerated"><span class="badge"></span></span>{{/if}}
                {{if ((early_assurance == 'Yes') || (early_assurance == 'yes')) }}<span class="assurance"><span class="badge"></span></span>{{/if}}
            </div>
            <div class="read-more">
                <a href="https://www.messiah.edu/undergraduate/${url_slug}" target="_blank">Read more</a>
            </div>
        </div>
    </script>


    <script id="programs-template" type="text/x-jQuery-tmpl">
        <tr class="program-line {{if (expanded) }}expanded{{/if}}">
            <td class="name">
                {{if (sort != '') }}<a name="${sort}"></a>{{/if}}
                <a class="program-url" data-index="${index}">${program_name}</a>
                {{each degree_types}}
                <span class="degree-type">${$value.name}</span>
                {{/each}}
                {{if (grad_program_format == 'Hybrid') }}
                <span class="show-tooltip prg-hybrid"> </span>
                {{/if}}
                {{if (grad_program_format == 'Campus') }}
                <span class="show-tooltip prg-campus"> </span>
                {{/if}}
                {{if (grad_program_format == 'Online') }}
                <span class="show-tooltip prg-online"> </span>
                {{/if}}
            </td>
            <td>{{if ((major == 'Yes') || (major == 'yes')) }}<span class="show-tooltip major"><span class="badge"></span></span>{{/if}}</td>
            <td>{{if ((minor == 'Yes') || (minor == 'yes')) }}<span class="show-tooltip minor"><span class="badge"></span></span>{{/if}}</td>
            <td>{{if ((concentration == 'Yes') || (concentration == 'yes')) }}<span class="show-tooltip concentration"><span class="badge"></span></span>{{/if}}</td>
            <td>
            {{if ((undergrad_certificate == 'Yes') || (undergrad_certificate == 'yes')) }}<span class="show-tooltip ug-certificate"><span class="badge"></span></span>{{/if}}
            {{if ((preprofessional_programs == 'Yes') || (preprofessional_programs == 'yes')) }}<span class="show-tooltip prepro"><span class="badge"></span></span>{{/if}}</td>
            <td>{{if ((allied_program == 'Yes') || (allied_program == 'yes')) }}<span class="show-tooltip dual-degree"><span class="badge"></span></span>{{/if}}</td>
            <td>{{if ((teaching_certification == 'Yes') || (teaching_certification == 'yes')) }}<span class="show-tooltip teaching"><span class="badge"></span></span>{{/if}}</td>
            <td>{{if ((accelerated == 'Yes') || (accelerated == 'yes')) }}<span class="show-tooltip accelerated"><span class="badge"></span></span>{{/if}}</td>
            <td>{{if ((early_assurance == 'Yes') || (early_assurance == 'yes')) }}<span class="show-tooltip assurance"><span class="badge"></span></span>{{/if}}</td>
            <td>{{if ((grad_concentration == 'Yes') || (grad_concentration == 'yes')) }}<span class="show-tooltip grad-c"><span class="badge"></span></span>{{/if}}

            </td>
            <td>{{if ((grad_track == 'Yes') || (grad_track == 'yes')) }}<span class="show-tooltip grad-t"><span class="badge"></span></span>{{/if}}</td>
            <td>{{if ((grad_pa_teaching_certification == 'Yes') || (grad_pa_teaching_certification == 'yes')) }}<span class="show-tooltip grad-p"><span class="badge"></span></span>{{/if}}</td>
            <td>{{if ((grad_grad_certificate == 'Yes') || (grad_grad_certificate == 'yes')) }}<span class="show-tooltip grad-g"><span class="badge"></span></span>{{/if}}</td>
            <td>{{if ((grad_nondegree == 'Yes') || (grad_nondegree == 'yes')) }}<span class="show-tooltip grad-n"><span class="badge"></span></span>{{/if}}</td>
            <td>{{if ((grad_certificate_in_advanced_graduate_studies == 'Yes') || (grad_certificate_in_advanced_graduate_studies == 'yes')) }}<span class="show-tooltip grad-a"><span class="badge"></span></span>{{/if}}</td>
        </tr>
    </script>

    <?php if ($program_name) { ?>
    <script id="autocomplete-template" type="text/x-jQuery-tmpl">
        <div id="autocomplete-item-${id}" class="auto-suggest" data-keyword="${keyword}"><span>${selection}</span>${rest}</div>
    </script>
    <?php } ?>

    <script id="subpeek-template" type="text/x-jQuery-tmpl">
        <div class="subpeek">
            <div id="subpeek-close" class="peek-close">
                <img src="<?php echo $folder; ?>img/programs/peek-close.png">
            </div>
            <div class="peek-img">
                <img id="subpeek-large-image" src="//www.messiah.edu/images/${thumbnail_peek}">
            </div>
            <div class="peek-content">
                <h2 class="peek-title">${program_name}
                    {{each degree_types}}
                    <span class="degree-type">${$value.name}</span>
                    {{/each}}
                </h2>
                {{each categoryNames}}
                <h3 class="peek-subtitle"><span class="peek-ball" style="display: none;"></span><span id="subpeek-category">${$value}</span></h3>
                {{/each}}
                <div class="badge-field">
                    {{if ((major == 'Yes') || (major == 'yes')) }}<span class="major"><span class="badge"></span></span>{{/if}}
                    {{if ((minor == 'Yes') || (minor == 'yes')) }}<span class="minor"><span class="badge"></span></span>{{/if}}
                    {{if ((concentration == 'Yes') || (concentration == 'yes')) }}<span class="concentration"><span class="badge"></span></span>{{/if}}
                    {{if ((preprofessional_programs == 'Yes') || (preprofessional_programs == 'yes')) }}<span class="prepro"><span class="badge"></span></span>{{/if}}
                    {{if ((allied_program == 'Yes') || (allied_program == 'yes')) }}<span class="dual-degree"><span class="badge"></span></span>{{/if}}
                    {{if ((teaching_certification == 'Yes') || (teaching_certification == 'yes')) }}<span class="teaching"><span class="badge"></span></span>{{/if}}
                    {{if ((grad_concentration == 'Yes') || (grad_concentration == 'yes')) }}<span class="grad-c"><span class="badge"></span></span>{{/if}}
                    {{if ((grad_track == 'Yes') || (grad_track == 'yes')) }}<span class="grad-t"><span class="badge"></span></span>{{/if}}
                    {{if ((grad_pa_teaching_certification == 'Yes') || (grad_pa_teaching_certification == 'yes')) }}<span class="grad-p"><span class="badge"></span></span>{{/if}}
                    {{if ((grad_grad_certificate == 'Yes') || (grad_grad_certificate == 'yes')) }}<span class="grad-g"><span class="badge"></span></span>{{/if}}
                    {{if ((grad_nondegree == 'Yes') || (grad_nondegree == 'yes')) }}<span class="grad-n"><span class="badge"></span></span>{{/if}}
                    {{if ((grad_certificate_in_advanced_graduate_studies == 'Yes') || (grad_certificate_in_advanced_graduate_studies == 'yes')) }}<span class="grad-a"><span class="badge"></span></span>{{/if}}
                    <span class="bookmark-box" style="display: none;"><span class="bookmark-txt">Bookmark</span><span class="peek-bookmark"></span></span>
                </div>
                <p id="subpeek-overview">${program_peek}</p>
                <div class="options-box">
                    <h3>Graduate Job Options</h3>
                    <div id="subpeek-career-options">
                        <ul>
                        {{each careerOptionsArray}}<li>${$value}</li>{{/each}}
                        </ul>
                    </div>
                </div>
                <a class="peek-button" href="${program_url}">Visit Program Page</a>
            </div>
            <div id="subpeek-related" class="peek-related" style="display: none">
                <div class="related-nav">
                    <a id="subpeek-nav-prev" class="peek-nav-button"><img src="<?php echo $folder; ?>img/programs/peek-prev.png"></a>
                    <a id="subpeek-nav-next" class="peek-nav-button"><img src="<?php echo $folder; ?>img/programs/peek-next.png"></a>
                </div>
            </div>
        </div>
    </script>

    <!-- jQuery Templates -->
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.js"></script>
    <script type="text/javascript" src="<?php echo $folder; ?>mc-programs-ug.js?v=<?php echo $version; ?>"></script>
