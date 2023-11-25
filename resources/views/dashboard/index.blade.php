<div class="container-fluid">
    <h1>Selamat datang</h1>
    <p>{{ auth()->user()->name }}, Anda login sebagai <span
            style="text-transform: capitalize">{{ auth()->user()->role }}</span></p>
</div>
