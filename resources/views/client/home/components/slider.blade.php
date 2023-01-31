<section id="slider">
    <!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    
                    <div class="carousel-inner">
                        @foreach($sliders as $key => $slider)
                        <div class="item {{ $key == 0 ? 'active' : '' }}">
                            <div class="col-sm-6">
                                <h1><span>TAN</span>-APPLE</h1>
                                <h2>{{ $slider->name }}</h2>
                                <p>{{ $slider->description }}</p>
                                {{-- <button type="button" class="btn btn-default get">Mua ngay</button> --}}
                            </div>
                            <div class="col-sm-6">
                                <img style="width: 100%" src="{{ $slider->image_path }}" class="girl img-responsive" alt="" />
                                {{-- <img src="eshopper/images/home/pricing.png" class="pricing" alt="" /> --}}
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div style="padding-top: 50px">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
