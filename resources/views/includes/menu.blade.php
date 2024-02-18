<nav class="text-white text-base font-semibold pt-3">
    <a href="/dashboard" class="flex items-center text-white opacity-75 py-4 pl-6 nav-item">
        Home
    </a>

    <a href="/bookings" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
        Bookings
    </a>

    <a href="/description" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
        Description
    </a>

    <a href="/complaint/create" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
        Complaint
    </a>

    <a href="{{ route('camper.profile', auth()->user()) }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
        Profile
    </a>
</nav>