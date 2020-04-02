$(document).ready(function(){
    var directoryData;
    var pageId = $('#program-id').val();

    var url = "https://www.messiah.edu/a/cache/ug-related-programs.json";
    //var url = "ug-related-programs.json";
    $.ajax({
        url: url,
        dataType: 'json',
        success: function (data) {
            directoryData = data.items;
            for (var i = 0; i < directoryData.length; i++) {
                if (directoryData[i].live == '1') {                    
                    if (directoryData[i].entry_id == pageId)  {
                        showPeekPreview(directoryData[i]);
                        break;
                    }
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) { 
            //alert(jqXHR.resultText);
        }
    });
    
    $(document).on('click', "#peek-nav-prev", function(event) {
        peekPrev();
    });
    
    $(document).on('click', "#peek-nav-next", function(event) {
        peekNext();
    });

    $(document).on('click', ".related-single", function(event) {
      $(this).find('a').get(0).click();
    });
    
    function peekPrev() {
        var program = $("#peek-related-programs");
        var last = program.find(">:last-child");
        program.prepend(last);
    }
    
    function peekNext() {
        var program = $("#peek-related-programs");
        var first = program.find(">:first-child");
        program.append(first);
    }

    function showPeekPreview(program) {
        $("#peek-overlay").html('');
        $("#peek-template").tmpl(program).appendTo("#peek-overlay");

        var relatedProgramsStr = program.related_programs;
        var relatedProgramsArray = relatedProgramsStr.split(",");
        for (var j = 0; j < relatedProgramsArray.length; j++) {
            relatedProgramsArray[j] = relatedProgramsArray[j].trim();
        }

        var counter = 0;
        $("#peek-related-programs").html('');
        for (var i = 0; i < relatedProgramsArray.length; i++) {
            var relatedProgram = relatedProgramsArray[i];
            for (var j = 0; j < directoryData.length; j++) {
                if (directoryData[j].entry_id == relatedProgram) {
                    if (directoryData[j].live == '1') {
                        counter++;
                        $("#peek-related-programs-template").tmpl(directoryData[j]).appendTo("#peek-related-programs");
                    }
                }
            }
        }
        if (counter > 0) {
            $("#peek-related").show();
        }
        if (counter > 3) {
            $("#related-nav").show();
        }
    }
    
});
