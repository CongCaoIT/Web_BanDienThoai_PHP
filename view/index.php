<?php
include('./includeLibrary.php');

session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Trang chủ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="phone" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Custom Theme files -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
    <!-- menu style -->
    <link href="css/ken-burns.css" rel="stylesheet" type="text/css" media="all" />
    <!-- banner slider -->
    <link href="css/animate.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all" />
    <!-- carousel slider -->
    <!-- //Custom Theme files -->
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- //js -->
    <!-- web-fonts -->
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <link href="//fonts.googleapis.com/css?family=Lovers+Quarrel" rel="stylesheet" type="text/css" />
    <link href="//fonts.googleapis.com/css?family=Offside" rel="stylesheet" type="text/css" />
    <link href="//fonts.googleapis.com/css?family=Tangerine:400,700" rel="stylesheet" type="text/css" />
    <!-- web-fonts -->
    <script src="js/owl.carousel.js"></script>
    <script>
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                autoPlay: 3000, //Set AutoPlay to 3 seconds
                items: 4,
                itemsDesktop: [640, 5],
                itemsDesktopSmall: [480, 2],
                navigation: true,
            });
        });
    </script>
    <script src="js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            // Dock the header to the top of the window when scrolled past the banner. This is the default behaviour.

            $(".header-two").scrollToFixed();
            // previous summary up the page.

            var summaries = $(".summary");
            summaries.each(function(i) {
                var summary = $(summaries[i]);
                var next = summaries[i + 1];

                summary.scrollToFixed({
                    marginTop: $(".header-two").outerHeight(true) + 10,
                    zIndex: 999,
                });
            });
        });
    </script>
    <!-- start-smooth-scrolling -->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $("html,body").animate({
                        scrollTop: $(this.hash).offset().top
                    },
                    1000
                );
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <script type="text/javascript">
        $(document).ready(function() {
            var defaults = {
                containerID: "toTop", // fading element id
                containerHoverID: "toTopHover", // fading element hover id
                scrollSpeed: 1200,
                easingType: "linear",
            };

            $().UItoTop({
                easingType: "easeOutQuart"
            });
        });
    </script>
    <!-- //smooth-scrolling-of-move-up -->
    <script src="js/bootstrap.js"></script>
</head>

<body>
    <!-- Model giới thiệu -->
    <?php include('./model_introduce.php'); ?>

    <!-- Header -->
    <?php include('./header.php'); ?>

    <!-- Banner -->
    <?php include('./banner.php'); ?>

    <!-- Welcome -->
    <?php include('./welcome.php'); ?>

    <!-- add-products -->
    <div class="add-products">
        <div class="container">
            <div class="add-products-row">
                <div class="w3ls-add-grids">
                    <a href="#">
                        <h4>
                            Trải nghiệm không giới hạn cùng <span>iPhone</span>.
                        </h4>
                        <h6>
                            Đến ngay
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        </h6>
                    </a>
                </div>
                <div class="w3ls-add-grids w3ls-add-grids-mdl">
                    <a href="#">
                        <h4>
                            Khám phá sức mạnh đỉnh cao với
                            <span>Samsung</span>.
                        </h4>
                        <h6>
                            Đến ngay
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        </h6>
                    </a>
                </div>
                <div class="w3ls-add-grids w3ls-add-grids-mdl1">
                    <a href="#">
                        <h4>
                            Kết nối sáng tạo, trải nghiệm đỉnh cao cùng <span> OPPO</span>.
                        </h4>
                        <h6>
                            Đến ngay
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        </h6>
                    </a>
                </div>
                <div class="clerfix"></div>
            </div>
        </div>
    </div>

    <!-- coming soon -->
    <div class="soon">
        <div class="container">
            <h3>Ưu đãi lớn trong tuần</h3>
            <h4>Sắp ra mắt, đừng bỏ lỡ!!!</h4>
            <div id="countdown1" class="ClassyCountdownDemo"></div>
        </div>
    </div>

    <!-- Deal -->
    <?php include('./deal.php'); ?>

    <!-- Footer -->
    <?php include('./footer.php'); ?>

    <!-- cart-js -->
    <!-- <script src="js/minicart.js"></script>
    <script>
        w3ls.render();

        w3ls.cart.on("w3sb_checkout", function(evt) {
            var items, len, i;

            if (this.subtotal() > 0) {
                items = this.items();

                for (i = 0, len = items.length; i < len; i++) {
                    items[i].set("shipping", 0);
                    items[i].set("shipping2", 0);
                }
            }
        });
    </script> -->

    <!-- countdown.js -->
    <script src="js/jquery.knob.js"></script>
    <script src="js/jquery.throttle.js"></script>
    <script src="js/jquery.classycountdown.js"></script>
    <script>
        $(document).ready(function() {
            $("#countdown1").ClassyCountdown({
                end: "1388268325",
                now: "1387999995",
                labels: true,
                style: {
                    element: "",
                    textResponsive: 0.5,
                    days: {
                        gauge: {
                            thickness: 0.1,
                            bgColor: "rgba(0,0,0,0)",
                            fgColor: "#1abc9c",
                            lineCap: "round",
                        },
                        textCSS: "font-weight:300; color:#fff;",
                    },
                    hours: {
                        gauge: {
                            thickness: 0.1,
                            bgColor: "rgba(0,0,0,0)",
                            fgColor: "#05BEF6",
                            lineCap: "round",
                        },
                        textCSS: " font-weight:300; color:#fff;",
                    },
                    minutes: {
                        gauge: {
                            thickness: 0.1,
                            bgColor: "rgba(0,0,0,0)",
                            fgColor: "#8e44ad",
                            lineCap: "round",
                        },
                        textCSS: " font-weight:300; color:#fff;",
                    },
                    seconds: {
                        gauge: {
                            thickness: 0.1,
                            bgColor: "rgba(0,0,0,0)",
                            fgColor: "#f39c12",
                            lineCap: "round",
                        },
                        textCSS: " font-weight:300; color:#fff;",
                    },
                },
                onEndCallback: function() {
                    console.log("Time out!");
                },
            });
        });
    </script>

    <!-- menu js aim -->
    <script src="js/jquery.menu-aim.js"></script>
    <script src="js/main.js"></script>
    <!-- Resource jQuery -->
    <!-- //menu js aim -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
</body>

</html>