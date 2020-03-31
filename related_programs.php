<?php
  //$dev = true;
  $dev = false;
  $pageId = 'programs';
  //$pageId = 'department';
  $programsPage = $pageId == 'programs';
  $categoryId = '';
  $folder = '';
  $version = date('YmdHis');
  if (!$dev) {
    $version = 13;
    $folder = '/site/custom_scripts/styles/';
  }
  if (!$programsPage) {
    if ($dev) {
      $categoryId = 17;
    } else {
      $param_department = "";
      if ($param_department == '%' . 'PARAM_DEPARTMENT%' || $param_department == '') {
        $param_department = '%PARAM_DEPARTMENT%';
      }
      $department_array = explode("|", $param_department);
      $department_name = $department_array[0];
      $categoryId = $department_array[1];
    }
  }
?>

<link type="text/css" rel="stylesheet" href="<?php echo $folder; ?>mc-programs.css?version=<?php echo $version; ?>"/>

<div id="peek-related" class="peek-related" style="">
  <h3 class="peek-subtitle">Programs related to</h3>
   <h2 class="peek-title"><?php print $program_name; ?></h2>
    <div class="peek-related-scroll">
      <div id="peek-related-programs" class="related-wrap"><div class="related-single open-subpeek" data-index="89">
         <div class="single-img">
           <img src="//www.messiah.edu/images/Finance_Thumbnail.png">
         </div>
         <div class="info">
           <h4>Finance</h4>
           <span class="major"><span class="badge"></span>
         </span>
         <span class="minor"><span class="badge"></span></span>
       </div>
       <div class="read-more">
         <a>Read more</a>
        </div>
      </div>
      <div class="related-single open-subpeek" data-index="1">
        <div class="single-img">
          <img src="//www.messiah.edu/images/thumb_as.jpg">
        </div>
        <div class="info"> <h4>Actuarial Science </h4>
           <span class="major"><span class="badge"></span></span>
          </div>
          <div class="read-more">
            <a>Read more</a>
          </div>
        </div>
        <div class="related-single open-subpeek" data-index="113">
          <div class="single-img">
            <img src="//www.messiah.edu/images/Math_Thumbnail.jpg">
          </div>
          <div class="info">
            <h4>Mathematics</h4>
            <span class="major"><span class="badge"></span></span>
            <span class="minor"><span class="badge"></span></span>
            <span class="teaching"><span class="badge"></span></span>
          </div>
          <div class="read-more"> <a>Read more</a></div>
        </div>
        <div class="related-single open-subpeek" data-index="175">
          <div class="single-img"> <img src="//www.messiah.edu/images/Statistics_Thumbnail.png">
           </div>
           <div class="info">
              <h4>Statistics</h4>
                <span class="minor"><span class="badge"></span></span>
           </div>
             <div class="read-more"> <a>Read more</a>
                 </div>
                 </div>
               </div>
              </div>
              <div id="related-nav" class="related-nav" style="">
                  <a id="peek-nav-prev" class="peek-nav-button" ><img src="<?php echo $folder; ?>img/programs/peek-prev.png" /></a>
                  <a id="peek-nav-next" class="peek-nav-button" ><img src="<?php echo $folder; ?>img/programs/peek-next.png" /></a>
              </div>
                  </div>


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

<?php if ($programsPage) { ?>
<script id="autocomplete-template" type="text/x-jQuery-tmpl">
    <div id="autocomplete-item-${id}" class="auto-suggest" data-keyword="${keyword}"><span>${selection}</span>${rest}</div>
</script>
<?php } ?>

<script id="peek-template" type="text/x-jQuery-tmpl">
    <div class="peek">
        <div id="peek-close" class="peek-close">
            <img src="<?php echo $folder; ?>img/programs/peek-close.png">
        </div>
        <div class="peek-img">
            {{if thumbnail_peek != '' }}
            <img id="peek-large-image" src="//www.messiah.edu/images/${thumbnail_peek}">
            {{/if}}
        </div>
        <div class="peek-content">
            <h2 class="peek-title">${program_name}
                {{each degree_types}}
                <span class="degree-type">${$value.name}</span>
                {{/each}}
            </h2>
            {{each categoryNames}}
            <h3 class="peek-subtitle"><span class="peek-ball" style="display: none;"></span><span id="peek-category">Department of ${$value}</span></h3>
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
            <p id="peek-overview">${program_peek}</p>
            {{if career_options != '' }}
            <div class="options-box">
                <h3>Career Options</h3>
                <div id="peek-career-options">
                    <ul>
                    {{each careerOptionsArray}}<li>${$value}</li>{{/each}}
                    </ul>
                </div>
            </div>
            {{/if}}
            <a class="peek-button" href="${program_url}">Visit Program Page</a>
        </div>
        <div id="peek-related" class="peek-related" style="display: none">
            <h3 class="peek-subtitle">Programs related to</h3>
            <h2 class="peek-title">${program_name}</h2>
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
    <div id="subpeek-overlay" class="subpeek-overlay" style="display:none">
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
            {{if ((grad_concentration == 'Yes') || (grad_concentration == 'yes')) }}<span class="grad-c"><span class="badge"></span></span>{{/if}}
            {{if ((grad_track == 'Yes') || (grad_track == 'yes')) }}<span class="grad-t"><span class="badge"></span></span>{{/if}}
            {{if ((grad_pa_teaching_certification == 'Yes') || (grad_pa_teaching_certification == 'yes')) }}<span class="grad-p"><span class="badge"></span></span>{{/if}}
            {{if ((grad_grad_certificate == 'Yes') || (grad_grad_certificate == 'yes')) }}<span class="grad-g"><span class="badge"></span></span>{{/if}}
            {{if ((grad_nondegree == 'Yes') || (grad_nondegree == 'yes')) }}<span class="grad-n"><span class="badge"></span></span>{{/if}}
            {{if ((grad_certificate_in_advanced_graduate_studies == 'Yes') || (grad_certificate_in_advanced_graduate_studies == 'yes')) }}<span class="grad-a"><span class="badge"></span></span>{{/if}}
        </div>
        <div class="read-more">
            <a>Read more</a>
        </div>
    </div>
</script>

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
<script type="text/javascript" src="<?php echo $folder; ?>mc-programs.js?v=<?php echo $version; ?>"></script>
