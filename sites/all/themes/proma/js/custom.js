(function($) {


    function is_touch_device() {
        return !!('ontouchstart' in window);
    }


    /*==================================================
   DROPDOWN MENU
   ==================================================*/
    jQuery(document).ready(function($) {
        $('ul.sf-menu').superfish({
            delay: 100, // one second delay on mouseout 
            animation: {
                opacity: 'show', 
                height: 'show'
            }, // fade-in and slide-down animation 
            speed: 'fast', // faster animation speed 
            autoArrows: false                           // disable generation of arrow mark-up 
        });
    });


    jQuery(document).ready(function() {

        //Add Class Js to html
        jQuery('html').addClass('js');

        //=================================== MENU ===================================//
        jQuery("ul.sf-menu").supersubs({
            minWidth: 12, // requires em unit.
            maxWidth: 12, // requires em unit.
            extraWidth: 3	// extra width can ensure lines don't sometimes turn over due to slight browser differences in how they round-off values
        // due to slight rounding differences and font-family 
        }).superfish();  // call supersubs first, then superfish, so that subs are 
    // not display:none when measuring. Call before initialising 
    // containing tabs for same reason. 



    });
    /*==================================================
   PORTFOLIO IMAGE HOVER
   ==================================================*/
    $(window).load(function() {

        $(".portfolio-grid ul li .item-info-overlay").hide();

        if (is_touch_device()) {
            $(".portfolio-grid ul li").click(function() {

                var count_before = $(this).closest("li").prevAll("li").length;

                var this_opacity = $(this).find(".item-info-overlay").css("opacity");
                var this_display = $(this).find(".item-info-overlay").css("display");


                if ((this_opacity == 0) || (this_display == "none")) {
                    $(this).find(".item-info-overlay").fadeTo(250, 0.8);
                } else {
                    $(this).find(".item-info-overlay").fadeTo(250, 0);
                }

                $(this).closest("ul").find("li:lt(" + count_before + ") .item-info-overlay").fadeTo(250, 0);
                $(this).closest("ul").find("li:gt(" + count_before + ") .item-info-overlay").fadeTo(250, 0);

            });

        }
        else {
            $(".portfolio-grid ul li").hover(function() {
                $(this).find(".item-info-overlay").fadeTo(250, 0.8);
            }, function() {
                $(this).find(".item-info-overlay").fadeTo(250, 0);
            });

        }
    });

    $(window).load(function() {

        $(".item-info").each(function(i) {
            $(this).next().prepend($(this).html())
        });
    });

    /*==================================================
   PREETY PHOTO
   ==================================================*/
    $(window).load(function() {

        $('a[data-rel]').each(function() {
            $(this).attr('rel', $(this).data('rel'));
        });

        $("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'fast', /* fast/slow/normal */
            slideshow: 5000, /* false OR interval time in ms */
            autoplay_slideshow: false, /* true/false */
            opacity: 0.50, /* Value between 0 and 1 */
            show_title: false, /* true/false */
            allow_resize: true, /* Resize the photos bigger than viewport. true/false */
            default_width: 500,
            default_height: 344,
            counter_separator_label: '#', /* The separator for the gallery counter 1 "of" 2 */
            theme: 'light_square', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            horizontal_padding: 20,
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: true, /* Automatically start videos: True/False */
            modal: false, /* If set to true, only the close button will close the window */
            overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
            deeplinking: false,
        });
    });
    /*==================================================
   SLIDING GRAPH
   ==================================================*/
    jQuery(document).ready(function($) {

        function isScrolledIntoView(id)
        {
            var elem = "#" + id;
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();

            if ($(elem).length > 0) {
                var elemTop = $(elem).offset().top;
                var elemBottom = elemTop + $(elem).height();
            }

            return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom)
                && (elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        }

        function sliding_horizontal_graph(id, speed) {
            //alert(id);
            $("#" + id + " li span").each(function(i) {
                var j = i + 1;
                var cur_li = $("#" + id + " li:nth-child(" + j + ") span");
                var w = cur_li.attr("class");
                cur_li.animate({
                    width: w + "%"
                }, speed);
            })
        }

        function graph_init(id, speed) {
            $(window).scroll(function() {
                if (isScrolledIntoView(id)) {
                    sliding_horizontal_graph(id, speed);
                }
                else {
                //$("#" + id + " li span").css("width", "0");
                }
            })

            if (isScrolledIntoView(id)) {
                sliding_horizontal_graph(id, speed);
            }
        }

        graph_init("example-1", 1000);
        graph_init("example-2", 1000);


    });
    /*==================================================
   BACK TO TOP BUTTON
   ==================================================*/
    jQuery(function() {
        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() != 0) {
                jQuery('#toTop').fadeIn();
            } else {
                jQuery('#toTop').fadeOut();
            }
        });
        jQuery('#toTop').click(function() {
            jQuery('body,html').animate({
                scrollTop: 0
            }, 800);
        });
    });
    /*==================================================
   CONTENT TABS
   ==================================================*/

    $(document).ready(function(){
        (function() {

            var $tabsNav = $('.tabs-nav'),
            $tabsNavLis = $tabsNav.children('li'),
            $tabContent = $('.tab-content');

            $tabContent.hide();
            $tabsNavLis.first().addClass('active').show();
            $tabContent.first().show();

            $tabsNavLis.click(function(e){
                var $this = $(this);

                $tabsNavLis.removeClass('active');
                $this.addClass('active');
                $tabContent.hide();

                $($this.find('a').attr('href')).fadeIn();

                e.preventDefault();
                
            });

        })();
    });

})(jQuery);


