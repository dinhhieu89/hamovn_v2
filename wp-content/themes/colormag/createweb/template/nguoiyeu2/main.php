<?php
$_data = getWebDataFromRequest();
$images = unserialize($_data->background);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo '(¯`·.º-:¦:- Website được làm bởi ' . $_data->send_by . ' gửi tặng đến ' . $_data->receiver . ' -:¦:-º.·´¯)  ' ?></title>
    <meta charset=utf-8>
    <meta name="description" content="<?php echo '(¯`·.º-:¦:- Website do ' . $_data->send_by . ' gửi tặng đến ' . $_data->receiver . ' -:¦:-º.·´¯)' ?>"/>
    <meta name="keywords" content="<?php echo '(¯`·.º-:¦:- Website do ' . $_data->send_by . ' gửi tặng đến ' . $_data->receiver . ' -:¦:-º.·´¯)' ?>"/>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() . '/createweb/template/nguoiyeu2/images/favicon.ico' ?>" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . '/createweb/template/nguoiyeu2/css/style.css' ?>"/>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Astloch:regular,bold' rel='stylesheet' type='text/css'/>
    <link type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . '/createweb/template/nguoiyeu2/css/jquery.jscrollpane.css' ?>"
          rel="stylesheet" media="all"/>
    <script language="javascript">
        var txt = "<?php echo '(¯`·.º-:¦:- Website được làm bởi ' . $_data->send_by . ' gửi tặng đến ' . $_data->receiver . ' -:¦:-º.·´¯)' ?>";
        var espera = 500;
        var refresco = null;
        function rotulo_title() {
            document.title = txt;
            txt = txt.substring(1, txt.length) + txt.charAt(0);
            refresco = setTimeout("rotulo_title()", espera);
        }
        rotulo_title();
    </script>
</head>
<body>

<div id="mb_background" class="mb_background">
    <?php
        if (count($images) <= 0) {
            $_defaulBg = get_stylesheet_directory_uri() . '/createweb/template/nguoiyeu2/images/default2.jpg';
        } else {
            $_defaulBg = wp_upload_dir()['baseurl'] . '/' . $images[0];
        }
    ?>
    <img class="mb_bgimage"
         src="<?php echo $_defaulBg ?>"
         alt="Background"/>
    <div class="mb_overlay">
        <div id="nhac-container">
            <a href="javascript: void(0);" onclick="togglePlayAudio($(this))" class="nhac-control hide">
                Bật/Tắt Nhạc
            </a>
            <div class="nhac-wrapper">
                <?php
                    if ($_data->music_link != ''):
                        echo htmlspecialchars_decode($_data->music_link);
                    else:
                ?>
                    <iframe scrolling="no" width="650" height="330" src="http://mp3.zing.vn/embed/playlist/ZWZCW8FO?start=true" frameborder="0" allowfullscreen="true"></iframe>
                <?php endif; //END if ($_data->music_link != '') ?>
            </div>
        </div>
    </div>
    <div class="mb_loading"></div>
</div>
<div id="mb_pattern" class="mb_pattern"></div>
<div class="mb_heading">
    <h1>Love You Forever...!</h1>
</div>
<div class="mb_title">
    <marquee direction="left" scrollamount="2" onmouseout="this.start()" onmouseover="this.stop()" >
        <h3 style="color: deeppink"><?php echo $_data->title ?></h3>
    </marquee>
</div>
<div id="mb_menu" class="mb_menu">
    <a href="#" data-speed="1000" data-easing="easeOutBack">Message</a>
    <a href="#" data-speed="1000" data-easing="easeInExpo">Album</a>
    <a href="#" data-speed="1000" data-easing="easeOutBack">Video</a>
</div>
<div id="mb_content_wrapper" class="mb_content_wrapper">
    <span class="mb_close"></span>

    <div class="mb_content">
        <h2>Message</h2>

        <div class="mb_content_inner">
            <p><?php echo $_data->message ?></p>
        </div>
    </div>
    <div class="mb_content">
        <h2>Album</h2>
        <p style="font-family: 'Tahoma', Arial, sans-serif;">Bấm vào ảnh để xem kích thước lớn hơn.</p>
        <div class="mb_content_inner">
            <?php if (count($images) > 0): ?>
            <ul id="mb_imagelist" class="mb_imagelist">
                <?php foreach($images as $key=>$img): ?>
                <li>
                    <img
                        style="width: 95%; height: 95%;"
                        src="<?php echo wp_upload_dir()['baseurl'] . '/' . $img ?>"
                        alt="<?php echo $_data->send_by . ' for ' . $_data->receiver ?>"
                        data-bgimg="<?php echo wp_upload_dir()['baseurl'] . '/' . $img ?>"/>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; //End if (count($images) > 0) ?>
        </div>
    </div>
    <div class="mb_content">
        <h2>Video</h2>
        <div id="video-container" class="mb_content_inner">
            <?php
            if ($_data->video_link != ''):
                echo htmlspecialchars_decode($_data->video_link);
            else:
            ?>
            <iframe width="340" height="335" src="https://www.youtube.com/embed/tUAdmHA029A" frameborder="0" allowfullscreen></iframe>
            <?php endif; //END if ($_data->video_link != '')  ?>
        </div>
    </div>
