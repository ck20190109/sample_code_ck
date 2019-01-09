@include('view_header')
<?php if (config('app.layout.left')==true) { ?>
@include('view_left')
<?php } ?>

<div class="content">
<div class="container ">
<div class="row">
    <div class="col-sm-12 col-md-9">
        <div class="row no-gutter">
            <div class="col-md-12">
                <h4>{{ __('lang._NEWS_Results') }} "{{ $news_post[0]->post_name }}"</h4>
                <div class="search-field">
                    <form role="search" method="get" action="{{ url('/')."/".$news_lang."News/NewsWithTimeLine/Search" }}/">
                        <div class="wrap">
                            <input type="text" placeholder="Search ..." value="{{ $s }}" name="s" title="Search for:">
                            <input type="hidden" name="page" value="{{ $page }}"/>
                            <button><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <?php for($i = 0;$i < count($Search);$i++) { ?>
                <div class="row search-item">
                    <?php if($Search[$i]->img != "") { ?>
                    <div class="col-md-4">
                        <div class="image">
                            <img class="img-responsive" src="{{ config('app.cloudfront.content') }}/uploads/{{ $Search[$i]->img }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <?php }
                        else { ?>
                        <div class="col-md-12">
                            <?php } ?>
                            <div class="info">
                                <a href="{{ url('/') }}/<?php if ($Search[$i]->post_type == 'post') echo 'News/NewsWithTimeLine/' . $Search[$i]->date_route . '/'; ?>{{ $Search[$i]->post_name }}/"
                                   class="name">{{ $Search[$i]->post_title }}</a>
                                <div class="wrap">
                                    <a href="{{ url('/') }}/{{ $news_lang }}News/NewsWithTimeLine/{{ $Search[$i]->date_route }}/">{{ $Search[$i]->format_date }}</a>
                                    by {{ $Search[$i]->post_author }}
                                </div>
                                <p> <?php echo html_entity_decode($Search[$i]->read_more); ?>[&hellip;]</p>
                                <p>
                                    <a href="{{ url('/') }}/<?php if ($Search[$i]->post_type == 'post') echo 'News/NewsWithTimeLine/' . $Search[$i]->date_route . '/'; ?>{{ $Search[$i]->post_name }}/"
                                       class="read-more">read more</a></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="pagination-wrap">
                        {{ $Search->appends(['s' => $s])->links() }}
                    </div>

                </div>
            </div>
        </div>

        <div class="sidebar col-sm-12 col-md-3" id="sidebar">
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
</div>

<?php if (config('app.layout.right')==true) { ?>
@include('view_right')
<?php } ?>
@include('view_footer')
