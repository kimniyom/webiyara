'use strict';
$(document).ready(function() {
    var tpj = jQuery;
    var revapi8;
    tpj(document).ready(function() {
        if (tpj("#slider_1").revolution == undefined) {
            revslider_showDoubleJqueryError("#slider_1");
        } else {

            revapi8 = tpj("#slider_1").show().revolution({

                sliderType: "standard",
                jsFileLocation: "../../revolution/js/",
                sliderLayout: "fullscreen",
                fullScreenOffsetContainer: "header.header-style-3",
                delay: 9000,
                navigation: {
                    arrows: { enable: true },
                    bullets: { enable: false },
                },
                parallax: {
                    type: "mouse",
                    origo: "slidercenter",
                    speed: 2000,
                    levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50],
                },

                /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
                responsiveLevels: [1240, 1024, 778],
                /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
                gridwidth: [1240, 1024, 778, 480],
                /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
                gridheight: [745, 745, 745, 300],
                /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
                visibilityLevels: [1240, 1024, 1024, 480],

            });
        }
    }); /*ready*/
});