<a href="{{ route('app.admin.dashboard') }}" class="btn btn-primary w-100 mb-1">Dashboard</a>
<a href="{{ route('app.admin.booking.index') }}" class="btn btn-success w-100 mb-1">Manage Booking</a>
<a href="{{ route('app.admin.lot.index') }}" class="btn btn-success w-100 mb-1">Manage Lot</a>
<a href="{{ route('app.admin.complaint.index') }}" class="btn btn-success w-100 mb-1">Manage Complaint</a>
<a href="{{ route('app.admin.camper.index') }}" class="btn btn-success w-100 mb-1">Manage Camper</a>
<a href="{{ route('app.admin.logs') }}" class="btn btn-secondary w-100 mb-1">View Error Log</a>
<button class="btn btn-danger w-100 mb-1" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</button>