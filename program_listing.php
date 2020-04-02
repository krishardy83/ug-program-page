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

<div class="editor">
    <div id="full-view">
        <input type="hidden" id="mc-page-id" value="<?php echo $pageId; ?>">
        <input type="hidden" id="mc-category-id" value="<?php echo $categoryId; ?>">
        <h2>Majors, Minors and Programs</h2>
        <?php if ($programsPage) { ?>
        <div class="search-box">
            <p class="desktop">
                <strong>We can help you find the right major.</strong>
                Search by keywords or interests to explore which of Messiah's 85+ academic programs would be a good fit for you.
            </p>
            <p class="mobile">Search by keywords or interests:</p>

            <div id="search-input" class="search-input">
                <div id="search-panel" class="block ie-fix search-panel" style="display:none">
                    <input id="show-search" class="show-search txt" type="text" name="program_search" value="" autocomplete="off">

                    <!--
                    <div id="auto-complete" class="search-suggest" unselectable="on"></div>

                    <input class="txt" type="text" id="program_search" name="program_search" value="" autocomplete="off">
                    <input class="btn-submit ie-fix xscroll_anchor" type="submit" value="go" id="go">

                    <input type="hidden" name="ga_count" value="1"><input type="hidden" name="ga_id" value="259d568a-d302-48b8-ad94-af8ae98d1820">
                    <input class="btn-cancel" type="submit" value="x" id="cancel-search" style="display:none">

                    <div class="auto-suggest-panel" style="display:none">
                        <div class="sugg-info">
                            <p>Suggested search terms:</p>
                        </div>
                        <div class="auto-suggest-items">
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>

        <div class="mobile-interests">
            <p>Area of Interest:</p>
            <select class="area-of-interest">
                <option value="" selected>All</option>
                <option value="314">Art / Performing Arts</option>
                <option value="315">Business / Leadership</option>
                <option value="316">Communication / Media</option>
                <option value="317">Education</option>
                <option value="333">Engineering</option>
                <option value="318">Finance / Mathematics</option>
                <option value="319">Government / Law</option>
                <option value="320">Health / Medicine</option>
                <option value="321">Higher Education</option>
                <option value="322">History</option>
                <option value="323">Information Technology</option>
                <option value="324">Language / Culture</option>
                <option value="325">Ministry</option>
                <option value="326">Music</option>
                <option value="327">Outdoors</option>
                <option value="328">Religion</option>
                <option value="329">Science</option>
                <option value="330">Social Sciences</option>
                <option value="331">Sustainability</option>
                <option value="332">Undecided</option>
            </select>
        </div>
        <?php } ?>
        <div>
            <?php if ($programsPage) { ?>
            <ul class="alphabet-list">
                <li><span id="A" class="scroll-anchor">A</span></li>
                <li><span id="B" class="scroll-anchor">B</span></li>
                <li><span id="C" class="scroll-anchor">C</span></li>
                <li><span id="D" class="scroll-anchor">D</span></li>
                <li><span id="E" class="scroll-anchor">E</span></li>
                <li><span id="F" class="scroll-anchor">F</span></li>
                <li><span id="G" class="scroll-anchor">G</span></li>
                <li><span id="H" class="scroll-anchor">H</span></li>
                <li><span id="I" class="scroll-anchor">I</span></li>
                <li><span id="J" class="scroll-anchor">J</span></li>
                <li><span id="K" class="scroll-anchor">K</span></li>
                <li><span id="L" class="scroll-anchor">L</span></li>
                <li><span id="M" class="scroll-anchor">M</span></li>
                <li><span id="N" class="scroll-anchor">N</span></li>
                <li><span id="O" class="scroll-anchor">O</span></li>
                <li><span id="P" class="scroll-anchor">P</span></li>
                <li><span id="Q" class="scroll-anchor">Q</span></li>
                <li><span id="R" class="scroll-anchor">R</span></li>
                <li><span id="S" class="scroll-anchor">S</span></li>
                <li><span id="T" class="scroll-anchor">T</span></li>
                <li><span id="U" class="scroll-anchor">U</span></li>
                <li><span id="V" class="scroll-anchor">V</span></li>
                <li><span id="W" class="scroll-anchor">W</span></li>
                <li><span id="X" class="scroll-anchor">X</span></li>
                <li><span id="Y" class="scroll-anchor">Y</span></li>
                <li><span id="Z" class="scroll-anchor">Z</span></li>
            </ul>
            <?php } ?>

            <table class="program-table">
                <?php if ($programsPage) { ?>
                <thead>
                    <td class="tabs" colspan="7">
                        <a href="index.php"><span id="undergraduate" class="tab">Undergraduate Programs</span></a>
                        <a href="//www.messiah.edu/info/20436/degrees"><span id="graduate" class="tab">Graduate Programs</span></a>
                        <span class="view-buttons">
                            <span class="view-title">Group concentrations<br>by major</span>
                            <span class="collapse-view active"></span>
                            <span class="expand-view"></span>
                        </span>
                    </td>
                </thead>
                <?php } ?>
                <tbody>
                    <div class="sub-heading">
                    </div>
                    <tr class="filters">
                        <td colspan="7" class="undergraduate-filters" style="display:none">
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> major" data-filter="major"><span class="badge"></span> MAJOR</span>
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> minor" data-filter="minor"><span class="badge"></span> MINOR</span>
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> concentration" data-filter="concentration"><span class="badge"></span> CONCENTRATION</span>
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> prepro" data-filter="prepro"><span class="badge"></span> PRE-HEALTH ADVISING</span>
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> dual-degree" data-filter="dual"><span class="badge"></span> 3+ PARTNER PROGRAMS</span>
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> teaching" data-filter="teaching"><span class="badge"></span> TEACHING CERTIFICATE</span>
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> accelerated" data-filter="accelerated"><span class="badge"></span> ACCELERATED</span>
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> assurance" data-filter="assurance"><span class="badge"></span> EARLY ASSURANCE</span>
<span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> ug-certificate" data-filter="ug-certificate"><span class="badge"></span> UNDERGRAD CERTIFICATE</span>
                            <?php if ($programsPage) { ?>
                            <span class="cursor-pointer reset-filter" style="display:none"></span>
                            <?php } ?>
                        </td>
                        <td colspan="7" class="graduate-filters" style="display:none">
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> grad-c" data-filter="grad-c"><span class="badge"></span> CONCENTRATION</span>
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> grad-t" data-filter="grad-t"><span class="badge"></span> TRACK</span>
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> grad-p" data-filter="grad-p"><span class="badge"></span> PA TEACHING CERTIFICATION</span>
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> grad-g" data-filter="grad-g"><span class="badge"></span> GRADUATE CERTIFICATE</span>
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> grad-n" data-filter="grad-n"><span class="badge"></span> NON-DEGREE</span>
                            <span class="filter <?php if ($programsPage) { ?>filter-programs cursor-pointer<?php } ?> grad-a" data-filter="grad-a"><span class="badge"></span> CERTIFICATE IN ADVANCED GRADUATE STUDIES</span>
                            <?php if ($programsPage) { ?>
                            <span class="cursor-pointer reset-filter" style="display:none"></span>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php if ($programsPage) { ?>
                    <tr class="note">
                        <td colspan="7">*click an icon above to filter the list
                        <div class="prg-icons">
                          <span class="filter-programs cursor-pointer prg-online" data-filter="grad-online">Online</span>
                          <span class="filter-programs cursor-pointer prg-hybrid" data-filter="grad-hybrid">Hybrid</span>
                          <span class="filter-programs cursor-pointer prg-campus" data-filter="grad-campus">Campus</span>
                        </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr id="loading">
                        <td colspan="7">Loading...</td>
                    </tr>
                </tbody>
            </table>
            <?php if ($programsPage) { ?>
            <table id="collapsed" class="program-table">
                 <thead>
                 </thead>
                 <tbody>
                 </tbody>
            </table>
            <?php } ?>
            <table id="expanded" class="program-table" style="display:none">
                 <thead>
                 </thead>
                 <tbody>
                 </tbody>
            </table>
        </div>
    </div>

    <div id="search-view" style="display:none">
        <div class="no-search-results">
            <div class="sorry">
                <h2>Please try again</h2>
                <p>SEARCH TIP: Try using interest keywords like accounting or mathematics than a
                potential job title (accountant) to find more programs! And remember, you can always
                visit a full list of our <a href="//www.messiah.edu/majors-minors-programs">undergraduate programs</a>
                 and <a href="//www.messiah.edu/info/20436/degrees">graduate programs</a>.</p>
            </div>
        </div>

        <div class="search-results">
            <h2 id="search-results-tab"></h2>
            Based on your search, we think you might be interested in the programs listed below.
            <table class="program-table">
                <thead>
                </thead>
                <tbody>
                    <tr class="filters">
                        <td colspan="7" class="undergraduate-filters" style="display:none">
                            <span class="filter major"><span class="badge"></span> MAJOR</span>
                            <span class="filter minor"><span class="badge"></span> MINOR</span>
                            <span class="filter concentration"><span class="badge"></span> CONCENTRATION</span>
                            <span class="filter prepro"><span class="badge"></span> PRE-HEALTH ADVISING</span>
                            <span class="filter dual-degree"><span class="badge"></span> 3+ PARTNER PROGRAMS</span>
                            <span class="filter teaching"><span class="badge"></span> TEACHING CERTIFICATE</span>
                        </td>
                        <td colspan="7" class="graduate-filters" style="display:none">
                            <span class="filter grad-c"><span class="badge"></span> CONCENTRATION</span>
                            <span class="filter grad-t"><span class="badge"></span> TRACK</span>
                            <span class="filter grad-p"><span class="badge"></span> PA TEACHING CERTIFICATION</span>
                            <span class="filter grad-g"><span class="badge"></span> GRADUATE CERTIFICATE</span>
                            <span class="filter grad-n"><span class="badge"></span> NON-DEGREE</span>
                            <span class="filter grad-a"><span class="badge"></span> CERTIFICATE IN ADVANCED GRADUATE STUDIES</span>
                        </td>
                    </tr>
                <tbody>
                </tbody>
            </table>
            <div class="search-result-programs">
                <h3><span id="programs-term"></span> programs</h3>
                <table id="search-programs-table" class="program-table">
                     <thead>
                     </thead>
                     <tbody>
                     </tbody>
                </table>
            </div>

            <div class="search-result-related">
                <h3>Programs related to <span id="related-term"></span></h3>
                <table id="search-related-table" class="program-table">
                     <thead>
                     </thead>
                     <tbody>
                     </tbody>
                </table>
            </div>

        </div>

        <div class="search-box bottom">
              <p class="intro"><span>Didn't find exactly what you were looking for?</span> Try another related keyword, or another format of that keyword, and search again. With more than 80 majors, minors and concentrations, it's likely we have a program of interest to you!</p>

              <div id="search-result-input">
              </div>

              <div class="btn-info cursor-pointer close-search">
                  <span>View a full list of majors and minors</span>
              </div>
        </div>

    </div>
</div>

<div id="components">
  <?php if ($programsPage) { ?>
  <!-- STICKY BAR -->
  <div id="sticky-bar" style="display:none">
      <div class="sticky-bar-content">
          <div class="filters">
              <div class="undergraduate-filters" style="display:none">
                  <span class="filter major"><span class="badge"></span> MAJOR</span>
                  <span class="filter minor"><span class="badge"></span> MINOR</span>
                  <span class="filter concentration"><span class="badge"></span> CONCENTRATION</span>
                  <span class="filter prepro"><span class="badge"></span> PRE-HEALTH ADVISING</span>
                  <span class="filter dual-degree"><span class="badge"></span> 3+ PARTNER PROGRAMS</span>
                  <span class="filter teaching"><span class="badge"></span> TEACHING CERTIFICATE</span>
              </div>
              <div class="graduate-filters" style="display:none">
                  <span class="filter grad-c"><span class="badge"></span> CONCENTRATION</span>
                  <span class="filter grad-t"><span class="badge"></span> TRACK</span>
                  <span class="filter grad-p"><span class="badge"></span> PA TEACHING CERTIFICATION</span>
                  <span class="filter grad-g"><span class="badge"></span> GRADUATE CERTIFICATE</span>
                  <span class="filter grad-n"><span class="badge"></span> NON-DEGREE</span>
                  <span class="filter grad-a"><span class="badge"></span> CERTIFICATE IN ADVANCED GRADUATE STUDIES</span>
              </div>
          </div>
      </div>
  </div>

  <div id="sticky-search" style="display:none">
      <div class="sticky-bar-content">
          <div class="search-input">
              <div class="block ie-fix search-panel" style="display:none">
                  <input id="show-sticky-search" class="show-search txt" type="text" name="program_search" value="" placeholder="Search by program name or interest" autocomplete="off">
              </div>
          </div>
      </div>
  </div>
  <!-- STICKY BAR END-->
  <?php } ?>

  <!-- TOOLTIP START -->
  <div id="tooltip" class="tooltip" style="display: none;">
      <h5 class="tooltip-title"></h5>
      <p class="tooltip-text"></p>
      <div class="tip-pointer"></div>
  </div>
  <!-- TOOLTIP END -->

  <?php if ($programsPage) { ?>
  <!-- search-box START -->
  <div class="search-box full-screen" id="large-search-panel" style="display:none">
      <div class="back">
          <p>Back to programs</p>
      </div>

      <p class="title">Search by program names or interests:</p>

      <div class="block ie-fix">
          <div id="auto-complete" class="search-suggest" unselectable="on"></div>

          <input class="txt" type="text" id="program_search" name="program_search" value="" autocomplete="off">

          <input type="hidden" name="ga_count" value="1"><input type="hidden" name="ga_id" value="259d568a-d302-48b8-ad94-af8ae98d1820">
          <input class="btn-cancel" type="submit" value="x" id="cancel-search" style="display:none">

          <div class="auto-suggest-panel" style="display:none">
              <div class="sugg-info">
                  <p>Suggested search terms:</p>
              </div>
              <div class="auto-suggest-items">
              </div>
          </div>
      </div>
  </div>
  <!-- search-box END -->
  <?php } ?>

  <!-- PEEK START -->
  <div id="peek-overlay" class="peek-overlay">
  </div>
  <!-- PEEK END -->
</div>

<?php if ($programsPage) { ?>
<div class="frame interests" id="interests" style="display: none">
    <div class="info-box bg-info">
        <h5 class="sub-title color-2">Filter by your interest</h5>
        <form>
            <input class="category-filter" type="radio" name="interest" value="" checked><span class="category-filter-text">All</span><br>
            <input class="category-filter" type="radio" name="interest" value="314"><span class="category-filter-text">Art / Performing Arts</span><br>
            <input class="category-filter" type="radio" name="interest" value="315"><span class="category-filter-text">Business / Leadership</span><br>
            <input class="category-filter" type="radio" name="interest" value="316"><span class="category-filter-text">Communication / Media</span><br>
            <input class="category-filter" type="radio" name="interest" value="317"><span class="category-filter-text">Education</span><br>
            <input class="category-filter" type="radio" name="interest" value="333"><span class="category-filter-text">Engineering</span><br>
            <input class="category-filter" type="radio" name="interest" value="318"><span class="category-filter-text">Finance / Mathematics</span><br>
            <input class="category-filter" type="radio" name="interest" value="319"><span class="category-filter-text">Government / Law</span><br>
            <input class="category-filter" type="radio" name="interest" value="320"><span class="category-filter-text">Health / Medicine</span><br>
            <input class="category-filter" type="radio" name="interest" value="321"><span class="category-filter-text">Higher Education</span><br>
            <input class="category-filter" type="radio" name="interest" value="322"><span class="category-filter-text">History</span><br>
            <input class="category-filter" type="radio" name="interest" value="323"><span class="category-filter-text">Information Technology</span><br>
            <input class="category-filter" type="radio" name="interest" value="324"><span class="category-filter-text">Language / Culture</span><br>
            <input class="category-filter" type="radio" name="interest" value="325"><span class="category-filter-text">Ministry</span><br>
            <input class="category-filter" type="radio" name="interest" value="326"><span class="category-filter-text">Music</span><br>
            <input class="category-filter" type="radio" name="interest" value="327"><span class="category-filter-text">Outdoors</span><br>
            <input class="category-filter" type="radio" name="interest" value="328"><span class="category-filter-text">Religion</span><br>
            <input class="category-filter" type="radio" name="interest" value="329"><span class="category-filter-text">Science</span><br>
            <input class="category-filter" type="radio" name="interest" value="330"><span class="category-filter-text">Social Sciences</span><br>
            <input class="category-filter" type="radio" name="interest" value="331"><span class="category-filter-text">Sustainability</span><br>
            <input class="category-filter" type="radio" name="interest" value="332"><span class="category-filter-text">Undecided</span><br>
        </form>
    </div>
</div>
<?php } ?>

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
                <a id="peek-nav-next" class="peek-nav-button" ><img src="<?php echo $folder; ?>assets/img/programs/peek-next.png" /></a>
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
                <a id="subpeek-nav-next" class="peek-nav-button"><img src="<?php echo $folder; ?>assets/img/programs/peek-next.png"></a>
            </div>
        </div>
    </div>
</script>

<!-- jQuery Templates -->
<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.js"></script>
<script type="text/javascript" src="<?php echo $folder; ?>mc-programs.js?v=<?php echo $version; ?>"></script>
