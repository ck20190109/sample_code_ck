<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TSHCMZT');</script>
    <title>{{ $news_title[0]->meta_value }} | 2017 WWC</title>

    <!-- All in One SEO Pack 2.3.14.2 by Michael Torbert of Semper Fi Web Design[691,719] -->
    <meta name="description" content="{{ $news_description[0]->meta_value }}"/>

    <meta name="keywords" content="{{ $news_keywords[0]->meta_value }}"/>

    <link rel="canonical" href="{{ url('/') }}/{{ $news_post[0]->post_name }}/"/>
    <!-- /all in one seo pack -->
    <link rel='dns-prefetch' href='//fonts.googleapis.com'/>
    <link rel='dns-prefetch' href='//s.w.org'/>
    <link rel="alternate" type="application/rss+xml" title="2017 WWC &raquo; Feed" href="<?php echo config('app.cloudfront.js'); ?>/feed/"/>
    <link rel="alternate" type="application/rss+xml" title="2017 WWC &raquo; Comments Feed" href="<?php echo config('app.cloudfront.js'); ?>/comments/feed/"/>
    <script type="text/javascript">
        window._wpemojiSettings = {
            "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/2.3\/72x72\/",
            "ext": ".png",
            "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/2.3\/svg\/",
            "svgExt": ".svg",
            "source": {"concatemoji":<?php echo json_encode(config('app.cloudfront.js')."/wp-includes/js/wp-emoji-release.min.js?ver=4.8"); ?>}
        };
        !function (a, b, c) {
            function d(a) {
                var b, c, d, e, f = String.fromCharCode;
                if (!k || !k.fillText)return !1;
                switch (k.clearRect(0, 0, j.width, j.height), k.textBaseline = "top", k.font = "600 32px Arial", a) {
                    case"flag":
                        return k.fillText(f(55356, 56826, 55356, 56819), 0, 0), b = j.toDataURL(), k.clearRect(0, 0, j.width, j.height), k.fillText(f(55356, 56826, 8203, 55356, 56819), 0, 0), c = j.toDataURL(), b === c && (k.clearRect(0, 0, j.width, j.height), k.fillText(f(55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128, 56447), 0, 0), b = j.toDataURL(), k.clearRect(0, 0, j.width, j.height), k.fillText(f(55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203, 56128, 56423, 8203, 56128, 56447), 0, 0), c = j.toDataURL(), b !== c);
                    case"emoji4":
                        return k.fillText(f(55358, 56794, 8205, 9794, 65039), 0, 0), d = j.toDataURL(), k.clearRect(0, 0, j.width, j.height), k.fillText(f(55358, 56794, 8203, 9794, 65039), 0, 0), e = j.toDataURL(), d !== e
                }
                return !1
            }

            function e(a) {
                var c = b.createElement("script");
                c.src = a, c.defer = c.type = "text/javascript", b.getElementsByTagName("head")[0].appendChild(c)
            }

            var f, g, h, i, j = b.createElement("canvas"), k = j.getContext && j.getContext("2d");
            for (i = Array("flag", "emoji4"), c.supports = {
                everything: !0,
                everythingExceptFlag: !0
            }, h = 0; h < i.length; h++)c.supports[i[h]] = d(i[h]), c.supports.everything = c.supports.everything && c.supports[i[h]], "flag" !== i[h] && (c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && c.supports[i[h]]);
            c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && !c.supports.flag, c.DOMReady = !1, c.readyCallback = function () {
                c.DOMReady = !0
            }, c.supports.everything || (g = function () {
                c.readyCallback()
            }, b.addEventListener ? (b.addEventListener("DOMContentLoaded", g, !1), a.addEventListener("load", g, !1)) : (a.attachEvent("onload", g), b.attachEvent("onreadystatechange", function () {
                "complete" === b.readyState && c.readyCallback()
            })), f = c.source || {}, f.concatemoji ? e(f.concatemoji) : f.wpemoji && f.twemoji && (e(f.twemoji), e(f.wpemoji)))
        }(window, document, window._wpemojiSettings);
    </script>
    <style type="text/css">
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
    <link rel='stylesheet' id='contact-form-7-css'
          href='{{ config('app.cloudfront.content') }}/plugins/contact-form-7/includes/css/styles.css?ver=4.8'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='magic-liquidizer-table-style-css'
          href='{{ config('app.cloudfront.content') }}/plugins/magic-liquidizer-responsive-table/idcss/ml-responsive-table.css?ver=2.0.0'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='mdl_google_fonts-css'
          href='https://fonts.googleapis.com/css?family=Open+Sans%3A400%2C700%7CRaleway%3A400%2C800%2C900%7CMontserrat&#038;ver=1.0.24'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='bootstrap-css'
          href='{{ config('app.cloudfront.content') }}/plugins/msp/css/library/bootstrap.min.css?ver=1.0.19'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='team_custom_gallery-css'
          href='{{ config('app.cloudfront.content') }}/themes/team/modules/lightbox-gallery/css/style.css?ver=1.0.24'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='js_composer_front-css'
          href='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/css/js_composer.min.css?ver=5.1.1'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='A2A_SHARE_SAVE-css'
          href='{{ config('app.cloudfront.content') }}/plugins/add-to-any/addtoany.min.css?ver=1.14' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='team_preloader-css'
          href='{{ config('app.cloudfront.content') }}/uploads/wp-less-cache/team_preloader.css?ver=1502732975'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='font-awesome-css'
          href='//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?ver=1.0.19' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='owl.carousel-css'
          href='{{ config('app.cloudfront.content') }}/plugins/msp/css/library/owl.carousel.css?ver=1.0.19'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='owl.theme.default-css'
          href='{{ config('app.cloudfront.content') }}/plugins/msp/css/library/owl.theme.default.css?ver=1.0.19'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='animate-css-css'
          href='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/lib/bower/animate-css/animate.min.css?ver=5.1.1'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='team-base-css'
          href='{{ config('app.cloudfront.content') }}/uploads/wp-less-cache/team-base.css?ver=1505497828'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='team-css'
          href='{{ config('app.cloudfront.content') }}/uploads/wp-less-cache/team.css?ver=1502732975' type='text/css'
          media='all'/>
    <script type='text/javascript'>
        /* <![CDATA[ */
        var mdl_color_scheme = {
            "sidebar-menu-gradient-from": "#f0f0f0",
            "sidebar-menu-gradient-to": "#f7f7f7",
            "sidebar-calendar-border-color": "#e0e0e0",
            "sidebar-calendar-header-bg": "#141414",
            "sidebar-calendar-text-color": "#666",
            "sidebar-calendar-hover": "#f2f2f2",
            "store-sidebar-menu-gradient-from": "#f0f0f0",
            "store-sidebar-menu-gradient-to": "#f7f7f7",
            "blog-post-bg": "#f7f7f7",
            "blog-autor-bg": "#fcfcfc",
            "blog-autor-second-bg": "#141414",
            "blog-autor-text-heading": "#141414",
            "blog-autor-text": "#3d3d3d",
            "preloader-line-1": "#cd1d1d",
            "preloader-line-2": "#cd1d1d",
            "preloader-line-3": "#d70000",
            "preloader-line-4": "#d70000",
            "preloader-line-5": "#b80000",
            "preloader-line-6": "#d70000",
            "preloader-bg-color": "#fff",
            "header-background-color": "#b80000",
            "header-logo-before-color": "#0a0a0a",
            "header-text-color": "#ffffff",
            "header-hover-color": "#ffffff",
            "dropdown-menu-background": "#000000",
            "dropdown-menu-text": "#ffffff",
            "second-dropdown-menu-text": "#ffffff",
            "dropdown-menu-text-hover": "#000000",
            "button-iconbar-background": "#0a0a0a",
            "button-iconbar": "#b80000",
            "resize-hover-menu": "#0a0a0a",
            "top-bar-background": "#f7f7f7",
            "top-bar-social-color": "#999",
            "top-bar-border-color": "#e0e0e0",
            "top-bar-contacts-color": "#999",
            "top-bar-search-color": "#999",
            "base-color": "#3d3d3d",
            "contrast-color": "#d70000",
            "contrast-alt-color": "#b80000",
            "light-color": "#f7f7f7",
            "light-base-color": "#fcfcfc",
            "light-alt-color": "#ffffff",
            "dark-color": "#141414",
            "dark-alt-color": "#000000",
            "muted-color": "#666666",
            "muted-alt-color": "#cccccc",
            "muted-alt": "#999999",
            "title-base-color": "#141414",
            "title-text-color": "#ffffff",
            "footer-left-base-color": "#000000",
            "footer-left-text-color": "#cccccc",
            "footer-menu-color": "#cccccc",
            "footer-left-menu-hover": "#ffffff",
            "footer-header": "#ffffff",
            "footer-date-color": "#999999",
            "footer-name-hover": "#d70000",
            "footer-date-hover": "#ffffff",
            "footer-bottom-background": "#f7f7f7",
            "product-tab-wrap": "#ffffff",
            "product-tab-text": "#141414",
            "product-tab-hover": "#f7f7f7",
            "product-tab-contet-background": "#f7f7f7",
            "product-tab-textareacolor": "#ffffff",
            "product-tab-textareacolor-border": "#ffffff",
            "button-color": "#b80000",
            "button-text": "#ffffff",
            "button-hover": "#141414",
            "button-hover-text": "#ffffff",
            "store-info-background": "#ffffff",
            "store-info-product-name-color": "#292929",
            "store-info-product-name-hover": "#ffffff",
            "store-info-price-color": "#666",
            "store-info-price-hover": "#ffffff",
            "store-ifno-after": "#b80000",
            "store-info-hover": "#0a0a0a",
            "store-info-button": "#b80000",
            "store-info-button-text": "#ffffff",
            "store-info-button-hover": "#d70000",
            "store-info-button-text-hover": "#141414",
            "cart-total-background": "#ffffff",
            "cart-total-title-color": "#292929",
            "order-table-th-backgtound": "#141414",
            "order-table-th-text": "#ccc",
            "order-table-td-background": "#fcfcfc",
            "order-table-td-text": "#141414",
            "team-alert-background": "#fcfcfc",
            "woocommerce-checkout-payment": "#ebe9eb",
            "woocommerce-checkout-payment-label": "#3d3d3d",
            "quantity-number-backround": "#e6e6e6",
            "quantity-number-text-color": "#141414",
            "quantity-button-text-color": "#ffffff",
            "price-filter-button-text-color": "#ffffff",
            "shopping-cart-buttons-text-color": "#ffffff",
            "shopping-cart-th-background": "#141414",
            "shopping-cart-th-text": "#f7f7f7",
            "shopping-cart-item-background": "#fcfcfc",
            "shopping-cart-item-text-color": "#141414",
            "shopping-cart-item-border-color": "#e6e6e6",
            "shopping-cart-item-quantity-background": "#e6e6e6",
            "shopping-cart-item-quantity-text-color": "#141414",
            "shopping-cart-item-text-color-hover": "#141414",
            "shopping-cart-item-background-hover": "#ffffff",
            "shopping-cart-item-delete-background": "#f0f0f0",
            "shopping-cart-item-delete-text-color": "#7a7a7a",
            "shopping-cart-item-delete-background-hover": "#d70000",
            "shopping-cart-item-delete-text-color-hover": "#ffffff"
        };
        /* ]]> */
    </script>
    <script type='text/javascript'
            src='{{ config('app.cloudfront.includes') }}/js/jquery/jquery.js?ver=1.12.4'></script>
    <script type='text/javascript'
            src='{{ config('app.cloudfront.includes') }}/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>
    <script type='text/javascript'
            src='{{ config('app.cloudfront.content') }}/plugins/add-to-any/addtoany.min.js?ver=1.0'></script>
    <script type='text/javascript'
            src='{{ config('app.cloudfront.content') }}/plugins/magic-liquidizer-responsive-table/idjs/ml.responsive.table.min.js?ver=2.0.0'></script>
    <link rel='https://api.w.org/' href='<?php echo config('app.cloudfront.js'); ?>/wp-json/'/>
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo config('app.cloudfront.js'); ?>/xmlrpc.php?rsd"/>
    <link rel="wlwmanifest" type="application/wlwmanifest+xml"
          href="{{ config('app.cloudfront.includes') }}/wlwmanifest.xml"/>
    <meta name="generator" content="WordPress 4.8"/>
    <link rel='shortlink' href='{{ url('/') }}/?p={{ $news_post[0]->ID }}'/>
    <link rel="alternate" type="application/json+oembed"
          href="<?php echo config('app.cloudfront.js'); ?>/wp-json/oembed/1.0/embed?url={{ url('/') }}/{{ $news_post[0]->post_name }}/"/>
    <link rel="alternate" type="text/xml+oembed"
          href="<?php echo config('app.cloudfront.js'); ?>/wp-json/oembed/1.0/embed?url={{ url('/') }}/{{ $news_post[0]->post_name }}/&format=xml"/>

    <script type="text/javascript">
        var a2a_config = a2a_config || {};
        a2a_config.callbacks = a2a_config.callbacks || [];
        a2a_config.templates = a2a_config.templates || {};
        a2a_localize = {
            Share: "Share",
            Save: "Save",
            Subscribe: "Subscribe",
            Email: "Email",
            Bookmark: "Bookmark",
            ShowAll: "Show all",
            ShowLess: "Show less",
            FindServices: "Find service(s)",
            FindAnyServiceToAddTo: "Instantly find any service to add to",
            PoweredBy: "Powered by",
            ShareViaEmail: "Share via email",
            SubscribeViaEmail: "Subscribe via email",
            BookmarkInYourBrowser: "Bookmark in your browser",
            BookmarkInstructions: "Press Ctrl+D or \u2318+D to bookmark this page",
            AddToYourFavorites: "Add to your favorites",
            SendFromWebOrProgram: "Send from any email address or email program",
            EmailProgram: "Email program",
            More: "More&#8230;"
        };

    </script>
    <script type="text/javascript" src="https://static.addtoany.com/menu/page.js" async="async"></script>
    <meta name="generator" content="Powered by Visual Composer - drag and drop page builder for WordPress."/>
    <!--[if lte IE 9]>
    <link rel="stylesheet" type="text/css"
          href="{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/css/vc_lte_ie9.min.css"
          media="screen"><![endif]-->
    <link rel="icon" href="{{ config('app.cloudfront.content') }}/uploads/2017/07/logo-3.png" sizes="32x32"/>
    <link rel="icon" href="{{ config('app.cloudfront.content') }}/uploads/2017/07/logo-3.png" sizes="192x192"/>
    <link rel="apple-touch-icon-precomposed" href="{{ config('app.cloudfront.content') }}/uploads/2017/07/logo-3.png"/>
    <meta name="msapplication-TileImage" content="{{ config('app.cloudfront.content') }}/uploads/2017/07/logo-3.png"/>
    <style type="text/css" id="wp-custom-css">
        /*
You can add your own CSS here.

Click the help icon above to learn more.
*/
        .footer .footer-bottom {
            -webkit-box-shadow: 0px -2px 20px -5px rgba(151, 151, 151, 1);
            -moz-box-shadow: 0px -2px 20px -5px rgba(151, 151, 151, 1);
            box-shadow: 0px -2px 20px -5px rgba(151, 151, 151, 1);
        }

        .footer-bottom .created a {
            font-size: 12px;
            font-weight: bold;
        }

        .widget_timeline_widget ul li .timeline-title {
            height: 53px;
        }

        .widget_timeline_widget ul li .timeline-date {
            height: 52px;
            padding: 12px 0 5px 0;
        }

        .news-single .img-wrap h1 {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 30px 30px 39px;
            margin-bottom: 0;
            color: white;
            font-size: 20px;
            background: rgba(0, 0, 0, 0.1); /* Old Browsers */
            background: -moz-linear-gradient(top, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 1) 100%); /* FF3.6+ */
            background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0.1)), color-stop(100%, rgba(0, 0, 0, 1))); /* Chrome, Safari4+ */
            background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 1) 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(top, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 1) 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(top, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 1) 100%); /* IE 10+ */
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 1) 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#000000', endColorstr='#000000', GradientType=0); /* IE6-9 */
        }

        @media (max-width: 768px) {
            .news-single .img-wrap {
                padding-bottom: 25px;
                background-color: black;
            }

            .news-single .img-wrap h1 {
                padding: 20px 5px 10px;
                font-size: 16px;
            }
        }

        blockquote p {
            font-size: 16px;
        }

        blockquote:before {
            font-size: 60px;
        }

        .wwc-cta {
            margin-top: 65px;
            padding: 9px 26px 8px 26px;
            display: inline-block;
            background: #b80000;
            border-radius: 9px;
            color: #fff;
            font-size: 16px;
            font-family: Montserrat, sans-serif;
            text-transform: uppercase;
        }

        .wwc-cta:hover {
            color: #fff;
            background: #141414;
        }

        @media screen and (max-width: 400px) {
            .main-menu-wrap .game-venue {
                text-align: left;
                padding-left: 15px;
                margin-bottom: 38px;
            }
        }

        .main-menu-wrap .col-md-2.col-sm-2.col-xs-2 {
            z-index: 1;
        }

        .wpcf7 {
            padding: 12px !important;
            overflow: hidden;
            background-color: #E9E9E9;
        }

        .wpcf7 p {
            float: left;
        }

        .wpcf7-form.sent p {
            display: none;
        }

        .wpcf7 input[type='text'],
        .wpcf7 input[type='date'],
        .wpcf7 input[type='number'],
        .wpcf7 input[type='email'] {
            border-top: 1px solid #9E9E9E;
            border-bottom: 1px solid #9E9E9E;
            border-right: none;
            border-left: 1px solid #9E9E9E;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .wpcf7 p.last input[type='text'],
        .wpcf7 p.last input[type='date'],
        .wpcf7 p.last input[type='number'],
        .wpcf7 p.last input[type='email'] {
            border-right: 1px solid #9E9E9E;
        }

        .wpcf7 input[type='date'] {
            padding-left: 10px;
            padding-right: 10px;
            width: 100%;
            height: 31px;
        }

        .wpcf7 input[type='submit'] {
            border: none;
            margin-top: 16px;
        }

        .wpcf7 .pc-1 {
            width: 10%;
        }

        .wpcf7 .pc-2 {
            width: 20%;
        }

        .wpcf7 .pc-3 {
            width: 30%;
        }

        .wpcf7 .pc-4 {
            width: 40%;
        }

        .wpcf7 .pc-5 {
            width: 50%;
        }

        .wpcf7 .pc-6 {
            width: 60%;
        }

        .wpcf7 .pc-7 {
            width: 70%;
        }

        .wpcf7 .pc-8 {
            width: 80%;
        }

        .wpcf7 .pc-9 {
            width: 90%;
        }

        .wpcf7 .pc-10 {
            width: 100%;
        }

        @media only screen and (max-width: 991px) {
            /* For mobile phones: */
            .wpcf7 [class*="pc-"] {
                width: 100%;
            }

            .wpcf7 input[type='text'],
            .wpcf7 input[type='date'],
            .wpcf7 input[type='number'],
            .wpcf7 input[type='email'] {
                border-right: 1px solid #9E9E9E;
            }
        }

        .wpcf7 .pc-1 label,
        .wpcf7 .pc-2 label,
        .wpcf7 .pc-3 label,
        .wpcf7 .pc-4 label,
        .wpcf7 .pc-5 label,
        .wpcf7 .pc-6 label,
        .wpcf7 .pc-7 label,
        .wpcf7 .pc-8 label,
        .wpcf7 .pc-9 label,
        .wpcf7 .pc-10 label {
            width: 100%;
        }

        @media (max-width: 991px) {
            .vc_custom_1500491540467 {
                margin-top: -64px;
                margin-bottom: -150px;
                z-index: -1;
            }

            .vc_custom_1500491540467 img {
                padding-bottom: 40px;
            }
        }

        .news-single {
            margin-top: 10px;
        }

        table tr td:last-child {
            font-weight: normal !important;
        }

        @media only screen and (min-width: 480px) {
            #moveleft {
                margin-left: -300px !important;
            }
        }

        table tr td {
            border-bottom: 1px solid #000;
        }

        table tr td .removeborderbottom {
            border-bottom: none !important;
        }

        @media only screen and (max-width: 768px) {
            #calendar-3 {
                display: none !important;
            }
        }

        .ml-title {
            color: #808080 !important;
        }

        .ml-value {
            color: #E82C0C !important;
        }

        .ml-responsive-table dl:nth-of-type(odd) {
            background-color: #eee !important;
        }

        .content {
            padding: 0px 0px;
        }

        .beCircle img {
            border-radius: 50%;
        }

        .page-id-7909 .wpcf7,
        .page-id-8343 .wpcf7,
        .page-id-8409 .wpcf7,
        .page-id-8431 .wpcf7,
        .page-id-8433 .wpcf7 {
            padding: 12px !important;
            overflow: hidden;
            background-color: #b80000

        }

        .page-id-7909 .wpcf7 p,
        .page-id-8343 .wpcf7 p,
        .page-id-8409 .wpcf7 p,
        .page-id-8431 .wpcf7 p,
        .page-id-8433 .wpcf7 p {
            font-size: 25px;
            margin: 20px;
            padding: 20px;
            color: #fff;
        }

        .page-id-7909 .wpcf7 .wpcf7-submit,
        .page-id-8343 .wpcf7 .wpcf7-submit,
        .page-id-8409 .wpcf7 .wpcf7-submit,
        .page-id-8431 .wpcf7 .wpcf7-submit,
        .page-id-8433 .wpcf7 .wpcf7-submit {
            font-size: 20px;
            background-color: gray;
            padding: 10px;
            border-radius: 5px;
            margin-top: -5px;
            float: right;

        }

        .page-id-7909 .wpcf7 .wpcf7-submit:hover,
        .page-id-8343 .wpcf7 .wpcf7-submit:hover,
        .page-id-8409 .wpcf7 .wpcf7-submit:hover,
        .page-id-8431 .wpcf7 .wpcf7-submit:hover,
        .page-id-8433 .wpcf7 .wpcf7-submit:hover {

            background-color: white;
            padding: 10px;
            color: gray;
            border-radius: 5px;
        }

        .page-id-7909 .booking,
        .page-id-8343 .booking,
        .page-id-8409 .booking,
        .page-id-8431 .booking,
        .page-id-8433 .booking {
            display: none;
        }

        .page-id-7909 .main-slider-caption .team, .page-id-8343 .main-slider-caption .team,
        .page-id-8409 .main-slider-caption .team,
        .page-id-8431 .main-slider-caption .team,
        .page-id-8433 .main-slider-caption .team {
            color: #b80000;
        }

        .page-id-7909 .descr,
        .page-id-8343 .descr,
        .page-id-8409 .descr,
        .page-id-8431 .descr,
        .page-id-8433 .descr {
            color: gray !important;
        }

        .page-id-7909 .main-slider-caption .counter .digit,
        .page-id-8343 .main-slider-caption .counter .digit,
        .page-id-8409 .main-slider-caption .counter .digit,
        .page-id-8431 .main-slider-caption .counter .digit,
        .page-id-8433 .main-slider-caption .counter .digit {
            border-radius: 50% !important;
        }

        .page-id-7909 label,
        .page-id-8343 label,
        .page-id-8409 label,
        .page-id-8431 label,
        .page-id-8433 label {
            width: 100%;
            float: left;
        }

        .page-id-7909 input[type="email"],
        .page-id-8343 input[type="email"],
        .page-id-8409 input[type="email"],
        .page-id-8431 input[type="email"],
        .page-id-8433 input[type="email"] {
            width: 50%;
        }

        @media only screen and (max-width: 768px) {
            .page-id-7909 input[type="email"],
            .page-id-8343 input[type="email"],
            .page-id-8409 input[type="email"],
            .page-id-8431 input[type="email"],
            .page-id-8433 input[type="email"] {
                width: 100%;
            }
        }

        @media only screen and (max-width: 768px) {
            .page-id-7909 .wpcf7 .wpcf7-submit,
            .page-id-8343 .wpcf7 .wpcf7-submit,
            .page-id-8409 .wpcf7 .wpcf7-submit,
            .page-id-8431 .wpcf7 .wpcf7-submit,
            .page-id-8433 .wpcf7 .wpcf7-submit {
                float: none;
                margin-top: 20px;
            }
        }

        .page-id-4435 .wpcf7 {
            background-color: #b80000;
        }

        .page-id-4435 .buttonColor .wpcf7 .pc-5 {
            width: 100%;
        }

        .page-id-4435 .buttonColor .wwc-cta {
            background-color: grey;
        }

        .page-id-4435 .wwc-cta:hover {
            background-color: #fff;
            color: grey;
        }

        .page-id-4435 .wpcf7 input[type='text'], .wpcf7 input[type='date'], .wpcf7 input[type='number'], .wpcf7 input[type='email'] {
            border-radius: 3px !important;
        }

        .page-id-9041 .wpcf7 input[type='text'], .wpcf7 input[type='date'], .wpcf7 input[type='number'], .wpcf7 input[type='email'] {
            border-radius: 3px !important;
        }

        .colorRed h2 {
            color: #B80000;
        }

        .page-id-65 .vc_btn3.vc_btn3-color-danger.vc_btn3-style-modern {
            background-color: #b80000;
        }

        .page-id-7785 .vc_btn3.vc_btn3-color-danger.vc_btn3-style-modern {
            background-color: #b80000;
        }

        .page-id-9041 .wpcf7 {
            background-color: #b80000;
        }

        .page-id-9041 .wwc-cta {
            background: grey;
        }

        .page-id-9041 .wwc-cta:hover {
            background: white;
            color: grey;
        }

        .page-id-65 .vc_btn3.vc_btn3-color-danger.vc_btn3-style-modern:hover {
            background-color: grey;
            border-color: grey;
        }

        .page-id-9041 .vc_btn3.vc_btn3-color-danger.vc_btn3-style-modern:hover {
            background-color: grey;
            border-color: grey;
        }

        .page-id-4435 .wpcf7 .pc-6 {
            width: 100%;
        }

        .page-id-9041 .wpcf7 .pc-5 {
            width: 100%;
        }

        .share-buttons-wrapper {
            display: none;
        }

        .sidebar-right-image {
            padding-top: 20px;
            width: 177px;
        }

    </style>
    <noscript>
        <style type="text/css"> .wpb_animate_when_almost_visible {
                opacity: 1;
            }</style>
    </noscript>
    <!-- START - Facebook Open Graph, Google+ and Twitter Card Tags 2.0.8.2 -->
    <!-- Facebook Open Graph -->
    <meta property="og:locale" content="{{ config('app.locale') }}"/>
    <meta property="og:site_name" content="2017 WWC"/>
    <meta property="og:title" content="{{ $news_post[0]->post_title }}"/>
    <meta property="og:url" content="{{ url('/') }}/{{ $news_post[0]->post_name }}/"/>
    <meta property="og:type" content="article"/>
    <meta property="og:description" content="{{ $news_post[0]->post_title }}"/>
    <meta property="og:image" content="{{ config('app.cloudfront.content') }}/uploads/2017/07/unclepop.png"/>
    <!-- Google+ / Schema.org -->
    <meta itemprop="name" content="{{ $news_post[0]->post_title }}"/>
    <meta itemprop="description" content="{{ $news_post[0]->post_title }}"/>
    <meta itemprop="image" content="{{ config('app.cloudfront.content') }}/uploads/2017/07/unclepop.png"/>
    <!-- Twitter Cards -->
    <meta name="twitter:title" content="{{ $news_post[0]->post_title }}"/>
    <meta name="twitter:url" content="{{ url('/') }}/{{ $news_post[0]->post_name }}/"/>
    <meta name="twitter:description" content="{{ $news_post[0]->post_title }}"/>
    <meta name="twitter:image" content="{{ config('app.cloudfront.content') }}/uploads/2017/07/unclepop.png"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <!-- SEO -->
    <!-- Misc. tags -->
    <!-- END - Facebook Open Graph, Google+ and Twitter Card Tags 2.0.8.2 -->

