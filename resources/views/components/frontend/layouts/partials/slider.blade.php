<style>
    .cover-slides {
        height: 650px; /* Set the desired height here */
    }
</style>

<div id="slides-shop" class="cover-slides">
    <ul class="slides-container">
        @foreach($imageSliders as $imageSlide)
        <li class="text-center">
            <img src="{{ asset('storage/Image_slider/').'/'. $imageSlide->image }}" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Auction360</strong></h1>
                        <p class="m-b-40">Welcome to Auction360! Experience the thrill of auctions like never before.</p>
                        <p><a class="btn hvr-hover" href="#">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    <div class="slides-navigation">
        <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
</div>

