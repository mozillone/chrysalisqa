@extends('/frontend/app')
@section('styles')
@endsection
@section('content')
<style>

</style>
    <div class="container press-page">

        <div class="row">
            <div class="col-md-12">
                <div class="progressbar_main request-bag">
                    <h2>PRESS</h2>
                </div>
            </div>
            <!-- Posts listing -->
            <div class="col-md-9 col-sm-9 col-xs-12 press-articles">
                <?php
                $count=count($posts);
                if($count > 0 ){ ?>
                @foreach($posts as $key => $value)
                <div class="media">
                    <div class="media-left">
                        <img src="@if(isset($value->user_img) && !empty($value->user_img)){{'../press_images/'.$value->user_img}} @else {{ '../press_images/default_pic.png' }} @endif" class="media-object">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{$value->press_title}}</h4>
                        <span>{{date('d M Y', strtotime($value->created_at))}}</span>
                        <strong><a href="{{ $value->source }}" target="_blank" >{{ $value->source }}</a></strong>
                        <p>{!!$value->press_desc!!}​​​​​​​</p>
                    </div>
                </div>
                 <hr>
                @endforeach
               
                <div style="float:right;">{{ $posts->links() }}</div>
                <?php } else { ?>
                <div> No Results Found</div>
                <?php } ?>
            </div>
            <!-- end posts listing -->

            <div class="col-md-3 col-sm-3 col-xs-12  press-articles_right">
                <div class="press-filters">
                    <h2>FILTERS</h2>
                    <p><a href="press">Most Recent</a></p>
                    <p>Most Popular</p>
                    <p>Most Shared</p>
                    <h2>RECENT BLOG POSTS</h2>
                    @foreach($blogPosts as $blogPost)
                    <div class="media">
                        <div class="media-left">
                            <img src="@if(isset($blogPost->img) && !empty($blogPost->img)){{'../blog_images/'.$blogPost->img}} @else {{ '' }} @endif" class="media-object" style="width:60px">
                        </div>
                        <div class="media-body">
                            <span>{{ date('d F Y', strtotime($blogPost->created_at)) }}</span>
                            <a href="/blog/{{$blogPost->id}}"><h5 class="media-heading">{{ $blogPost->title }}</h5></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@stop
@section('footer_scripts')
@stop