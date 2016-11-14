jQuery(document).ready(function() 
    { 
        jQuery("#WPCM_schedule_table").tablesorter({ sortList: [[0,0]], headers: { 0: {sorter:"text"} }});

        
        jQuery( "#WPCM_schedule_details_close_button" ).on( "click", function() {
            jQuery("#WPCM_schedule_details").hide("fast");
        });

        jQuery( "#WPCM_schedule_table tr" ).on( "click", function() {
            jQuery("#WPCM_schedule_details_title").html(jQuery(this).data("eventcoursetitle"));
            jQuery("#WPCM_schedule_details_descr p").html(jQuery(this).data("eventcoursedescr"));
            jQuery("#WPCM_schedule_details_place p").html(jQuery(this).data("eventcity") + ", " + jQuery(this).data("eventvenue"));
            jQuery("#WPCM_schedule_details_date p").html(jQuery(this).data("eventdate"));
            jQuery("#WPCM_schedule_details_more_info p a").attr("href", jQuery(this).data("eventurl"));
            jQuery("#WPCM_schedule_details_register p a").attr("href", jQuery(this).data("registrationurl"))

            jQuery("#WPCM_schedule_details").show();
            jQuery("#WPCM_schedule_details").css("top", 20);

            var scrollTop = jQuery(document).scrollTop();
            var boxTop = jQuery("#WPCM_schedule_details").offset();
            var boxPosition = jQuery("#WPCM_schedule_details").position();

            var newTop = scrollTop - boxTop.top + boxPosition.top*2;

            if (+scrollTop >= +boxTop.top) {
                //alert("box should be moved!\n scroll: " + scrollTop + "\n boxen från toppen: " + boxTop.top + "\n boxens position.top: " + boxPosition.top + "\n boxens nya position.top: " + newTop);
                jQuery("#WPCM_schedule_details").css("top", newTop);

            }
            //else {
                //jQuery("#WPCM_schedule_details").css("top", 20);
                //alert("scroll: " + scrollTop + "\n boxen från toppen: " + boxTop.top + "\n boxens position.top: " + boxPosition.top );
            //}


        });


    } 
); 