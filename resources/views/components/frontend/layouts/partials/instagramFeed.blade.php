<div class="instagram-box">
    <div class="main-instagram owl-carousel owl-theme">
        @foreach($galleries as $gallery)
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->name }}" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
