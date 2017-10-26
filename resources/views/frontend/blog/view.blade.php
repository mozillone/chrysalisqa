@extends('/frontend/app')
@section('styles')
<link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5980685de0404c0012139258&product=inline-share-buttons' async='async'></script>
<style>
	
	
</style>
@endsection
@section('content')
    <div class="container blog-sec blog-article">
        <div class="row">
            <div class="col-md-12 blog-progerss-bar">
                <div class="progressbar_main request-bag">
                    <h2>BLOG</h2>
                </div>
            </div>
        </div>
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="/">Home &nbsp;&gt;&nbsp;</a>
            <a class="breadcrumb-item" href="/blog">Blog &nbsp;&gt;&nbsp;</a>
            <span class="breadcrumb-item">
                @foreach($blogCategories as $category)
                    @if($category->id == $blogPost->category_id)
                        {{$category->name}}
                    @endif
                @endforeach
                &nbsp;&gt;
            </span>
            <span class="breadcrumb-item active">{{ $blogPost->title }}</span>
        </nav>
        <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-12">

                <?php
                if(isset($blogPost->img) && !empty($blogPost->img)){
                    $path = '/blog_images/banner/'.$blogPost->img;
                    if(file_exists(public_path($path))){
                        $listingImage = URL::asset('/blog_images/banner/'.$blogPost->img);
						}else{
                        $listingImage = URL::asset('/blog_images/banner_placeholder.png');
					}
					}else{
                    $listingImage = URL::asset('/blog_images/banner_placeholder.png');

                }
                ?>

                <div class="banner_img_div" style="background: url(<?php echo $listingImage; ?>)">
                </div>
                <span class="blog_date" >{{ date('d F Y', strtotime($blogPost->created_at)) }}</span>
                <h3>{{ $blogPost->title }}</h3>
				  <div class="col-md-6 col-sm-6 col-xs-12 hidden-lg hidden-md hidden-sm mobile-spl-fav_social">
                            <div class="fav_social">
                                <div class="sharethis-inline-share-buttons" data-url="{{URL::to('/blog/'.$blogPost->id.'')}}" data-title="{{$blogPost->title}}"></div>
                            </div>
                        </div>
                <p>{!! $blogPost->description !!}</p>
                <hr>
                    <div class="row blog_share">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="abt_tags">
                                @if(isset($blogPost->tags) && !empty($blogPost->tags))
                                    <?php $count = 0; ?>
                                    @foreach(explode(',', $blogPost->tags) as $tag)
                                        <?php $count++; ?>
                                        @if($count>1){{', '}}@endif<a href="/blog/tag/{{ $tag }}"><i class="fa fa-tag" aria-hidden="true"></i><span>{{$tag}}</span></a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 hidden-xs">
                            <div class="fav_social">
                                <div class="sharethis-inline-share-buttons" data-url="{{URL::to('/blog/'.$blogPost->id.'')}}" data-title="{{$blogPost->title}}"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
					    <div class="col-md-12">
                        <div class="list-sec-rm  blog_sinle_brdr">
                            <p class="list-sec-rm1">COMMENTS</p>

                        </div>
                    </div>
					</div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 hidden-xs ">
                <div class="press-filters">
                    <h2>CATEGORIES</h2>
                    @if(count($blogCategories))
                        @foreach($blogCategories as $category)
                            <?php $categoryName = preg_replace('/\s+/', '-', $category->name);
                            $categorySlug = strtolower($categoryName);
                            ?>
                            <p><a href="/blog/category/{{$category->id}}/{{$categorySlug}}">{{ $category->name }}</a></p>
                        @endforeach
                    @else
                        <p>No Results Found</p>
                    @endif
                    <h2>ARCHIVES</h2>
                    @if(count($yearFilters))
                        @foreach($yearFilters as $filter)
                            <a href="/blog/archive/{{$filter->year}}"><p>{{ $filter->year }}</p></a>
                        @endforeach
                    @else
                        <p>No Results Found</p>
                    @endif
                </div>
            </div>

            <div class="panel-group-mobile-cms  " id="accordion" role="tablist" aria-multiselectable="true">

                <div class="panel panel-default">
                    <div class="panel-group-mobile-cms hidden-md hidden-lg hidden-sm" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                                FILTER BLOG <i class="more-less glyphicon glyphicon-plus"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" class="hidden-md hidden-lg hidden-sm">
                        <div class="panel-body">
                            <div class="press-filters">
                                @if(count($blogCategories))
                                    @foreach($blogCategories as $category)
                                        <?php $categoryName = preg_replace('/\s+/', '-', $category->name);
                                        $categorySlug = strtolower($categoryName);
                                        ?>
                                        <p><a href="/blog/category/{{$category->id}}/{{ $categorySlug }}">{{ $category->name }}</a></p>
                                    @endforeach
                                @else
                                    <p>No Results Found</p>
                                @endif
                                <h2>ARCHIVES</h2>
                                @if(count($yearFilters))
                                    @foreach($yearFilters as $filter)
                                        <a href="/blog/archive/{{$filter->year}}"><p>{{ $filter->year }}</p></a>
                                    @endforeach
                                @else
                                    <p>No Results Found</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- panel-group-mobile-cms -->
        </div>

        <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-12 cmt_lft_artle">
                <div id="fb-root">

                </div>
                <div class="fb-comments" data-href="http://chrysalisqa.local.dotcomweavers.net/blog/{{$blogPost->id}}" data-numposts="5">

                </div>
            </div>
        </div>
    </div>

@stop
@section('footer_scripts')

    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/assets/frontend/js/pages/blog_view.js') }}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>

@stop