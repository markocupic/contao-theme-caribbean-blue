if (navigator.appVersion.indexOf("MSIE 9.") !== -1) {
    alert('Diese Webseite verwendet Technologien, die von älteren Browsern nicht unterstützt werden. Deswegen kann es sein, dass das Layout nicht optimal dargestellt wird. Sie verwenden Internet Explorer 9. Aktualisieren Sie Ihren Microsoft-Browser mindestens auf Version 11 oder nutzen Sie die aktuellen Versionen von Safari, Firefox, Opera oder Google Chrome. Besten Dank für Ihr Verständnis.')
}
// Load resources
(function ($) {
    $().ready(function () {
        new WOW().init();
    });
})(jQuery);


/** Scroll to top button **/
(function ($) {
    $().ready(function () {
        $('body').append('<div class="scroll-to-top"><a href="#"><span class="fa fa-chevron-up"></span></a></div>');

        //Check to see if the window is top if not then display button
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 100) {
                $('.scroll-to-top').fadeIn();
            } else {
                $('.scroll-to-top').fadeOut();
            }
        });

        //Click event to scroll to top
        $('.scroll-to-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });
    });
})(jQuery);


/** shorten download links **/

(function ($) {
    $().ready(function () {
        if (window.screen.width < 800) {
            var maxStringLength = 18;

        } else {
            maxStringLength = 40;
        }
        var classes = ['.ce_downloads a', '.ce_download a'];
        $.each(classes, function (index, strClass) {
            $(strClass).each(function (index, el) {
                var strFilename = el.innerHTML;
                var match = strFilename.match(/(.*)\<span(.*)/);
                if (match) {
                    var filename = match[1];
                    if (filename.length > maxStringLength) {
                        var filenameShortened = filename.substring(0, maxStringLength) + ' … ';
                        //el.innerHTML = filenameShortened + '<span' + match[2];
                    }
                }
            });
        });
    });
})(jQuery);
