<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown no-arrow">
         <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
           <i class="fas fa-search fa-fw"></i>
         </a>
         <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
          aria-labelledby="searchDropdown">
          <form class="navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
           </form>
          </div>
      </li>




      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span id="notificationCount" class="badge badge-danger badge-counter">0</span> <!-- Initially set to 0 -->
        </a>
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">Alerts Center</h6>
            <div id="notifications">
                <!-- Notifications will be dynamically populated here -->
            </div>
            <a class="dropdown-item text-center small text-gray-500" href="/notifications">Show All Alerts</a>
        </div>
    </li>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to fetch and display notifications
        function fetchNotifications() {
            $.ajax({
                url: '/notifications/unread', // Update URL to include user ID if needed
                type: 'GET',
                success: function(response) {
                    $('#notifications').empty(); // Clear previous notifications

                    var notificationCount = response.length; // Get the number of notifications

                    if (notificationCount > 0) {
                        var maxNotifications = 4; // Maximum number of notifications to show
                        for (var i = 0; i < Math.min(notificationCount, maxNotifications); i++) {
                            var notification = response[i];
                            var notificationDate = new Date(notification.created_at);
                            var formattedDate = notificationDate.toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric'
                            });

                            // Extract user ID and product ID from data JSON
                            var data = JSON.parse(notification.data);
                            var userId = data['user->id'];
                            var productId = data['product_id'];

                            // Customize the message based on user ID and product ID
                            var message = "User " + userId + " wants to bid on Product ID " + productId;

                            var dropdownItem = '<a class="dropdown-item d-flex align-items-center" href="#">';
                            dropdownItem += '<div class="mr-3">';
                            dropdownItem += '<div class="icon-circle bg-primary">';
                            dropdownItem += '<i class="fas fa-bell text-white"></i>'; // Default icon
                            dropdownItem += '</div></div>';
                            dropdownItem += '<div><div class="small text-gray-500">' + formattedDate + '</div>';
                            dropdownItem += '<span class="font-weight-bold">' + message + '</span>';
                            dropdownItem += '</div></a>';

                            $('#notifications').append(dropdownItem);
                        }
                    }

                    $('#notificationCount').text(notificationCount); // Update notification count
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Fetch notifications initially and then every 2 seconds
        $(document).ready(function() {
            fetchNotifications(); // Fetch notifications initially
            setInterval(fetchNotifications, 2000); // Fetch notifications every 2 seconds
        });
    </script>












      <div class="topbar-divider d-none d-sm-block"></div>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          @if(auth()->user()->profile)
        <img class="img-profile rounded-circle" src="{{ asset(auth()->user()->profile->image) }}" style="max-width: 60px">
        @else
        <!-- Default image or placeholder -->
        <img class="img-profile rounded-circle" src="{{ asset('default-profile-image.jpg') }}" style="max-width: 60px">
        @endif

          <span class="ml-2 d-none d-lg-inline text-white small">{{ auth()->user()->name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="/profile/edit/{{ Auth::user()->id }}">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
          </a>
          {{-- <a class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Settings
          </a>
          <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            Activity Log
          </a> --}}
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
