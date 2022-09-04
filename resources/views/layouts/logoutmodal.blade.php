<!-- Modal Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
          <h5>Are you sure you want to logout?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
          <a href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-primary">Logout</a>
          </form>
        </div>
      </div>
    </div>
  </div>