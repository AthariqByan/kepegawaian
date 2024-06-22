@extends('layout.main')

@section('container')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Sales Card - Total Pegawai -->
                <div class="col-xxl-4 col-md-6 mb-4">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('admin.pegawai.index') }}"></a>Total Pegawai</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-clipboard-data"></i>
                                </div>
                                <div class="ps-3">
                                    <h3>{{ $pegawaiCount }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sales Card - Total Posisi -->
                <div class="col-xxl-4 col-md-6 mb-4">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('admin.posisi.index') }}"></a>Total Posisi</h5>
                            <div class="d-flex
                                    align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-clipboard-data"></i>
                                </div>
                                <div class="ps-3">
                                    <h3>{{ $posisiCount }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <!-- Reports -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Reports <span>/Today</span></h5>

                    <!-- Line Chart -->
                    <div id="reportsChart"></div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const chart = new ApexCharts(document.querySelector("#reportsChart"), {
                                series: [{
                                    name: 'Pegawai',
                                    data: [{{ $jumlahPegawai }}],
                                }, {
                                    name: 'Posisi',
                                    data: [{{ $jumlahPosisi }}]
                                }],
                                chart: {
                                    height: 350,
                                    type: 'area',
                                    animations: {
                                        enabled: true, // Ensure animations are enabled
                                        easing: 'easeinout',
                                        speed: 800,
                                        animateGradually: {
                                            enabled: true,
                                            delay: 150
                                        },
                                        dynamicAnimation: {
                                            enabled: true,
                                            speed: 350
                                        }
                                    },
                                    toolbar: {
                                        show: false
                                    },
                                },
                                markers: {
                                    size: 4
                                },
                                colors: ['#4154f1', '#2eca6a'],
                                fill: {
                                    type: "gradient",
                                    gradient: {
                                        shadeIntensity: 1,
                                        opacityFrom: 0.3,
                                        opacityTo: 0.4,
                                        stops: [0, 90, 100]
                                    }
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                stroke: {
                                    curve: 'smooth',
                                    width: 2
                                },
                                xaxis: {
                                    type: 'datetime',
                                    categories: ["2024-06-22T00:00:00.000Z"] // Adjust to your current datetime
                                },
                                tooltip: {
                                    x: {
                                        format: 'dd/MM/yy HH:mm'
                                    },
                                }
                            });

                            chart.render();
                        });
                    </script>
                    <!-- End Line Chart -->

                </div>
            </div>
        </div><!-- End Reports -->
    </section>
    <!-- /.content -->
@endsection
