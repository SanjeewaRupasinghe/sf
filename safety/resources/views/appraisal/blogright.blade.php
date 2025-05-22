<div class="side-bar">
    <div class="side-bar-search">
        <form action="" method="get">
            <input type="text" class="" name="q" placeholder="Search Insights">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="side-bar-widget">
        <h2 class="widget-title text-capitalize">@lang('course/innerpage.InsightRight1')</h2>
        <div class="post-categori ul-li-block">
            <ul>
                @foreach ($cats as $cat)
                <li class="cat-item  "><a href="#">@if(app()->getLocale()=='en'){{$cat->name}} @else {{$cat->ar_name}} @endif  <!--<span>({{$cat->count->count()}})</span>--></a></li>	
                @endforeach                                    
            </ul>
        </div>
    </div>
    <div class="side-bar-widget">
        <h2 class="widget-title text-capitalize">@lang('course/innerpage.InsightRight2')</h2>
        <div class="tag-clouds ul-li">
            <ul>
                @foreach ($tags as $tag)
                <li><a href="#" class="tag-cloud-link">{{$tag}}</a></li>
                @endforeach                                   
            </ul>
        </div>
    </div>
</div>