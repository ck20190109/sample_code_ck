<footer class="footer"
        style="background-image: url({{ config('app.cloudfront.content') }}/uploads/2017/07/am_tabletennis_footer.jpg);">

    <div class="wrapper-overfllow">
        <div class="container">
            <div class="row">

                <div class="col-md-4 col-sm-12">
                    <div class="footer-left">
                        <div class="wrap">
                            <div id="nav_menu-5" class="widget widget_nav_menu">
                                <div class="menu-footer-for-eng-container">
                                    <ul id="menu-footer-for-eng" class="menu">
                                        <li id="menu-item-921"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-921">
                                            <a href="{{ url('/') }}/{{ $country }}">{{ __('lang._FOOTER_Home') }}</a></li>
                                        <li id="menu-item-8301"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8301">
                                            <a href="{{ url('/') }}/{{ $lang }}2017-wwc-wwc-history/">{{ __('lang._FOOTER_History') }}</a></li>
                                        <li id="menu-item-926"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-926">
                                            <a href="{{ url('/') }}/{{ $lang }}news/">{{ __('lang._FOOTER_News') }}</a></li>
                                        <li id="menu-item-2967"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2967">
                                            <a href="{{ url('/') }}/{{ $lang }}match-schedule/">{{ __('lang._FOOTER_Schedule') }}</a></li>
                                        <li id="menu-item-2963"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2963">
                                            <a href="https://ticket.2017wwc.com/">{{ __('lang._FOOTER_Booking') }}</a></li>
                                        <li id="menu-item-2965"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2965">
                                            <a href="{{ url('/') }}/{{ $lang }}banquet/">{{ __('lang._FOOTER_Banquet') }}</a></li>
                                        <li id="menu-item-2957"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2957">
                                            <a href="{{ url('/') }}/{{ $lang }}career/">{{ __('lang._FOOTER_Career') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 col-sm-12 col-lg-offset-1 dark footer-right">
                    <div id="recent-posts-6" class="col-md-6 col-sm-12 widget widget_recent_entries">
                        <div class="recent-news">
                            <h4>{{ __('lang._FOOTER_Recent_News') }}</h4>
                            <?php $cnt = count($News); $cnt= $cnt>3 ? 3: $cnt; ?>
                            <?php for($i = 0;$i<$cnt;$i++) { ?>
                            <div class="item">
                                <div class="date">
                                    <a href="{{ url('/') }}/{{ $news_lang }}News/NewsWithTimeLine/{{ $News[$i]->date_route }}/">{{ $News[$i]->format_date }}</a>
                                    {{ __('lang._FOOTER_In') }} <a href="{{ url('/') }}/category/uncategorized/" rel="tag">{{ __('lang._FOOTER_Uncategorized') }}</a>
                                </div>
                                <a href="{{ url('/') }}/News/NewsWithTimeLine/{{ $News[$i]->date_route }}/{{ $News[$i]->post_name }}/"
                                   class="name">{{ $News[$i]->post_title }}</a>
                            </div>
                            <?php } ?>

                        </div>

                    </div>
                    <div id="text-3" class="col-md-6 col-sm-12 widget widget_text"><h4>{{ __('lang._FOOTER_Contact_Us') }}</h4>
                        <div class="textwidget">
                            <ul class="contact-list">
                                <?php for($i = 0;$i < count($news_options['mdl__contacts']);$i++) { ?>
                                <li><i class="{{ $news_options['mdl__contacts'][$i]['icon'] }}"
                                       aria-hidden="true"></i><span><a
                                                href="">{{ $news_options['mdl__contacts'][$i]['text'] }}</a></span></li>
                                <?php } ?>
                            </ul>
                            <ul class="socials">
                                <?php for($i = 0;$i < count($news_options['mdl__socials']);$i++) { ?>
                                <li><a href="{{ $news_options['mdl__socials'][$i]['link'] }}"><i
                                                class="{{ $news_options['mdl__socials'][$i]['icon'] }}"
                                                aria-hidden="true"></i></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div id="search-4" class="col-md-6 col-sm-12 widget widget_search">
                        <form role="search" method="get" action="{{ url('/')."/".$news_lang."News/NewsWithTimeLine/Search" }}/">
                        <div class="wrap">
                            <input type="text" placeholder="Search ..." value="{{ $s }}" name="s"
                                   title="Search for:">
                            <button><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-menu-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul id="menu-header-for-eng-1" class="footer-menu">
                        <?php for ($i=0;$i<count($top_menu);$i++) { ?>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-{{ $top_menu[$i]->ID }}">
                            <a><span>{{ $top_menu[$i]->post_title }}</span></a></li>
                        <?php } ?>
                    </ul>
                    <a href="#" class="foot-up"><span>{{ __('lang._FOOTER_Up') }}<i class="fa fa-caret-up" aria-hidden="true"></i></span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="copyrights">
                        © 2017 WWC
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="created">
                        PRESENTED BY <a href="http://www.kiwinano.info/" style="color: #b80000;">Kiwinano</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>

<script type='text/javascript'>
    //<![CDATA[
    jQuery(document).ready(function ($) {
        $('html').MagicLiquidizerTable({whichelement: 'table', breakpoint: '780', table: '1'})
    })
    //]]>
</script>
<link rel='stylesheet' id='vc_wwc_countdown-css'
      href='{{ config('app.cloudfront.content') }}/uploads/wp-less-cache/vc_wwc_countdown.css?ver=1502732976'
      type='text/css' media='all'/>
<link rel='stylesheet' id='vc_team_news_line-css'
      href='{{ config('app.cloudfront.content') }}/uploads/wp-less-cache/vc_team_news_line.css?ver=1502979604'
      type='text/css' media='all'/>
<link rel='stylesheet' id='isotope-css-css'
      href='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/css/lib/isotope.min.css?ver=5.1.1'
      type='text/css' media='all'/>
<link rel='stylesheet' id='prettyphoto-css'
      href='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/lib/prettyphoto/css/prettyPhoto.min.css?ver=5.1.1'
      type='text/css' media='all'/>
<link rel='stylesheet' id='vc_tta_style-css'
      href='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/css/js_composer_tta.min.css?ver=5.1.1'
      type='text/css' media='all'/>
<link rel='stylesheet' id='vc_google_fonts_open_sans300300italicregularitalic600600italic700700italic800800italic-css'
      href='//fonts.googleapis.com/css?family=Open+Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic&#038;subset=latin&#038;ver=4.8'
      type='text/css' media='all'/>
<script type='text/javascript'>
    /* <![CDATA[ */
    var wpcf7 = {
        "apiSettings": {"root": <?php echo json_encode(config('app.cloudfront.js')."/wp-json/"); ?>, "namespace": "contact-form-7\/v1"},
        "recaptcha": {"messages": {"empty": "Please verify that you are not a robot."}},
        "cached": "1"
    };
    /* ]]> */
</script>
<script type='text/javascript'
        src='{{ config('app.cloudfront.content') }}/plugins/contact-form-7/includes/js/scripts.js?ver=4.8'></script>
<script type='text/javascript'
        src='{{ config('app.cloudfront.content') }}/plugins/msp/js/library/bootstrap.min.js?ver=1.0.19'></script>
<script type='text/javascript'
        src='{{ config('app.cloudfront.content') }}/themes/team/modules/lightbox-gallery/js/jquery.touchSwipe.min.js?ver=1.6.18'></script>
<script type='text/javascript'
        src='{{ config('app.cloudfront.includes') }}/js/underscore.min.js?ver=1.8.3'></script>
<script type='text/javascript'
        src='{{ config('app.cloudfront.includes') }}/js/backbone.min.js?ver=1.2.3'></script>
<script type='text/template' id='mdl__lightbox_gallery_template'>

    <div class="modal-dialog custom-gallery-modal" role="document">
        <div class="modal-content">
            <div class="slide-wrapper">
                <div class="img-container text-center"></div>
                <i class="fa fa-chevron-right next-iamge"></i>
                <i class="fa fa-chevron-left prev-image"></i>
            </div>
            <div class="collection ">
                <div class="collection-wrapper">
                    <% _.each(images, function(image){ %>
                    <a href="<%= image.url_full %>">
                        <img src="<%= image.url_thubmail %>" style="" alt="">
                    </a>
                    <% }) %>
                </div>
            </div>
        </div>
    </div>
    
</script>
<script type='text/javascript'
	src='{{ config('app.cloudfront.content') }}/themes/team/modules/lightbox-gallery/js/js.js?ver=1.0.24'></script>
<script type='text/javascript'
	src='{{ config('app.cloudfront.content') }}/themes/team/js/wwc.js?ver=1.0.24'></script>
<script type='text/javascript'
	src='{{ config('app.cloudfront.content') }}/themes/team/js/library/jquery.sticky.min.js?ver=1.0.4'></script>
<script type='text/javascript'
	src='{{ config('app.cloudfront.content') }}/plugins/msp/js/library/owl.carousel.min.js?ver=2.2.1'></script>
<script type='text/javascript'
	src='{{ config('app.cloudfront.content') }}/themes/team/js/simple.js?ver=1.0.24'></script>
<script type='text/javascript'
	src='{{ config('app.cloudfront.includes') }}/js/comment-reply.min.js?ver=4.8'></script>
<script type='text/javascript'
	src='{{ config('app.cloudfront.includes') }}/js/wp-embed.min.js?ver=4.8'></script>
<script type='text/javascript'>
document.addEventListener("DOMContentLoaded", function(){ var $load = document.getElementById("preloader"); var removeLoading = setTimeout(function() { $load.className += " hide"; }, 1000); });
</script>
<script type='text/javascript'
	src='{{ config('app.cloudfront.content') }}/themes/team/js/preloader.js?ver=1.0.24'></script>
<script type='text/javascript'
	src='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/js/dist/js_composer_front.min.js?ver=5.1.1'></script>
<script type='text/javascript'
	src='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/lib/waypoints/waypoints.min.js?ver=5.1.1'></script>
<script type='text/javascript'
	src='{{ config('app.cloudfront.content') }}/plugins/msp/js/library/jquery.team-coundown.js?ver=1.0.19'></script>
<script type='text/javascript' src='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/lib/vc_accordion/vc-accordion.min.js?ver=5.1.1'></script>
<script type='text/javascript' src='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/lib/vc-tta-autoplay/vc-tta-autoplay.min.js?ver=5.1.1'></script>
<script type='text/javascript' src='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/lib/vc_tabs/vc-tabs.min.js?ver=5.1.1'></script>
<script type='text/javascript' src='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/lib/bower/imagesloaded/imagesloaded.pkgd.min.js?ver=4.8'></script>
<script type='text/javascript' src='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/lib/bower/isotope/dist/isotope.pkgd.min.js?ver=5.1.1'></script>
<script type='text/javascript' src='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/lib/prettyphoto/js/jquery.prettyPhoto.min.js?ver=5.1.1'></script>
<script type='text/javascript' src='{{ config('app.cloudfront.content') }}/plugins/js_composer/assets/lib/bower/skrollr/dist/skrollr.min.js?ver=5.1.1'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var wwc_countdown = {"themeurl":<?php echo json_encode("~\"".config('app.cloudfront.js')."/wp-content/themes/team\""); ?>,"lessurl":<?php echo json_encode("~\"".config('app.cloudfront.js')."/wp-content/plugins/msp/includes/vc/shortcodes/less\""); ?>,"sidebar-menu-gradient-from":"#f0f0f0","sidebar-menu-gradient-to":"#f7f7f7","sidebar-calendar-border-color":"#e0e0e0","sidebar-calendar-header-bg":"#141414","sidebar-calendar-text-color":"#666","sidebar-calendar-hover":"#f2f2f2","store-sidebar-menu-gradient-from":"#f0f0f0","store-sidebar-menu-gradient-to":"#f7f7f7","blog-post-bg":"#f7f7f7","blog-autor-bg":"#fcfcfc","blog-autor-second-bg":"#141414","blog-autor-text-heading":"#141414","blog-autor-text":"#3d3d3d","preloader-line-1":"#cd1d1d","preloader-line-2":"#cd1d1d","preloader-line-3":"#d70000","preloader-line-4":"#d70000","preloader-line-5":"#b80000","preloader-line-6":"#d70000","preloader-bg-color":"#fff","header-background-color":"#b80000","header-logo-before-color":"#0a0a0a","header-text-color":"#ffffff","header-hover-color":"#ffffff","dropdown-menu-background":"#000000","dropdown-menu-text":"#ffffff","second-dropdown-menu-text":"#ffffff","dropdown-menu-text-hover":"#000000","button-iconbar-background":"#0a0a0a","button-iconbar":"#b80000","resize-hover-menu":"#0a0a0a","top-bar-background":"#f7f7f7","top-bar-social-color":"#999","top-bar-border-color":"#e0e0e0","top-bar-contacts-color":"#999","top-bar-search-color":"#999","base-color":"#3d3d3d","contrast-color":"#d70000","contrast-alt-color":"#b80000","light-color":"#f7f7f7","light-base-color":"#fcfcfc","light-alt-color":"#ffffff","dark-color":"#141414","dark-alt-color":"#000000","muted-color":"#666666","muted-alt-color":"#cccccc","muted-alt":"#999999","title-base-color":"#141414","title-text-color":"#ffffff","footer-left-base-color":"#000000","footer-left-text-color":"#cccccc","footer-menu-color":"#cccccc","footer-left-menu-hover":"#ffffff","footer-header":"#ffffff","footer-date-color":"#999999","footer-name-hover":"#d70000","footer-date-hover":"#ffffff","footer-bottom-background":"#f7f7f7","product-tab-wrap":"#ffffff","product-tab-text":"#141414","product-tab-hover":"#f7f7f7","product-tab-contet-background":"#f7f7f7","product-tab-textareacolor":"#ffffff","product-tab-textareacolor-border":"#ffffff","button-color":"#ffa000","button-text":"#141414","button-hover":"#ffcc00","button-hover-text":"#ffffff","store-info-background":"#ffffff","store-info-product-name-color":"#292929","store-info-product-name-hover":"#ffffff","store-info-price-color":"#666","store-info-price-hover":"#ffffff","store-ifno-after":"#b80000","store-info-hover":"#0a0a0a","store-info-button":"#b80000","store-info-button-text":"#ffffff","store-info-button-hover":"#d70000","store-info-button-text-hover":"#141414","cart-total-background":"#ffffff","cart-total-title-color":"#292929","order-table-th-backgtound":"#141414","order-table-th-text":"#ccc","order-table-td-background":"#fcfcfc","order-table-td-text":"#141414","team-alert-background":"#fcfcfc","woocommerce-checkout-payment":"#ebe9eb","woocommerce-checkout-payment-label":"#3d3d3d","quantity-number-backround":"#e6e6e6","quantity-number-text-color":"#141414","quantity-button-text-color":"#ffffff","price-filter-button-text-color":"#ffffff","shopping-cart-buttons-text-color":"#ffffff","shopping-cart-th-background":"#141414","shopping-cart-th-text":"#f7f7f7","shopping-cart-item-background":"#fcfcfc","shopping-cart-item-text-color":"#141414","shopping-cart-item-border-color":"#e6e6e6","shopping-cart-item-quantity-background":"#e6e6e6","shopping-cart-item-quantity-text-color":"#141414","shopping-cart-item-text-color-hover":"#141414","shopping-cart-item-background-hover":"#ffffff","shopping-cart-item-delete-background":"#f0f0f0","shopping-cart-item-delete-text-color":"#7a7a7a","shopping-cart-item-delete-background-hover":"#d70000","shopping-cart-item-delete-text-color-hover":"#ffffff","base-font":"Open Sans","sub-font":"Raleway","secondary-font":"Montserrat","image-dir-url":"wp-content\/themes\/team\/images","arrow-color":"#141414","arrow-hover":"#ffcc00","event-line-color":"#ffcc00","match-slider-text-color":"#fff","match-slider-mini-caption-bg":"#000000","match-slider-mini-caption-text-color":"#cccccc","match-slider-mini-caption-time-bg":"#141414","match-slider-mini-caption-time-text-color":"#ffffff"};
                    /* ]]> */
</script>
<script type='text/javascript'
        src='{{ config('app.cloudfront.content') }}/plugins/msp/includes/vc/shortcodes/js/wwc_countdown.js?ver=1.0.19'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var team_news_line = {"themeurl":<?php echo json_encode("~\"".config('app.cloudfront.js')."/wp-content/themes/team\""); ?>,"lessurl":<?php echo json_encode("~\"".config('app.cloudfront.js')."/wp-content/plugins/msp/includes/vc/shortcodes/less\""); ?>,"sidebar-menu-gradient-from":"#f0f0f0","sidebar-menu-gradient-to":"#f7f7f7","sidebar-calendar-border-color":"#e0e0e0","sidebar-calendar-header-bg":"#141414","sidebar-calendar-text-color":"#666","sidebar-calendar-hover":"#f2f2f2","store-sidebar-menu-gradient-from":"#f0f0f0","store-sidebar-menu-gradient-to":"#f7f7f7","blog-post-bg":"#f7f7f7","blog-autor-bg":"#fcfcfc","blog-autor-second-bg":"#141414","blog-autor-text-heading":"#141414","blog-autor-text":"#3d3d3d","preloader-line-1":"#cd1d1d","preloader-line-2":"#cd1d1d","preloader-line-3":"#d70000","preloader-line-4":"#d70000","preloader-line-5":"#b80000","preloader-line-6":"#d70000","preloader-bg-color":"#fff","header-background-color":"#b80000","header-logo-before-color":"#0a0a0a","header-text-color":"#ffffff","header-hover-color":"#ffffff","dropdown-menu-background":"#000000","dropdown-menu-text":"#ffffff","second-dropdown-menu-text":"#ffffff","dropdown-menu-text-hover":"#000000","button-iconbar-background":"#0a0a0a","button-iconbar":"#b80000","resize-hover-menu":"#0a0a0a","top-bar-background":"#f7f7f7","top-bar-social-color":"#999","top-bar-border-color":"#e0e0e0","top-bar-contacts-color":"#999","top-bar-search-color":"#999","base-color":"#3d3d3d","contrast-color":"#d70000","contrast-alt-color":"#b80000","light-color":"#f7f7f7","light-base-color":"#fcfcfc","light-alt-color":"#ffffff","dark-color":"#141414","dark-alt-color":"#000000","muted-color":"#666666","muted-alt-color":"#cccccc","muted-alt":"#999999","title-base-color":"#141414","title-text-color":"#ffffff","footer-left-base-color":"#000000","footer-left-text-color":"#cccccc","footer-menu-color":"#cccccc","footer-left-menu-hover":"#ffffff","footer-header":"#ffffff","footer-date-color":"#999999","footer-name-hover":"#d70000","footer-date-hover":"#ffffff","footer-bottom-background":"#f7f7f7","product-tab-wrap":"#ffffff","product-tab-text":"#141414","product-tab-hover":"#f7f7f7","product-tab-contet-background":"#f7f7f7","product-tab-textareacolor":"#ffffff","product-tab-textareacolor-border":"#ffffff","button-color":"#b80000","button-text":"#ffffff","button-hover":"#141414","button-hover-text":"#ffffff","store-info-background":"#ffffff","store-info-product-name-color":"#292929","store-info-product-name-hover":"#ffffff","store-info-price-color":"#666","store-info-price-hover":"#ffffff","store-ifno-after":"#b80000","store-info-hover":"#0a0a0a","store-info-button":"#b80000","store-info-button-text":"#ffffff","store-info-button-hover":"#d70000","store-info-button-text-hover":"#141414","cart-total-background":"#ffffff","cart-total-title-color":"#292929","order-table-th-backgtound":"#141414","order-table-th-text":"#ccc","order-table-td-background":"#fcfcfc","order-table-td-text":"#141414","team-alert-background":"#fcfcfc","woocommerce-checkout-payment":"#ebe9eb","woocommerce-checkout-payment-label":"#3d3d3d","quantity-number-backround":"#e6e6e6","quantity-number-text-color":"#141414","quantity-button-text-color":"#ffffff","price-filter-button-text-color":"#ffffff","shopping-cart-buttons-text-color":"#ffffff","shopping-cart-th-background":"#141414","shopping-cart-th-text":"#f7f7f7","shopping-cart-item-background":"#fcfcfc","shopping-cart-item-text-color":"#141414","shopping-cart-item-border-color":"#e6e6e6","shopping-cart-item-quantity-background":"#e6e6e6","shopping-cart-item-quantity-text-color":"#141414","shopping-cart-item-text-color-hover":"#141414","shopping-cart-item-background-hover":"#ffffff","shopping-cart-item-delete-background":"#f0f0f0","shopping-cart-item-delete-text-color":"#7a7a7a","shopping-cart-item-delete-background-hover":"#d70000","shopping-cart-item-delete-text-color-hover":"#ffffff","base-font":"Open Sans","sub-font":"Raleway","secondary-font":"Montserrat","image-dir-url":"wp-content\/themes\/team\/images","arrow-color":"#141414","arrow-hover":"#ffcc00","event-line-color":"#ffcc00","match-slider-text-color":"#fff","match-slider-mini-caption-bg":"#000000","match-slider-mini-caption-text-color":"#cccccc","match-slider-mini-caption-time-bg":"#141414","match-slider-mini-caption-time-text-color":"#ffffff","caption-color":"#141414","date-color":"#cccccc","name-color":"#ffffff","caption-hover":"#b80000","date-hover":"#ffffff","name-hover":"#ffffff"};
    /* ]]> */
</script>
<script type='text/javascript'
        src='{{ config('app.cloudfront.content') }}/plugins/msp/includes/vc/shortcodes/js/team_news_line.js?ver=1.0.19'></script>
</body>
</html>
<!--
Performance optimized by W3 Total Cache. Learn more: https://www.w3-edge.com/products/

Page Caching using memcached
Content Delivery Network via Amazon Web Services: CloudFront: d30zqwks4jlxlv.cloudfront.net

Served from: www.2017wwc.com @ 2017-08-22 19:31:38 by W3 Total Cache
-->