</head>

<body class="<?php switch($body_style) {
                                    case 'home': echo "home page-template-default page page-id-".$news_post[0]->ID;; break;
                                    case 'news': echo 'blog'; break;
                                    case '1 news': echo 'post-template-default single single-post postid-'.$news_post[0]->ID.' single-format-standard'; break;
                                    case 'N news': echo 'archive date'; break;
                                    case 'S news': echo 'search search-results'; break;
                                    default: echo "page-template-default page page-id-".$news_post[0]->ID; break;
                               } ?> wp-custom-logo wpb-js-composer js-comp-ver-5.1.1 vc_responsive">
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TSHCMZT"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>

<div class="preloader-wrapper" id="preloader">
    <div class="motion-line dark-big"></div>
    <div class="motion-line yellow-big"></div>
    <div class="motion-line dark-small"></div>
    <div class="motion-line yellow-normal"></div>
    <div class="motion-line yellow-small1"></div>
    <div class="motion-line yellow-small2"></div>
</div>


<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-8 hidden-sm hidden-xs">
            </div>
            <div class="col-md-4">
                <div class="top-contacts">

                    <ul class="socials sac_socials">
                        <?php for($i = 0;$i < count($news_options['mdl__socials']);$i++) { ?>
                        <li>
                            <a href="{{ $news_options['mdl__socials'][$i]['link'] }}">
                                <i class="{{ $news_options['mdl__socials'][$i]['icon'] }}" aria-hidden="true"></i>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <ul class="socials sac_socials languages">
                        <li><a lang="en" hreflang="en" href="{{ url('/') }}/">EN</a></li>
                        <li><a lang="fr" hreflang="fr" href="{{ url('/') }}/{{ $news_languages[5]->post_name }}/">FR</a></li>
                        <li><a lang="zh" hreflang="zh" href="{{ url('/') }}/{{ $news_languages[1]->post_name }}/">中</a></li>
                        <li><a lang="de" hreflang="de" href="{{ url('/') }}/{{ $news_languages[2]->post_name }}/">DE</a></li>
                        <li><a lang="es" hreflang="es" href="{{ url('/') }}/{{ $news_languages[3]->post_name }}/">ES</a></li>
                        <li><a lang="ja" hreflang="ja" href="{{ url('/') }}/{{ $news_languages[4]->post_name }}/">日</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-menu-wrap sticky-menu">
    <div class="container">
        <div class="row game-venue">
            <div class="header-sponsor-carousel">
                <?php for($i = 0;$i < count($news_sponsors);$i++) { ?>
                <img src="{{ $news_sponsors[$i] }}" alt="">
                <?php } ?>
            </div>
            <span>Markham, CA 27 Oct 2017 - 29 Oct 2017</span>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">

                <a href="{{ url('/') }}/{{ $country }}" class="custom-logo-link" rel="home" itemprop="url">
                    <div class="game-logo"><img width="86" height="71"
                                                src="{{ config('app.cloudfront.content') }}/uploads/2017/07/logo-1.png"
                                                class="custom-logo" alt="2017 WWC" itemprop="logo"/><span>Uncle Pop 2017 Women's World Cup<br>Presented by Polar Naturals</span>
                    </div>
                </a>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#team-menu"
                        aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <nav class="navbar">
                    <div class="collapse navbar-collapse" id="team-menu">
                        <ul id="menu-header-for-eng" class="main-menu nav">
                            <?php echo html_entity_decode($main_menu); ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
