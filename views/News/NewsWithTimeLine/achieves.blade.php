@include('view_header')
<?php if (config('app.layout.left')==true) { ?>
@include('view_left')
<?php } ?>

<div class="content">
<div class="container ">
<div class="row">
    <div class="col-sm-12 col-md-9">
        <div class="news-list">
            <h4 style="text-align: left;padding-bottom: 0;padding-top: 40px;" class="vc_custom_heading">{{ __('lang._NEWS_RecentNews') }}</h4>

            <?php for($i = 0;$i < count($month_news);$i++) { ?>
            <div id="{{ $month_news[$i]->post_type }}-{{ $month_news[$i]->ID }}"
                 class="item img-top {{ $month_news[$i]->post_type }}-{{ $month_news[$i]->ID }} post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
                <div class="img-wrap">
                    <a href="{{ url('/') }}/News/NewsWithTimeLine/{{ $month_news[$i]->date_route }}/{{ $month_news[$i]->post_name }}/">
                        <img src="{{ config('app.cloudfront.content') }}/uploads/{{ $month_news[$i]->img }}"
                             alt="{{ $month_news[$i]->post_title }}">
                    </a>
                </div>
                <div class="info">
                    <a href="{{ url('/') }}/News/NewsWithTimeLine/{{ $month_news[$i]->date_route }}/{{ $month_news[$i]->post_name }}/"
                       class="name">{{ $month_news[$i]->post_title }}</a>

                    <div class="wrap">
                        <a href="{{ url('/') }}/{{ $news_lang }}News/NewsWithTimeLine/{{ $month_news[$i]->date_route }}/">{{ $month_news[$i]->format_date }}</a>
                    </div>
                    <div class="clear"></div>


                    <div class="clear"></div>
                </div>
            </div>
            <?php } ?>

            <div class="pagination-wrap">
                {{ $month_news->links() }}
            </div>

        </div>


    </div>
    <div class="sidebar col-sm-12 col-md-3" id="sidebar">
        <div id="search-7" class="widget widget_search"><h6>{{ __('lang._NEWS_Search') }}</h6>
            <form role="search" method="get" action="{{ url('/')."/".$news_lang."News/NewsWithTimeLine/Search" }}/">
                <div class="wrap">
                    <input type="text" placeholder="Search ..." value="{{ $s }}" name="s" title="Search for:">
                    <button><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </form>

        </div>
        <div id="timeline_widget-2" class="widget widget_timeline_widget"><h6>{{ __('lang._NEWS_Timeline') }}</h6>
            <ul>
                <?php for ($i = 0;$i < count($TimeLine);$i++) { ?>
                <li>
                    <div class="clearfix">
                        <div class="timeline-date">{{ $TimeLine[$i]->format_month .' '.substr($TimeLine[$i]->post_date,0,4) }}</div>
                        <div class="timeline-title">{{ $TimeLine[$i]->post_title }}</div>
                    </div>
                    <div class="clearfix">
                        <div class="timeline-line"></div>
                        <div class="timeline-content">
                            <p><?php echo html_entity_decode($TimeLine[$i]->post_content) ?></p>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div id="calendar-3" class="widget widget_calendar"><h6>{{ __('lang._NEWS_Archives') }}</h6>
            <div id="calendar_wrap">
                <?php echo html_entity_decode($News_Achieves); ?>
            </div>
        </div>
        <div id="posts_galary_widget-2" class="widget widget_posts_galary_widget"><h6>{{ __('lang._NEWS_Gallery') }}</h6>
            <style>
                .posts-galary-widget .title {
                    position: absolute;
                    bottom: 0;

                    max-height: 0px;
                    overflow-y: hidden;
                    -webkit-transition: max-height 1s ease;
                    -moz-transition: max-height 1s ease;
                    -ms-transition: max-height 1s ease;
                    -o-transition: max-height 1s ease;
                    transition: max-height 1s ease;
                }

                .posts-galary-widget:hover .title {
                    max-height: 200px;
                    -webkit-transition: max-height 1s ease;
                    -moz-transition: max-height 1s ease;
                    -ms-transition: max-height 1s ease;
                    -o-transition: max-height 1s ease;
                    transition: max-height 1s ease;
                }

                .posts-galary-widget .title p {
                    margin-bottom: 0;
                    padding: 10px;
                    font-size: 14px;
                    line-height: 1;
                    color: #FFF;
                    background-color: rgba(20, 20, 20, .7);
                }

                .posts-galary-widget .owl-prev,
                .posts-galary-widget .owl-next {
                    position: absolute;
                    top: 37%;
                    background-color: rgba(20, 20, 20, .7) !important;
                }

                .posts-galary-widget .owl-prev {
                    left: 0;
                }

                .posts-galary-widget .owl-next {
                    right: 0;
                }
            </style>
            <script>
                (function ($) {
                    $(document).ready(function () {
                        $(".owl-carousel").owlCarousel({
                            autoplay: true,
                            autoplayTimeout: 2000,
                            loop: true,
                            autoplayHoverPause: true,
                            items: 1,
                            dots: false,
                            nav: true,
                            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
                        });
                    });
                })(jQuery);
            </script>
            <div class="owl-carousel owl-theme posts-galary-widget">
                <?php for ($i = 0;$i < count($News);$i++) { ?>
                <a href="{{ url('/') }}/News/NewsWithTimeLine/{{ $News[$i]->date_route }}/{{ $News[$i]->post_name }}/">
                    <img src="{{ config('app.cloudfront.content') }}/uploads/{{ $News[$i]->m_img }}">
                    <div class="title">
                        <p>{{ $News[$i]->post_title }}</p>
                    </div>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php if (config('app.layout.right')==true) { ?>
@include('view_right')
<?php } ?>
@include('view_footer')
