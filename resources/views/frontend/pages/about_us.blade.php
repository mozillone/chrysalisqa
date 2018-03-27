@extends('/frontend/app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/owl.carousel.min.css')}}">
@endsection
@section('content')

    <?php echo $pageData->description ?>

    <div class="aboutblogslider_div about_main_div ">
        <div class="container">
            <div class="row about_blog_slider-btm">
                <div class="col-md-12">
                    <h2 class="sub-heading">From the Blog</h2>
                </div>
                <div class="about_div_scrl owl-carousel">
                    @if(count($blogPosts))
                        @foreach($blogPosts as $blog)
                            <?php
                            if(isset($blog->img) && !empty($blog->img)){
                                $path = '/blog_images/listing/'.$blog->img;
                                if(file_exists(public_path($path))){
                                    $listingImage = URL::asset('/blog_images/listing/'.$blog->img);
                                }else{
                                    $listingImage = URL::asset('/blog_images/listing_placeholder.png');
                                }
                            }else{
                                $listingImage = URL::asset('/blog_images/listing_placeholder.png');
                            }
                            ?>
                            <div class="item">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="blog-card">
                                        <div class="about_bnr blog_img_div" style="background: url(<?php echo $listingImage; ?>)">
                                        </div>
                                        <span class="text-muted">{{ date('d F Y', strtotime($blog->created_at)) }}</span>
                                        <a href="/blog/{{ $blog->id }}"><h3 class="blog-title">{{ $blog->title }}</h3></a>
                                        <p class="blog-description">{!! $blog->description !!}</p>
                                        <strong>Categories:</strong>
                                        @foreach($blogCategories as $category)
                                            @if($category->id == $blog->category_id)
                                                <small>{{$category->name}}</small>
                                            @endif
                                        @endforeach
                                        <div class="abt_tags">
                                            @if(isset($blog->tags) && !empty($blog->tags))
                                                <?php $count = 0 ;?>
                                                @foreach(explode(',', $blog->tags) as $tag)
                                                    <?php $count++; ?>
                                                    @if($count>1){{', '}}@endif<a href="/blog/tag/{{ $tag }}"><i class="fa fa-tag" aria-hidden="true"></i><span>{{$tag}}</span></a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div>No Records Found</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop
@section('footer_scripts')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/assets/frontend/js/pages/about.js') }}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
    <script src="{{ asset('/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('/assets/frontend/js/owl.carousel.min.js')}}"></script>
@stop