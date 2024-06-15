<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="custom-select-box">
                    <select id="currency-select" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                        <option value="" disabled selected>Select Currency</option>
                        <option value="bdt">৳ BDT</option>
                    </select>
                </div>
                <div class="right-phone-box">
                    <p>Call US :- <a href="#"> +11 900 800 100</a></p>
                </div>
                <div class="our-link">
                    <ul>
                        <li><a href="/login"><i class="fa fa-user s_color"></i> My Account</a></li>
                        <li><a href="#"><i class="fas fa-headset"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div id="login-box" class="login-box">
                    <select id="auth-select" class="selectpicker show-tick form-control">
                        <!-- Options will be dynamically added by JavaScript -->
                    </select>
                </div>
                <div class="text-slid-box">
                    <div id="offer-box" class="carouselTicker">
                        <ul class="offer-box">
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT80
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 100% cash on delivery
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Money item
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
   // Simulate user login state
var isLoggedIn = true; // Change to true to simulate logged-in state

document.addEventListener('DOMContentLoaded', function() {
    var authSelect = document.getElementById('auth-select');

    if (authSelect) {
        // Populate the authentication select box
        authSelect.innerHTML = `
            <option value="" disabled selected>login Option</option>
            <option value="/dashboard">login</option>
        `;

        authSelect.addEventListener('change', function() {
            var selectedOption = this.value;

            // Redirect the user based on the selected option
            if (selectedOption === "register") {
                window.location.href = "/register"; // Redirect to the registration route
            } else if (selectedOption === "login") {
                window.location.href = "/login"; // Redirect to the login route
            } else if (selectedOption === "/dashboard") {
                window.location.href = "/dashboard"; // Redirect to the dashboard route
            }
        });
    }
});
</script>
