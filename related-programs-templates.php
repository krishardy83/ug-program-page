    <script id="programs-template" type="text/x-jQuery-tmpl">
        <tr class="program-line-ug program-line {{if (expanded) }}expanded{{/if}}">
            <td class="name">
                {{if (sort != '') }}<a name="${sort}"></a>{{/if}} 
                <a class="program-url-ug program-url" data-index="${index}">${program_name}</a>
            </td>
        </tr>
    </script> 

    <script id="peek-template" type="text/x-jQuery-tmpl">
        <div class="_peek">
            <div id="peek-related" class="peek-related" style="display: none">
                <h3 class="peek-subtitle">Programs related to ${entry_title}</h3>
                <div class="peek-related-scroll">
                    <div id="peek-related-programs" class="related-wrap">
                    </div>
                </div>
                <div id="related-nav" class="related-nav" style="display: none">
                    <a id="peek-nav-prev" class="peek-nav-button" ><img src="<?php echo $folder; ?>images/programs-ug/peek-prev.png" /></a>
                    <a id="peek-nav-next" class="peek-nav-button" ><img src="<?php echo $folder; ?>images/programs-ug/peek-next.png" /></a>
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
                <a href="${program_url}">Read more</a>
            </div>
        </div>
    </script>                     
    
    <!-- jQuery Templates -->
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.js"></script>
    <script type="text/javascript" src="<?php echo $folder; ?>js/mc-programs-ug.js?v=<?php echo $version; ?>"></script>
