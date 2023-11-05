{{-- <div class="container-fluid">
    <h1>Home Page</h1>
    <p class="lead">You are viewing the home page. Please login to view the restricted data.</p>
</div> --}}

<div class="container-fluid">
    <h1>Selamat datang</h1> 
    <p>{{ auth()->user()->name }}, Anda login sebagai <span style="text-transform: capitalize">{{ auth()->user()->role }}</span></p>
</div>