<?php
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

require_once "bootstrap.php";
# ###############################################
# To Mimic A Home Page set the Jadu Homepage ID - Test Kris - Test 2
#
$show_homepage_content_inside = true;

$homepage = 3272;
$show_homepage_content = true;
#require_once CUSTOM_APP_ROOT . "/lib/jadu_homepage_header.php";
#
# ###############################################

if (isset($_GET['urlSlug'])) {
    $url_slug = $_GET['urlSlug'];
} else {
    // Fail out "gracefully"
    require_once '../../404.php';
}

$directoryID = 1;   # hardcoded for the undergrad programs directory
$directoryID2 = 13;

/*
    URL format : https://www.messiah.edu/gradwords/mba_-_digital_marketing_track
 */

#$title_match = str_replace('_', " ", $entryName);
#$all_entries = getAllDirectoryEntries ($directoryID, -1, -1, $titleMatch = $title_match);
#$entryID = $all_entries[0]->id;

$entryID = get_entryid_by_slug($url_slug);
if (!empty($entryID)) {
    // hacked in from directories to build the breadcrumbs... hopefully
    $record = getDirectoryEntry($entryID);

    #$entryInfo = getDirectoryEntry ($record);
    $entryTitle = $record->title;
    $entry['entry_title'] = $entryTitle;

    $field_list = getAllDirectoryFields($directoryID, false);
    $field_list2 = getAllDirectoryFields($directoryID2, false);

    foreach ($field_list as $field) {
        // grab the field id and field title which will be used in the array after its processed
        $fieldID = $field->id;
        $fieldTitle = $field->title;

        // get the entry value for this field
        $EntryValue = getDirectoryEntryValue($entryID, $fieldID);

        // build a nice key name for our future json string
        $field_index = preg_replace('/[^A-Za-z0-9\_]/', '', strtolower(str_replace(" ", "_", $fieldTitle)));

        // get the actual value from the returned array above
        $fieldValue = $EntryValue->value;

        $fieldValue = str_replace('<a', '<a target="_blank"', $fieldValue);

        // build our array
        //$field_array[$entryID][$field_index] = $fieldValue;
        $entry[$field_index] = $fieldValue;
    }

    foreach ($field_list2 as $field) {
        // grab the field id and field title which will be used in the array after its processed
        $fieldID2 = $field->id;
        $fieldTitle2 = $field->title;

        // get the entry value for this field
        $EntryValue2 = getDirectoryEntryValue($entryID, $fieldID2);

        // build a nice key name for our future json string
        $field_index2 = preg_replace('/[^A-Za-z0-9\_]/', '', strtolower(str_replace(" ", "_", $fieldTitle2)));

        // get the actual value from the returned array above
        $fieldValue2 = $EntryValue2->value;

        $fieldValue2 = str_replace('<a', '<a target="_blank"', $fieldValue2);

        // build our array
        //$field_array[$entryID][$field_index] = $fieldValue;
        $entry2[$field_index2] = $fieldValue2;
    }
    //print_r($entry);
    //exit

    $employment_rate = $entry2['employment_rate'];

    $entry_title = $entry['entry_title'];
    $program_name = $entry['program_name'];
    $program_overview = $entry['program_overview'];
    $program_peek = $entry['program_peek'];
    $degree_type = $entry['degree_type'];
    $degree_type_array = explode(',', $degree_type);
    $degree_type_full_name = $entry['degree_type_full_name'];
    $major = $entry['major'];
    $minor = $entry['minor'];
    $concentration = $entry['concentration'];
    $preprofessional_programs = $entry['preprofessional_programs'];
    $allied_program = $entry['allied_program'];
    $early_assurance = $entry['early_assurance'];
    $undergrad_certificate = $entry['undergrad_certificate'];
    $teaching_certification = $entry['teaching_certification'];
    $accelerated = $entry['accelerated'];
    $grad_program = $entry['grad_program'];
    $grad__concentration = $entry['grad__concentration'];
    $grad__track = $entry['grad__track'];
    $grad__pa_teaching_certification = $entry['grad__pa_teaching_certification'];
    $grad__grad_certificate = $entry['grad__grad_certificate'];
    $grad__certificate_in_advanced_graduate_studies = $entry['grad__certificate_in_advanced_graduate_studies'];
    $grad__nondegree = $entry['grad__nondegree'];
    $grad__program_format = $entry['grad__program_format'];
    $overview_tab_id = $entry['tab__overview'];
    $courses__curriculum_tab_id = $entry['tab__courses_and_curriculum'];
    $career_and_outcomes_tab_id = $entry['career_and_outcomes_tab_id'];
    $learning_by_doing_tab_id = $entry['tab__career_preparation'];
    $why_messiah_tab_content = $entry['tab__why_messiah'];
    $why_messiah_tab_override = $entry['tab__why_messiah__name_override'];
    $interest_groups = $entry['interest_groups'];
    $url_slug = $entry['url_slug'];
    $program_url = $entry['program_url'];
    $major_courses_url = $entry['major_courses_url'];
    $major_courses_url = $entry['major_courses_url'];
    $concentration_courses_url = $entry['concentration_courses_url'];
    $pre_professional_courses_url = $entry['pre_professional_courses_url'];
    $teaching_certification_course_url = $entry['teaching_certification_course_url'];
    $where_they_work_separate__with_a_comma = $entry['where_they_work'];
    $what_they_do_separate__with_a_comma = $entry['what_they_do'];
    $where_they_study_separate__with_a_comma = $entry['where_they_study'];
    $career_options = $entry['career_options'];
    $parent_program = $entry['parent_program'];
    $related_programs = $entry['related_programs'];
    $thumbnail_large = $entry['thumbnail_large'];
    $thumbnail_small = $entry['thumbnail_small'];
    $thumbnail_peek = $entry['thumbnail_peek'];
    $hero_image = $entry['hero_image'];
    $department_name = $entry['department_name'];
    $department_url = $entry['department_url'];
    $meet_the_faculty_url = $entry['meet_the_faculty_url'];
    $view_our_facilities_url = $entry['view_our_facilities_url'];
    $dept_career_outcomes = $entry['tab__alumni_outcomes__dept_outcomes_link'];
    $smart_catalog_degree_id = $entry["tab__courses_and_curriculum__catalog_id"];                         // has double _ in api results
    // $smart_catalog_degree_id = preg_replace('/\.$/', '', $smart_catalog_degree_id); //Remove dot at end if exists
    $smart_catalog_degree_id_array = explode('|', $smart_catalog_degree_id); //split string into array seperated by '| '
    $guid = explode('|', $smart_catalog_degree_id); //split string into array seperated by '| '
    $smart_catalog_core_courses = $entry["smart_catalog__core_courses"];                    // has double _ in api results
    $smart_catalog_concentrationtrack_id = $entry["smart_catalog__concentrationtrack_id"];  // has double _ in api results
    $show_full_department = $entry['where_our_grads_work__show_full_department'];
    $dept_alumni_link = $entry['tab__alumni_outcomes__dept_alumni_link'];
    $smart_catalog_integration = false;

    // $guid = $smart_catalog_degree_id_array;                          // has double _ in api results
    if (empty($guid)) {
        $guid = $entry["smart_catalog__core_courses"];                    // has double _ in api results
    }
    $smart_catalog_concentrationtrack_id = $entry["smart_catalog__concentrationtrack_id"];  // has double _ in api results

    $course_overview = $entry['course_overview'];
    $learning_by_doing_tab = $entry['tab_learning_by_doing'];


//    var_dump($entry);
//
//    exit();
    if (!empty(trim($smart_catalog_degree_id.$smart_catalog_core_courses.$smart_catalog_concentrationtrack_id))) {
        $smart_catalog_integration = true;
    }

    if (!empty($smart_catalog_degree_id) && empty($smart_catalog_core_courses.$smart_catalog_concentrationtrack_id)) {
        $is_parent_program = true;
        $smart_catalog_id = $smart_catalog_degree_id;
    }


    if (empty($tab_courses_name)) {
        $tab_courses_name = "Courses & Curriculum";
    }
} else {
    require_once '../../404.php';
}


