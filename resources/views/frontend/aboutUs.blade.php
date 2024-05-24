<x-frontend.layouts.master>
@push('css')

@endpush

        <!-- Start Main Top -->
        <x-frontend.layouts.partials.startMainTop/>
        <!-- End Main Top -->

        <!-- Start Main Top -->
        <x-frontend.layouts.partials.header/>
        <!-- End Main Top -->

        <!-- Start Top Search -->
        <x-frontend.layouts.partials.topSearch/>
        <!-- End Top Search -->

        <div
  class="container min-vh-100 d-flex justify-content-center align-items-center bg-white"
>
  <div class="row w-100">
    <div class="col-md-6 text-justify p-4 p-md-5">
      <div class="w-25 h-2 bg-info mb-2"></div>
      <h1 class="font-weight-bold text-secondary">WHO WE ARE</h1>
      <h1 class="mb-3 mb-md-4 display-4 font-weight-extrabold">
        ABOUT <span class="text-info">US</span>
      </h1>
      <p>
        Our company is a small business that is dedicated to providing the best
        quality products to our customers. We have been in business for over 10
        years and have a great reputation in the industry. Our team is made up
        of experienced professionals who are passionate about what they do. We
        take pride in our work and strive to provide the best customer service
        possible. Our goal is to make sure that every customer is satisfied with
        their purchase and has a great experience shopping with us. We are
        always looking for ways to improve our products and services, so if you
        have any feedback or suggestions, please let us know. Thank you for
        choosing us!
      </p>
      <button
        class="btn btn-info text-white font-weight-semibold px-4 py-2 my-4"
      >
        Learn more
      </button>
    </div>
    <div class="col-md-6 p-4 p-md-5">
      <img
        class="img-fluid"
        src="https://st2.depositphotos.com/3591429/10464/i/450/depositphotos_104648666-stock-photo-group-of-people-brainstorming-on.jpg"
        alt="About Us"
      />
    </div>
  </div>
</div>


        <!-- Start Footer  -->
        <x-frontend.layouts.partials.footer/>
        <!-- End Footer  -->

</x-frontend.layouts.master>