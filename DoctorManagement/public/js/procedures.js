// Ensure dependencies are ready
$script.ready(['jQuery', 'Bootstrap'],function() {

    // Document.ready
    $(function() {
       
        var base_url = $('#base_url').text();
        // var slider = $("input.slider").slider();

        // Get the value of the option that is currently selected
        var procedure = $('#search_input').val();        
        var sort = $('#sort_by').val();
        // console.log(checked);
        
        // Define the query string
        var string = '?procedure'+ procedure;
        $('#doctors_load').load(base_url +'procedures/getdoctors', string, function() {
            $('.ajax-loader').fadeOut();
            $("[data-toggle='tooltip']").tooltip();

            /*
            $('.price').click(function() {
                $('#signin_modal').modal('show');
            });
            */
        });

        // Sort the results
        $('#sort_by').change(function() {
            var val = $(this).val();
            var procedure = $('#search_input').val();
            var location = $('#location').val();

            // If the user hasn't selected any states, then set the 'all' variable to 'everywhere'
            if(location == '' || location == ',') {
                var location = 'all';
            }

            var string = 'type='+ val +'&procedure='+ procedure +'&location='+ location +'&page=0&edu=&hosp=';
            $('#load_box').load(base_url +'search/backend', string, function() {
                $('.ajax-loader').fadeOut();
            });
        });

        
        // Show relevant search results upon keyup of input field
        $('#search_input').keyup(function(e) {
            var val = $(this).val();
            // console.log(val);

            if(e.which == 27 || val == '') {
                $('#autocomplete').slideUp('fast');
            } else {
                $('#autocomplete').slideDown('fast');
                var data = 'q='+ val;

                $('#autocomplete').load(base_url +'procedures/getprocedures', data, function() {
                    $('.list-group li').click(function() {
                        var sec_val = $(this).attr('name');
                        var new_val = $(this).text().trim();
                        $('#search_input').val(new_val);
                        $('#procedure_text').text(sec_val);
                        $('#autocomplete').slideUp();
                    });
                });
            }
        });
        // Redirect the page to the correct place upon submitting the form
        $('#search_procedures').submit(function(e) {
            e.preventDefault();            
            var procedure_input = $('#search_input').val();
            window.location = base_url +'procedures/'+ procedure_input;
        });
         
        
    });
});

// Ensure dependencies are ready
$script.ready('global', function() {
    var htmlEl = document.getElementsByTagName("html")[0];
    // Handle search form in sidebar/reveal
    var srchFormCont = $('#fixed_bar'),
        srchFormShim = $('#fixed_bar_shim'),
        srchFormReveal = $('#search-reveal'),
        srchFormSetup = function(e,size) {

            // If mobile, move search form to reveal sidebar
            if(['xxs','xs'].indexOf(size) !== -1 && srchFormShim.has(srchFormCont).length) {
                srchFormShim.hide();
                srchFormCont.appendTo(srchFormReveal);
            }
            // If not, move search form to form container
            else if(['xxs','xs'].indexOf(size) === -1 && srchFormReveal.has(srchFormCont).length) {
                srchFormCont.appendTo(srchFormShim);
                srchFormShim.show();
                // If reveal is currently visible, toggle it back off
                if(srchFormReveal.hasClass('in')) $('#search-reveal-toggle').trigger('click');
            }

            // Ensure that search box is unhidden on first run
            srchFormCont.removeClass('hidden-xs');

            // On mobile devices, make sure that html element is not scrollable while form is open
            srchFormReveal.off('.offcanvas').on('show.bs.offcanvas',function(){
                $(htmlEl).addClass('offcanvas-active');
            }).on('hidden.bs.offcanvas',function(){
                $(htmlEl).removeClass('offcanvas-active');
            });
        };

    // If mqCurrent is already set, init now
    if($(document).data('mqCurrent')) { srchFormSetup(null,$(document).data('mqCurrent')); }
    
    // Listen for mq changes and reinit
    $(document).on('mqMatch',srchFormSetup);

    // Modals must be moved outside of search-results-canvas because of
    // search form sidebar reveal's affect on zindex values
    $('#search-results-canvas').find('.modal').appendTo(document.body);
});