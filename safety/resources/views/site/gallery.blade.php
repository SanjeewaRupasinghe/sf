@extends('site.template')

@section('content')



<section class="inerHeader">

<div class="container">

	 <marquee behavior="" direction="">

            <div class="row">

                <div class="col" style="max-width: 60px;">

                    <img src="{{ asset('site/img/giphy.webp')}}" alt="" style="width: 60px;">

                </div>

                <div class="col ps-0 ms-0" style="max-width:200px;">

                    <h1>@lang('course/innerpage.Gallery')</h1>

                </div>

            </div>

        </marquee>

</div>

</section>



<section class="courseSection pt-5 pb-5">

    <div class="container">



        <div class="row">
            @foreach ($results as $res)
            <div class="col-md-3 mb-3">
                <a href="{{asset('storage/gallery/'.$res->image)}}" class="" data-lightbox="roadtrip">
                    <img src="{{asset('storage/gallery/thumb_'.$res->image)}}" class="img-fluid" />
                </a>
            </div>  
            @endforeach

           

        </div>

    </div>

</section>



@endsection