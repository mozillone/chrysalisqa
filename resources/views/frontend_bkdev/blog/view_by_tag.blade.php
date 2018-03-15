@extends('/frontend/app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
@endsection
@section('content')
    <div class="container blog-sec">
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
            <span class="breadcrumb-item">Tags &nbsp;&gt;&nbsp;</span>
            <span class="breadcrumb-item active">{{$tag}}</span>
        </nav>

        <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="row">
                    @if(count($postsByTag))
                    @foreach($postsByTag as $blogPost)
                        <?php
                            if(isset($blogPost->img) && !empty($blogPost->img)){
                                $path = '/blog_images/listing/'.$blogPost->img;
                                if(file_exists(public_path($path))){
                                    $listingImage = URL::asset('/blog_images/listing/'.$blogPost->img);
                                }else{
                                    $listingImage = URL::asset('/blog_images/listing_placeholder.png');
                                }
                            }else{
                                $listingImage = URL::asset('/blog_images/listing_placeholder.png');
                            }
                        ?>
                        <div class="col-md-6">
                            <div class="blog-card">
                                <a href="/blog/{{ $blogPost->id }}"><div class="blog_img_div" style="background: url(<?php echo $listingImage; ?>)">
                                    </div></a>
                                <span class="text-muted">{{ date('d F Y', strtotime($blogPost->created_at)) }}</span>
                                <a href="/blog/{{ $blogPost->id }}"><h3 class="blog-title">{{ $blogPost->title }}</h3></a>
                                <p class="blog-description">{!! $blogPost->description !!}</p>
                                <hr/>
                                <strong>Categories:</strong>
                                @foreach($blogCategories as $category)
                                    @if($category->id == $blogPost->category_id)
                                        <small>{{$category->name}}</small>
                                    @endif
                                @endforeach
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
                        </div>
                    @endforeach
                    @else
                        <div>No Results Found</div>
                    @endif
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div style="float:right;">{{ $postsByTag->links() }}</div>
                </div>
            </div>
            <!-- end listing -->
            <div class="col-md-3">
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
			
			
			
			
			

        </div>
    </div>
@stop
@section('footer_scripts')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/assets/frontend/js/pages/blog_tag.js') }}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
@stop