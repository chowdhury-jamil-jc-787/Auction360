<x-backend.layouts.master>
    <x-slot:fav>Profile</x-slot:fav>
        <x-slot:title>Profile</x-slot:title>
        <x-slot:title1>Profile Details</x-slot:title1>
    @push('css')
    <style>
    .avatar {
      max-width: 100%;
      max-height: 100%;
      width: auto;
      height: auto;
    }

    </style>
    @endpush
    <div class="container">
        <h1>Edit Profile</h1>
          <hr>
        <div class="row">
          <!-- left column -->
          <div class="col-md-3">
            <div class="text-center">
            <img src="{{ asset(($profile->image ?? 'alt.jpg')) }}" class="avatar img-circle" alt="avatar">
              <h6>Upload a different photo...</h6>

        <form class="form-horizontal" role="form" method="POST" action="/update-profile/{{ Auth::user()->id }}" enctype="multipart/form-data">
        @csrf
              <input type="file" name="image" class="form-control" style="height: calc(1.5em + 1.75rem + -4px);">
            </div>
            <br>
          </div>

          <!-- edit form column -->
          <div class="col-md-9 personal-info">
            <div class="alert alert-info alert-dismissable">
              <a class="panel-close close" data-dismiss="alert">×</a>
              <i class="fa fa-coffee"></i>
              This is an <strong>.alert</strong>. User Can Modify Profile Here      </div>
            <h3>Personal info</h3>


            @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-lg-12">
                @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif


        <div class="form-group">
            <label class="col-lg-3 control-label">Full Name:</label>
            <div class="col-lg-8">
                <input class="form-control" type="text" name="name" value="{{ auth()->user()->name }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
                <input class="form-control" type="email" name="email" value="{{ auth()->user()->email }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Phone Number:</label>
            <div class="col-md-8">
                <input class="form-control" type="tel" name="phone_number" value="{{ $profile->phone_number ?? '' }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Address:</label>
            <div class="col-md-8">
                <textarea class="form-control" name="address">{{ $profile->address ?? '' }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-3"></div>
            <div class="col-md-8">
                <input type="submit" class="btn btn-primary" value="Save Changes">
            </div>
        </div>
    </form>
    <button id="change-password-btn" class="btn btn-primary" style="background-color: green; color: white;">Change Password</button>

    <div id="change-password-modal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="/profile/passwordChange/{{ Auth::user()->id }}" method="POST">
        @csrf
        <div id="message"></div>
        <div class="form-group">
            <label for="old-password">Old Password:</label>
            <input type="password" class="form-control" name="old-password" id="old-password">
        </div>
        <div class="form-group">
            <label for="new-password">New Password:</label>
            <input type="password" class="form-control" name="new-password" id="new-password">
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" class="form-control" name="confirm-password" id="confirm-password">
        </div>
        <button type="submit" class="btn btn-primary">Change</button>
    </form>
            <div class="modal-footer">
        <div id="success-container"></div>
        <div id="error-container" class="text-danger"></div>
    </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript code to handle the "Change Password" button click event -->
    <script>
      // Get a reference to the "Change Password" button
      var changePasswordBtn = document.getElementById('change-password-btn');

      // Get a reference to the password change modal
      var changePasswordModal = document.getElementById('change-password-modal');

      // Add a click event listener to the "Change Password" button
      changePasswordBtn.addEventListener('click', function() {
        // Show the password change modal
        changePasswordModal.style.display = 'block';
      });

      // Add a click event listener to the modal header close button
      var modalCloseBtn = changePasswordModal.querySelector('.close');
      modalCloseBtn.addEventListener('click', function() {
        // Hide the password change modal
        changePasswordModal.style.display = 'none';
      });
    </script>


          </div>
      </div>
    </div>
    <hr>


    <script>
        // get the file input and the image elements
    const fileInput = document.querySelector('input[type="file"]');
    const avatarImg = document.querySelector('.avatar');

    // add event listener to the file input
    fileInput.addEventListener('change', function() {
      // get the selected file
      const file = this.files[0];

      // create a URL for the file object
      const fileUrl = URL.createObjectURL(file);

      // update the image source with the new URL
      avatarImg.src = fileUrl;
    });
        </script>

    @push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    @endpush
    </x-backend.layouts.master>
