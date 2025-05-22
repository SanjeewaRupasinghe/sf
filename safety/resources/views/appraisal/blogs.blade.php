@extends('appraisal.template')
@section('content')
<section class="inerHeader">
    <div class="container">
        <marquee behavior="" direction="">
            <div class="row">
                <div class="col" style="max-width: 60px;">
                    <img src="{{ asset('site/img/giphy.webp')}}" alt="" style="width: 60px;">
                </div>
                <div class="col ps-0 ms-0" style="max-width:200px;">
                    <h1>@lang('course/innerpage.Insights')</h1>
                </div>
            </div>
        </marquee>
    </div>
</section>
<section id="blog-item" class="blog-item-post">
    <div class="container">
        <div class="blog-content-details">
            <div class="row">
                <div class="col-md-9">
                    <div class="blog-post-content">
                        <div class="row">
                            @foreach ($blogs as $blog)
                            <div class="col-md-6 col-sm-12">
                                <div class="blog-post-img-content">
                                    <div class="blog-img-date relative-position">
                                        <div class="blog-thumnile">
                                            <img src="{{ asset('storage/blog/thumb_'.$blog->image)}}" alt="">
                                        </div>
                                        <div class="course-price text-center genius-btn">
                                            <span>{{Carbon\Carbon::parse($blog->publish)->format('F Y')}}</span>
                                        </div>
                                    </div>
                                    <div class="blog-title-content headline">
                                        <h3>
                                            <a href="{{ asset('/appraisal/blog/'.$blog->slug)}}">
                                                @if(app()->getLocale()=='en'){{$blog->name}} @else {{$blog->ar_name}} @endif
                                            </a>
                                        </h3>
                                        <div class="blog-content">
                                            @if(app()->getLocale()=='en')
                                            @php $short= substr(strip_tags($blog->description),0,100); @endphp
                                            @else
                                            @php $short= substr(strip_tags($blog->ar_description),0,100); @endphp
                                            @endif
                                            {{$short}}...
                                        </div>
                                        <div class="view-all-btn bold-font">
                                            <a href="{{ asset('/appraisal/blog/'.$blog->slug)}}">@lang('course/innerpage.Readmore') <i class="fas fa-chevron-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>	
			                @endforeach	
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @include('site.blogright')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection