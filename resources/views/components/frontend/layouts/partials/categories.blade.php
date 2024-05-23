<div class="categories-shop">
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{ asset($category->image) }}" alt="" />
                    <a class="btn hvr-hover" href="#">{{ $category->title }}</a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
