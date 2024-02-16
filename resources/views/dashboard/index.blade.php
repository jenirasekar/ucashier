<div class="container-fluid">
    <h1>Selamat datang</h1>
    <p>{{ auth()->user()->name }}, Anda login sebagai <span
            style="text-transform: capitalize">{{ auth()->user()->role }}</span></p>

    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Sales</h3>
                <a href="javascript:void(0);">View Report</a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <p class="d-flex flex-column">
                    <span class="text-bold text-lg">$18,230.00</span>
                    <span>Sales Over Time</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                        <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                </p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#0099ff" fill-opacity="1"
                    d="M0,160L96,96L192,160L288,192L384,288L480,128L576,64L672,160L768,192L864,320L960,96L1056,288L1152,288L1248,288L1344,224L1440,224L1440,320L1344,320L1248,320L1152,320L1056,320L960,320L864,320L768,320L672,320L576,320L480,320L384,320L288,320L192,320L96,320L0,320Z">
                </path>
            </svg>
            <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
            </div>
            <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                </span>
                <span>
                    <i class="fas fa-square text-gray"></i> Last year
                </span>
            </div>
        </div>
    </div>
</div>
