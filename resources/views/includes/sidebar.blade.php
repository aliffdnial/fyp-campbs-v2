<li class="nav-item">
  <a class="nav-link" href="{{ route('app.admin.dashboard') }}">
    <i class="bi bi-grid"></i>
    <span>Dashboard</span>
  </a>
</li><!-- End Dashboard Nav -->

<li class="nav-item">
  <a class="nav-link collapsed" href="{{ route('app.admin.booking.index') }}">
    <i class="bi bi-stickies"></i><span>Manage Booking</span>
  </a>
</li><!-- End Manage Booking Nav -->

<li class="nav-item">
  <a class="nav-link collapsed" href="{{ route('app.admin.lot.index') }}">
    <i class="bi bi-geo"></i><span>Manage Lot</span>
  </a>
</li><!-- End Manage Lot Nav -->
<li class="nav-item">
  <a class="nav-link collapsed" href="{{ route('app.admin.complaint.index') }}">
    <i class="bx bxs-comment-edit"></i><span>Manage Complaint</span>
  </a>
</li><!-- End Manage Complaint Nav -->

<li class="nav-heading">Account</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="{{ route('app.admin.camper.index') }}">
    <i class="bi bi-people"></i><span>Manage Camper</span>
  </a>
</li><!-- End Manage Camper Nav -->

<!-- <li class="nav-item">
  <a class="nav-link collapsed" href="{{ route('app.admin.logs') }}">
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