include "ugrad-programs-pages-header.php";
?>
<script>
var loaded = false;
var html_datax;
function loadCourses(){
  <?php
  $i = 0;
  foreach($guid as $key=>$value):
    $i++;
    ?>
      $.get("/a/ugrad-program-pages/smart-catalog-v2-api-combined-03.php?guid=<?php print $value;?>&concentrationguid=<?php print $smart_catalog_concentrationtrack_id;?>", function (data, status) {
        html_data<?php print $i?> = data;
        $('#panelView<?php print $i?>').html(html_data<?php print $i?>);
        console.log(<?php print $i?>);
        if(<?php print $i?> == 1){
          loaded = true;
          console.log(loaded);
          $('.tabcontent-col-left-list').html(html_datax);
        }
      });
    <?php  endforeach;?>
}


function loadContent(evt, eventName, homepageId, headerName, headerText) {

      $('#gen-content').hide();
      $('.tab-btn').removeClass('active');
      $('.'+eventName+'-btn').addClass('active');
      $('#gen-course-overview').hide();
      $('.tabcontent-col-left-list').hide();
      $('#gen-content').hide();
      $('#learning_by_doing_tab').hide();
      $('#learning_by_doing').hide();
      $('#why-content').hide();
      $('#courses_and_curriculum').hide();
      $('.tabcontent-col-left').show();
      $('#career_and_outcomes').hide();
      $('#courses_and_curriculum').hide();

      if (eventName == 'smart-catalog') {
        $('.tabcontent-col-left').hide();
        $('#gen-course-overview').show();
        $('#courses_and_curriculum').show();

        var course_overview = <?php echo json_encode($course_overview, JSON_HEX_TAG); ?>;

        if(course_overview !== null && course_overview !== '') {
          $('#gen-content').hide();
        } else{
          $('#gen-content').show();
        }
        $('.tabcontent-col-left-list').show();

          $.get("/a/ugrad-program-pages/smart-catalog-v2-api-combined-02.php?guid=<?php print $smart_catalog_degree_id;?>&concentrationguid=<?php print $smart_catalog_concentrationtrack_id;?>", function (data, status) {
              $('.tabcontent').show();
              $('#why-content').hide();
              $('#courses_and_curriculum').show();

              if (headerText != '') {
                  html_datax = data;
              } else {
                  html_datax = data;
              }

              // Load smart_catalog__core_courses

              if (loaded == true){
              $('.tabcontent-col-left-list').html(html_datax);
            } else {
              // Do nothing?

            }

              var acc = document.getElementsByClassName("acc");

              for (i = 0; i < acc.length; i++) {
                  acc[i].addEventListener("click", function () {

                      this.classList.toggle("active");
                      var panel = this.nextElementSibling;
                      if (panel.style.maxHeight) {
                          panel.style.maxHeight = null;
                      } else {
                          // panel.style.maxHeight = panel.scrollHeight + "px";
                          panel.style.maxHeight = "500px";
                      }

                      var guid = this.id;
                      $.get("get-course-description.php?guid="+guid, function (data, status) {
                          $("#course-"+guid).html(data);
                      });
                  });
              }
          });
      }

      else if(eventName=='why-messiah'){
        $('#why-content').show();
        $('.tabcontent-col-left').hide();
        $('#career_and_outcomes').hide();
        $('#gen-content').hide();
        $('#courses_and_curriculum').hide();
      }

      else if(eventName=='apply'){
        $('#gen-content').hide();
        $('#learning_by_doing_tab').show();
        $('#learning_by_doing').show();
        $('.tabcontent-col-left').hide();
        $('#career_and_outcomes').hide();
        $('#courses_and_curriculum').hide();

      }

      else if(eventName=='tuition'){
        $('.tabcontent-col-left').hide();
        $('#learning_by_doing_tab').hide();
        $('#learning_by_doing').hide();
        $('#why-content').hide();
        $('#career_and_outcomes').show();
        $('#gen-content').hide();
        $('#courses_and_curriculum').hide();

      }


      else {

          $.get("/a/mcsquare/?" + homepageId, function (data, status) {
              $('.tabcontent').show();

              if (headerText != '') {
                  html_data = "<h2 class='tab-heading'> " + headerName + " " + headerText + " </h2>" + data
              } else {
                  html_data = data;
              }

              $('#tabcontent-col-left').html(html_data);

              var acc = document.getElementsByClassName("acc");

              for (i = 0; i < acc.length; i++) {
                  acc[i].addEventListener("click", function () {
                      this.classList.toggle("active");
                      var panel = this.nextElementSibling;
                      if (panel.style.maxHeight) {
                          panel.style.maxHeight = null;
                      } else {
                          panel.style.maxHeight = panel.scrollHeight + "px";
                      }
                  });
              }
          });
      }
  }

  function loadContent1(evt, eventName, homepageId, headerName, headerText) {
    $('.tab-btn').removeClass('active');
    $('.'+eventName+'-btn').addClass('active');
    $('#gen-course-overview').hide();
    $('#learning_by_doing_tab').hide();
    $('#learning_by_doing').hide();
    $('#why-content').hide();
    $('#courses_and_curriculum').hide();
    $('.tabcontent-col-left').show();
    $('#career_and_outcomes').hide();
    $('#courses_and_curriculum').hide();

    if (eventName == 'smart-catalog') {
        $.get("/a/ugrad-program-pages/smart-catalog-v2-api-combined-01-Mixed.php?guid=<?php print $smart_catalog_degree_id;?>&concentrationguid=<?php print $smart_catalog_concentrationtrack_id;?>", function (data, status) {

            $('.tabcontent').show();

            if (headerText != '') {
                html_data = data;
            } else {
                html_data = data;
            }

            $('#gen-course-overview').show();

            $('#tabcontent-col-left').html(html_data);

            var acc = document.getElementsByClassName("acc");

            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function () {

                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                        panel.style.maxHeight = null;
                    } else {
                        // panel.style.maxHeight = panel.scrollHeight + "px";
                        panel.style.maxHeight = "500px";
                    }

                    var guid = this.id;
                    $.get("get-course-description.php?guid="+guid, function (data, status) {
                        $("#course-"+guid).html(data);
                    });
                });


            }
        });

    } else {

        $.get("/a/mcsquare/?" + homepageId, function (data, status) {
            $('.tabcontent').show();

            if (headerText != '') {
                html_data = "<h2 class='tab-heading'> " + headerName + " " + headerText + " </h2>" + data
            } else {
                html_data = data;
            }

            $('#tabcontent-col-left').html(html_data);
            $('#gen-course-overview').hide();

            var acc = document.getElementsByClassName("acc");

            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function () {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                        panel.style.maxHeight = null;
                    } else {
                        panel.style.maxHeight = panel.scrollHeight + "px";
                    }
                });
            }
        });
    }
}



    function openChat() {
        window.open("https://secure.livechatinc.com/licence/5528171/v2/open_chat.cgi?groups=0", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
    }
</script>

<?php include "page-template.php"; ?>

<script>

$(document).ready(function() {
    console.log('ANCHOR' + window.location.hash.substring(1));
    if(window.location.hash) {
        var url_anchor = window.location.hash.substring(1);
        document.getElementById(url_anchor).click();

    } else {
        // open overviw tab when page loads
        document.getElementById("overview").click();
    }
    // tab scrolls to content on mobile
    $(".overview-btn").click(function() {
        if ($(window).width() < 769){
            $('html, body').animate({
                scrollTop: $("#Overview").offset().top
            }, 1000);
        }
    });

    $(".courses-btn").click(function() {
        if ($(window).width() < 769){
            $('html, body').animate({
                scrollTop: $("#Courses").offset().top
            }, 1000);
        }
    });

    $(".tuition-btn").click(function() {
        if ($(window).width() < 769){
            $('html, body').animate({
                scrollTop: $("#Tuition").offset().top
            }, 1000);
        }
    });

    $(".apply-btn").click(function() {
        if ($(window).width() < 769){
            $('html, body').animate({
                scrollTop: $("#Apply").offset().top
            }, 1000);
        }
    });

    $(".why-messiah-btn").click(function() {
        if ($(window).width() < 769){
            $('html, body').animate({
                scrollTop: $("#Messiah").offset().top
            }, 1000);
        }
    });
});

$.fn.exists = function(){return this.length>0;}

</script>

<!-- Hide Why Messiah Tab if empty -->

<script type="text/javascript">

var why_messiah_content = <?php echo json_encode($why_messiah_tab_content, JSON_HEX_TAG); ?>;

if(!!why_messiah_content){
  $('#why-messiah').show();
} else{
  $('#why-messiah').hide();
}

// Hide course list if no courses

var course_list_content = <?php echo json_encode($smart_catalog_degree_id, JSON_HEX_TAG); ?>;

if(!!course_list_content){
  $('#course-title').show();
  $('.tabcontent-col-left-list').show();
    $('#loading').hide();
} else{

  $('#course-list').hide();
  $('#course-title').hide();
  $('.tabcontent-col-left-list').hide();
}


</script>

<?php
require_once CUSTOM_APP_ROOT . "/lib/jadu_homepage_footer.php";
