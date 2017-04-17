/** Sticky footer **/
(function ($) {
    $().ready(function () {
        $($("#footer").detach()).appendTo("body");
    });
})(jQuery);

/** Animate & wow **/
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




/** Mediabox **/
(function ($) {
    $().ready(function () {

        /** Add caption to the title attribute when using colorbox **/
        $('.ce_gallery a[data-lightbox]').map(function () {
            var thumb = $(this);

            $(this).siblings('figcaption').map(function () {
                if ($(this).text() != '') {
                    thumb.attr('title', $(this).text());
                }
            });
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
                        el.innerHTML = filenameShortened + '<span' + match[2];
                    }
                }
            });
        });
    });
})(jQuery);

