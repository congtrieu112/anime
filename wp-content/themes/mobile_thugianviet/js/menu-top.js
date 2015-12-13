var enableShowChild = false;
var IsIChrome = navigator.userAgent.search("CriOS") >= 0 ? true : false;
var IsIos7 = /(iPhone|iPod|iPad);.*CPU.*OS 7_\d/i.test(navigator.userAgent);
var IsIos = /(iPhone|iPod|iPad).*AppleWebKit/i.test(navigator.userAgent);
var IsISafari = /safari/.test(navigator.userAgent.toLowerCase());
$(function () {
    var expand = 0;
    var position = $(window).scrollTop();
    var header_h = $("#header").height();
    var iden1 = 0;
    var timeout = null;
    document.addEventListener("touchmove", touchMove, false);
    document.addEventListener("scroll", Scroll, false);

    function fix_menu_chorme() {
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            $(".empty").hide();
            iden1 = 0;
        }, 3000);
    }

    var fix_height = $(window).height();
    var up = false;
    function touchMove() {
        if (expand == 0) {
            var scroll = $(window).scrollTop();
            if (scroll > position) {
                if (scroll > header_h + 50) {
                    $("#header_menu").hide();

                    iden1 = 0;
                    up = false;
                }
            } else if (position > scroll + 5) {
                if ($(window).scrollTop() > header_h) {
                    if (IsIChrome && !IsIos7) {
                        fix_menu_chorme();
                    }
                    if (iden1 == 0) {
                        $("#header_menu").css("position", "fixed");
                        $("#header_menu").addClass("animated fadeInDown");
                        if (IsIChrome && !IsIos7) {
                            $(".empty").show();
                            fix_menu_chorme();
                        }
                        $("#header_menu").show();
                        iden1 = 1;
                        up = true;
                    }
                }
                else {
                    $(".empty").hide();
                    $("#header_menu").removeClass("animated");
                    $("#header_menu").removeClass("fadeInDown");
                    up = false;
                }
            }
            if (up && scroll <= 50) {
                $(".empty").hide();
            }
            position = scroll;
        }
    }

    function Scroll() {
        if (expand == 0) {
            var scroll = $(window).scrollTop();

            if (scroll > position) {
                if (scroll > header_h + 50) {
                    $("#header_menu").hide();
                    iden1 = 0;
                    up = false;
                }
            } else if (position > scroll + 5) {
                if ($(window).scrollTop() > header_h) {
                    if (IsIChrome && !IsIos7) {
                        fix_menu_chorme();
                    }
                    if (iden1 == 0) {
                        $("#header_menu").css("position", "fixed");
                        $("#header_menu").addClass("animated fadeInDown");
                        if (IsIChrome && !IsIos7) {
                            $(".empty").show();
                            fix_menu_chorme();
                        }
                        $("#header_menu").show();
                        iden1 = 1;
                        up = true;
                    }
                }
                else {
                    $(".empty").hide();
                    $("#header_menu").removeClass("animated");
                    $("#header_menu").removeClass("fadeInDown");
                    up = false;
                }
            }
            if (up && scroll <= 50) {
                $(".empty").hide();
            }
            position = scroll;
        }
    }
});
