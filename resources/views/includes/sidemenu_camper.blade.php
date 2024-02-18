<!-- <a href="{{ route('app.dashboard') }}" class="btn btn-primary w-100 mb-1">Dashboard</a>
<a href="{{ route('app.booking.index') }}" class="btn btn-secondary w-100 mb-1">My Booking</a>
<a href="{{ route('app.description.index') }}" class="btn btn-warning w-100 mb-1">View Lot</a>
<a href="{{ route('app.complaint.index') }}" class="btn btn-success w-100 mb-1">My Complaint</a>
<a href="{{ route('app.profile.index') }}" class="btn btn-info w-100 mb-1">My Profile</a>
<button class="btn btn-danger w-100 mb-1" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</button> -->

<hr>
<div class="d-flex flex-column flex-shrink-0 bg-body-tertiary" style="width: 200px;">
  <!-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
    <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
    <span class="fs-4">Sidebar</span>
  </a>
  <hr> -->
  <ul class="nav nav-pills flex-column mb-2">
    <li class="nav-item">
      <a href="{{ route('app.dashboard') }}" class="nav-link link-body-emphasis text-black">
        <svg class="bi pe-none me-2" width="15" height="20"><use xlink:href="#home"/></svg>
        Home
      </a>
    </li>
    <li>
      <a href="{{ route('app.booking.index') }}" class="nav-link link-body-emphasis text-black" onclick="showCancelAlert()">
        <svg class="bi pe-none me-2" width="15" height="20"><use xlink:href="#speedometer2"/></svg>
        My Booking
      </a>
    </li>
    <li>
      <a href="{{ route('app.description.index') }}" class="nav-link link-body-emphasis text-black">
        <svg class="bi pe-none me-2" width="15" height="20"><use xlink:href="#table"/></svg>
        View Lot
      </a>
    </li>
    <li>
      <a href="{{ route('app.complaint.index') }}" class="nav-link link-body-emphasis text-black">
        <svg class="bi pe-none me-2" width="15" height="20"><use xlink:href="#grid"/></svg>
        My Complaint
      </a>
    </li>
    <li>
      <a href="{{ route('app.profile.index') }}" class="nav-link link-body-emphasis text-black">
        <svg class="bi pe-none me-2" width="15" height="20"><use xlink:href="#people-circle"/></svg>
        My Profile
      </a>
    </li>
  </ul>
  <hr>
  <ul class="nav nav-pills flex-column mb-2">
    <li>
      <a class="nav-link link-body-emphasis text-black btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
      </a>
    </li>
  </ul>
</div>

<script type="text/javascript">
  function showCancelAlert() {
    // Customize the alert message as needed
    alert("Please note that cancellations should be made 48 / 72 hours before start date of the booking.");
  }
</script>
