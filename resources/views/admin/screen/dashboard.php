<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="content-wrapper">
    <div class="row">
        <style>
            .bg-gradient-proses {
                background: linear-gradient(to right, #ffbe0b, #fb5607);
                /* Orange gradient */
                border: 0;
                -webkit-transition: opacity 0.3s ease;
                -moz-transition: opacity 0.3s ease;
                -ms-transition: opacity 0.3s ease;
                -o-transition: opacity 0.3s ease;
                transition: opacity 0.3s ease;
            }

            a:hover {
                text-decoration: none;
                color: white;
            }


            .bg-gradient-proses:hover {
                transform: translateY(-5px);
                opacity: 0.8;

            }

            .bg-gradient-proses:not(.btn-gradient-light) {
                color: #ffffff;
            }
        </style>
        <div class="col-md-4 stretch-card grid-margin">
            <a href="?screen=verifikasi_prestasi" class="text-white">
                <div class="card bg-gradient-proses card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?= IMG; ?>/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-1" style="font-size: 1.5em;">
                            Permintaan yang belum DiProses
                            <i class="bi bi-clipboard" style="font-size: 24px;"></i>
                        </h4>
                        <h1 class="mb-2" style="font-size: 4em;">
                            <?= $data['countAllNotVerifiedPenghargaan']['count'] ?? '0' ?>
                        </h1>
                        <h6 class="card-text">
                            <a href="?screen=verifikasi_prestasi" class="text-white">Pencet Proses Permintaan</a>
                        </h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
            <a href="?screen=riwayat" class="text-white">

                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?= IMG; ?>/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-1" style="font-size: 1.5em;">
                            Penghargaan Berhasil Terverifikasi
                            <i class="bi bi-clipboard-check" style="font-size: 24px;"></i>
                        </h4>
                        <h1 class="mb-2" style="font-size: 4em;">
                            <?= $data['countAllVerifiedPenghargaan']['count'] ?? '0' ?>
                        </h1>
                        <h6 class="card-text">
                            <a href="?screen=riwayat" class="text-white">Lihat Semua Permintaan</a>
                        </h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
            <a href="?screen=riwayat" class="text-white">

                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?= IMG; ?>/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-1" style="font-size: 1.5em;">
                            Total Semua Penghargaan
                            <i class="bi bi-clipboard-data" style="font-size: 24px;"></i>
                        </h4>
                        <h1 class="mb-2" style="font-size: 4em;">
                            <?= $data['countAllPenghargaan']['count1'] ?? '0' ?>
                        </h1>
                        <h6 class="card-text">
                            <a href="?screen=riwayat" class="text-white">Lihat Semua Permintaan</a>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        <canvas id="tingkat" style="width:100%;max-width:700px"></canvas>
        <canvas id="angkatan" style="width:100%;max-width:700px"></canvas>

        <canvas class="ml-8 mt-8 mx-auto d-block" id="tahunChart" style="width:100%; max-width:1000px; height:400px"></canvas>

        <script>
            const chartData = <?= json_encode($data['chartTingakatan']) ?>;

            // Generate colors array dynamically
            const generateColors = (count) => {
                const colors = [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ];
                return Array(count).fill().map((_, i) => colors[i % colors.length]);
            };

            // Get colors based on dataset length
            const barColors = generateColors(chartData.labels.length);


            new Chart("tingkat", {
                type: "bar",
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: chartData.datasets[0].label,
                        backgroundColor: barColors,
                        borderColor: barColors.map(color => color.replace('0.8', '1')),
                        borderWidth: 1,
                        data: chartData.datasets[0].data,
                        hoverBackgroundColor: barColors.map(color => color.replace('0.8', '0.9')),
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Detail Prestasi Terverifikasi Berdasarkan Tingkatan",
                        fontSize: 20,
                        fontStyle: 'bold',
                        padding: 20
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontStyle: 'bold'
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontStyle: 'bold'
                            }
                        }]
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeInOutQuart'
                    }
                }
            });

            const chartDataAngkatan = <?= json_encode($data['chartAngkatan']) ?>;

            // Generate colors array dynamically
            const generateColorsAng = (count) => {
                const colors = [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ];
                return Array(count).fill().map((_, i) => colors[i % colors.length]);
            };

            // Get colors based on dataset length
            const barColorsAng = generateColorsAng(chartDataAngkatan.labels.length);

            new Chart("angkatan", {
                type: "bar",
                data: {
                    labels: chartDataAngkatan.labels,
                    datasets: [{
                        label: chartDataAngkatan.datasets[0].label,
                        backgroundColor: barColorsAng,
                        borderColor: barColorsAng.map(color => color.replace('0.8', '1')),
                        borderWidth: 1,
                        data: chartDataAngkatan.datasets[0].data,
                        hoverBackgroundColor: barColorsAng.map(color => color.replace('0.8', '0.9')),
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Detail Prestasi Terverifikasi Berdasarkan Angkatan",
                        fontSize: 20,
                        fontStyle: 'bold',
                        padding: 20
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontStyle: 'bold'
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontStyle: 'bold'
                            }
                        }]
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeInOutQuart'
                    }
                }
            });

            const dataTahun = <?= json_encode($data['chartTahunVerification']) ?>;

            // Create gradient
            const ctx = document.getElementById('tahunChart').getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 100); // Adjusted gradient height
            gradient.addColorStop(0, 'rgba(54, 162, 235, 0.5)');
            gradient.addColorStop(1, 'rgba(54, 162, 235, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dataTahun.labels,
                    datasets: [{
                        label: 'Verifikasi per Tahun',
                        data: dataTahun.datasets[0].data,
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(54, 162, 235, 1)',
                        pointHoverBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true, // Changed to true
                    height: 500, // Added fixed height
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#666'
                            },
                            gridLines: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontColor: '#666'
                            },
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                    legend: {
                        labels: {
                            fontColor: '#666'
                        }
                    },
                    tooltips: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                        bodyFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                        cornerRadius: 4
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    }
                }
            });
        </script>


    </div>
</div>