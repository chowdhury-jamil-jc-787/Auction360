<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p>Are you sure you want to logout?</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
        <a href="{{ route('logout') }}" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

  </div>
</div>
</div>
