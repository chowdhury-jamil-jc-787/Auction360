<!-- resources/views/contactUs.blade.php -->

<x-frontend.layouts.master>
    <!-- Start Main Top -->
    <x-frontend.layouts.partials.startMainTop/>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <x-frontend.layouts.partials.header/>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <x-frontend.layouts.partials.topSearch/>
    <!-- End Top Search -->

    <div class="container min-vh-100 d-flex justify-content-center align-items-center bg-white">
        <div class="row w-100 content-wrapper">
            <div class="col-md-6 text-justify p-4 p-md-5">
                <!-- Contact Form -->
                <div class="contact-form">
                    <h1 class="font-weight-bold text-secondary">Contact Us</h1>
                    <p>If you have any questions or inquiries, feel free to contact us using the form below.</p>
                    <form>
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Enter your message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 p-4 p-md-5">
                <!-- Contact Information -->
                <div class="contact-info">
                    <h2 class="font-weight-bold text-secondary">Our Contact Information</h2>
                    <p>If you prefer to reach out to us directly, you can use the contact information provided below.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt"></i> Address: Michael I. Days 3756, Preston Street, Wichita, KS 67213</li>
                        <li><i class="fas fa-phone-square"></i> Phone: <a href="tel:+1-888705770">+1-888 705 770</a></li>
                        <li><i class="fas fa-envelope"></i> Email: <a href="mailto:auction360@gmail.com">auction360@gmail.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Footer  -->
    <x-frontend.layouts.partials.footer/>
    <!-- End Footer  -->
</x-frontend.layouts.master>