</div>
<div class="mb_footer">
    <a href="http://hamo.vn/" target="_blank">Copyright hamo.vn @2016</a>
</div>
<!-- The JavaScript -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript"
        src="<?php echo get_stylesheet_directory_uri() . '/createweb/template/nguoiyeu2/js/jquery.easing.1.3.js' ?>"></script>
<!-- the mousewheel plugin - optional to provide mousewheel support -->
<script type="text/javascript"
        src="<?php echo get_stylesheet_directory_uri() . '/createweb/template/nguoiyeu2/js/jquery.mousewheel.js' ?>"></script>
<!-- the jScrollPane script -->
<script type="text/javascript"
        src="<?php echo get_stylesheet_directory_uri() . '/createweb/template/nguoiyeu2/js/jquery.jscrollpane.min.js' ?>"></script>
<script type="text/javascript"
        src="<?php echo get_stylesheet_directory_uri() . '/createweb/template/nguoiyeu2/js/jquery.transform-0.9.3.min_.js' ?>"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function () {
    var $menu = $('#mb_menu'),
        $menuItems = $menu.children('a'),
        $mbWrapper = $('#mb_content_wrapper'),
        $mbClose = $mbWrapper.children('.mb_close'),
        $mbContentItems = $mbWrapper.children('.mb_content'),
        $mbContentInnerItems = $mbContentItems.children('.mb_content_inner');
        $mbPattern = $('#mb_pattern'),
        $works = $('#mb_imagelist > li'),
        $mb_bgimage = $('#mb_background > img'),

        Menu = (function () {

            var init = function () {
                    preloadImages();
                    initPlugins();
                    initPattern();
                    initEventsHandler();
                },
            //preloads the images for the work area (data-bgimg attr)
                preloadImages = function () {
                    $works.each(function (i) {
                        $('<img/>').attr('src', $(this).children('img').data('bgimg'));
                    });
                },
            //initialise the jScollPane (scroll plugin)
                initPlugins = function () {
                    $mbContentInnerItems.jScrollPane({
                        verticalDragMinHeight: 40,
                        verticalDragMaxHeight: 40
                    });
                },
            /*
             draws 16 boxes on a specific area of the page.
             we randomly calculate the top, left, and rotation angle for each one of them
             */
                initPattern = function () {
                    for (var i = 0; i < 16; ++i) {
                        //random opacity, top, left and angle
                        var o = 0.1,
                            t = Math.floor(Math.random() * 196) + 5, // between 5 and 200
                            l = Math.floor(Math.random() * 696) + 5, // between 5 and 700
                            a = Math.floor(Math.random() * 101) - 50; // between -50 and 50

                        $el = $('<div>').css({
                            opacity: o,
                            top: t + 'px',
                            left: l + 'px'
                        });

                        if (!$.browser.msie)
                            $el.transform({'rotate': a + 'deg'});

                        $el.appendTo($mbPattern);
                    }
                    $mbPattern.children().draggable(); //just for fun
                },
            /*
             when the User closes a content item, we move the boxes back to the original place,
             with new random values for top, left and angle though
             */
                disperse = function () {
                    $mbPattern.children().each(function (i) {
                        //random opacity, top, left and angle
                        var o = 0.1,
                            t = Math.floor(Math.random() * 196) + 5, // between 5 and 200
                            l = Math.floor(Math.random() * 696) + 5, // between 5 and 700
                            a = Math.floor(Math.random() * 101) - 50; // between -50 and 50
                        $el = $(this),
                            param = {
                                width: '50px',
                                height: '50px',
                                opacity: o,
                                top: t + 'px',
                                left: l + 'px'
                            };

                        if (!$.browser.msie)
                            param.rotate = a + 'deg';

                        $el.animate(param, 1000, 'easeOutExpo');
                    });
                },
                initEventsHandler = function () {
                    /*
                     click a link in the menu
                     */
                    $menuItems.bind('click', function (e) {
                        var $this = $(this),
                            pos = $this.index(),
                            speed = $this.data('speed'),
                            easing = $this.data('easing');
                        //if an item is not yet shown
                        if (!$menu.data('open')) {
                            //if current animating return
                            if ($menu.data('moving')) return false;
                            $menu.data('moving', true);
                            $.when(openItem(pos, speed, easing)).done(function () {
                                $menu.data({
                                    open: true,
                                    moving: false
                                });
                                showContentItem(pos);
                                $mbPattern.children().fadeOut(500);
                            });
                        } else {
                            showContentItem(pos);
                        }
                        return false;
                    });

                    /*
                     click close makes the boxes animate to the top of the page
                     */
                    $mbClose.bind('click', function (e) {
                        $menu.data('open', false);
                        /*
                         if we would want to show the default image when we close:
                         changeBGImage('images/default.jpg');
                         */
                        $mbPattern.children().fadeIn(500, function () {
                            $mbContentItems.hide();
                            $mbWrapper.hide();
                        });

                        disperse();
                        return false;
                    });

                    /*
                     click an image from "Works" content item,
                     displays the image on the background
                     */
                    $works.bind('click', function (e) {
                        var source = $(this).children('img').data('bgimg');
                        changeBGImage(source);
                        return false;
                    });

                },
            /*
             changes the background image
             */
                changeBGImage = function (img) {
                    //if its the current one return
                    if ($mb_bgimage.attr('src') === img || $mb_bgimage.siblings('img').length > 0)
                        return false;

                    var $itemImage = $('<img src="' + img + '" alt="Background" class="mb_bgimage" style="display:none;"/>');
                    $itemImage.insertBefore($mb_bgimage);

                    $mb_bgimage.fadeOut(1000, function () {
                        $(this).remove();
                        $mb_bgimage = $itemImage;
                    });
                    $itemImage.fadeIn(1000);
                },
            /*
             This shows a content item when there is already one shown:
             */
                showContentItem = function (pos) {
                    $mbContentItems.hide();
                    $mbWrapper.show();
                    $mbContentItems.eq(pos).show().children('.mb_content_inner').jScrollPane();
                },
            /*
             moves the boxes from the top to the center of the page,
             and shows the respective content item
             */
                openItem = function (pos, speed, easing) {
                    return $.Deferred(
                        function (dfd) {
                            $mbPattern.children().each(function (i) {
                                var $el = $(this),
                                    param = {
                                        width: '100px',
                                        height: '100px',
                                        top: 154 + 100 * Math.floor(i / 4),
                                        left: 200 + 100 * (i % 4),
                                        opacity: 1
                                    };

                                if (!$.browser.msie)
                                    param.rotate = '0deg';

                                $el.animate(param, speed, easing, dfd.resolve);
                            });
                        }
                    ).promise();
                };

            return {
                init: init
            };

        })();

    /*
     call the init method of Menu
     */
    Menu.init();
});


