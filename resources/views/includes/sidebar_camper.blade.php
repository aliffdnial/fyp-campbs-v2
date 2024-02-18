<li class="nav-item">
  <a class="nav-link collapsed" href="{{ route('app.dashboard') }}">
    <i class="bi bi-grid"></i>
    <span>Dashboard</span>
  </a>
</li><!-- End Dashboard Nav -->

<li class="nav-item">
  <a class="nav-link collapsed" href="{{ route('app.booking.index') }}" onclick="showCancelAlert()">
    <i class="bi bi-stickies"></i><span>My Booking</span>
  </a>
</li><!-- End My Booking Nav -->

<li class="nav-item">
  <a class="nav-link collapsed" href="{{ route('app.complaint.index') }}">
    <i class="bx bxs-comment-edit"></i><span>My Complaint</span>
  </a>
</li><!-- End My Complaint Nav -->


<li class="nav-item">
  <a class="nav-link collapsed" href="{{ route('app.description.index') }}">
    <i class="bx  bx-map-pin"></i><span>View Lot</span>
  </a>
</li><!-- End View Lot Nav -->

<li class="nav-heading">Account</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="{{ route('app.profile.index') }}">
    <i class="bi bi-person-circle"></i><span>My Profile</span>
  </a>
</li><!-- End My Profile Nav -->

<!-- <li class="nav-item">
  <a class="nav-link collapsed" href="{{ route('app.logs') }}">
    <i class="bi bi-menu-button-wide"></i><span>View Logs</span>
  </a>
</li>End Error Log Nav -->

<li>
  <a class="nav-link collapsed btn btn-danger"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="bi bi-door-closed"></i><span>Logout</span>
  </a>
</li><!-- End Logout Nav -->

<script type="text/javascript">
  function showCancelAlert() {
    // Customize the alert message as needed
    alert("Please note that cancellations should be made 48 / 72 hours before start date of the booking.");
  }
</script>