function togglePlayAudio(el) {
    if (el.hasClass('hide')) {
        $('#nhac-container').animate(
            {
                'margin-right': '0px'
            },
            500
        );

        el.removeClass('hide');
        el.addClass('show');
    } else {
        $('#nhac-container').animate(
            {
                'margin-right': '-650px'
            },
            500
        );

        el.removeClass('show');
        el.addClass('hide');
    }

}

$(document).ready(function() {
    $('#video-container iframe').attr('width','340');
    $('#video-container iframe').attr('height','335');
})

</script>
<script>
    /***** Hiệu ứng Trái Tim Rơi *****/
    if (typeof $pdj == 'undefined') {
        document.write('<' + 'script');
        document.write(' language="javascript"');
        document.write(' type="text/javascript"');
        document.write(' src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">');
        document.write('</' + 'script' + '>')
    }</script>
<script>if (typeof $pdj == 'undefined') {
        var $pdj = jQuery.noConflict()
    }
    if (!image_urls) {
        var image_urls = Array()
    }
    if (!flash_urls) {
        var flash_urls = Array()
    }
    image_urls['corazon'] = "<?php echo get_stylesheet_directory_uri() . '/createweb/template/nguoiyeu2/images/heart.png' ?>";
    $pdj(document).ready(function () {
        var c = $pdj(window).width();
        var d = $pdj(window).height();
        var e = function (a, b) {
            return Math.round(a + (Math.random() * (b - a)))
        };
        var f = function (a) {
            setTimeout(function () {
                a.css({left: e(0, c) + 'px', top: '-30px', display: 'block', opacity: '0.' + e(10, 100)}).animate({top: (d - 10) + 'px'}, e(8500, 10000), function () {
                    $pdj(this).fadeOut('slow', function () {
                        f(a)
                    })
                })
            }, e(1, 9000))
        };
        $pdj('<div></div>').attr('id', 'corazonDiv').css({position: 'fixed', width: (c - 20) + 'px', height: '1px', left: '0px', top: '-5px', display: 'block'}).appendTo('body');
        for (var i = 1; i <= 15; i++) {
            var g = $pdj('<img/>').attr('src', image_urls['corazon']).css({position: 'absolute', left: e(0, c) + 'px', top: '-30px', display: 'block', opacity: '0.' + e(10, 100), 'margin-left': 0}).addClass('corazonDrop').appendTo('#corazonDiv');
            f(g);
            g = null
        }
        ;
        var h = 0;
        var j = 0;
        $pdj(window).resize(function () {
            c = $pdj(window).width();
            d = $pdj(window).height()
        })
    });
</script>
</body>
</html>