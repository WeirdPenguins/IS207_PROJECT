
<?php include '../header.php'?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* Custom dashboard style */
.card.dashboard-card {
    border: none;
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    transition: transform 0.2s, box-shadow 0.2s;
}
.card.dashboard-card:hover {
    transform: translateY(-4px) scale(1.02);
    box-shadow: 0 8px 32px rgba(0,0,0,0.15);
}
.card-header.bg-gradient-green {
    background: linear-gradient(90deg, #00b894 60%, #00cec9 100%);
    color: #fff;
    border-radius: 18px 18px 0 0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.card-header.bg-gradient-orange {
    background: linear-gradient(90deg, #fdcb6e 60%, #e17055 100%);
    color: #fff;
    border-radius: 18px 18px 0 0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.card-header .dashboard-icon {
    font-size: 2.2rem;
    opacity: 0.85;
}
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?=ADMIN_URL?>/dasboard/" class="brand-link">
        <img src="<?=ROOT_URL?>/assets/img/bht_bookstore_logo.png" alt="BHT Bookstore" style="width: 100%">
    </a>
    <?php include '../sidebar.php'?>
</aside>

<div class="content-wrapper">
    <div class="content-header" style="background: linear-gradient(90deg,#00b894,#fdcb6e); color: #fff;">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-tachometer-alt"></i> Bảng điều khiển</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="background:transparent;">
                        <li class="breadcrumb-item">
                            <a href="<?=ADMIN_URL?>/dasboard/" style="color:#fff;"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" style="color:#fff;">Bảng điều khiển</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card dashboard-card">
                        <div class="card-header bg-gradient-green">
                            <span class="dashboard-icon"><i class="fas fa-shopping-cart"></i></span>
                            <h4 class="mb-0">Tổng số đơn hàng theo năm</h4>
                        </div>
                        <div class="card-body bg-light">
                            <canvas id="ordersOfYear"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card dashboard-card">
                        <div class="card-header bg-gradient-orange">
                            <span class="dashboard-icon"><i class="fas fa-coins"></i></span>
                            <h4 class="mb-0">Doanh thu theo năm</h4>
                        </div>
                        <div class="card-body bg-light">
                            <canvas id="moneyOfYear"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <?php
        $sql = 'SELECT MONTH(CreatedAt) AS Month, COUNT(*) AS Number, SUM(TotalRevenue) AS Money FROM Orders GROUP BY MONTH(CreatedAt)';
        $datas = Database::GetData($sql);
        $ordersOfYearValue = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $moneyOfYearValue = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($datas as $data) {
            $ordersOfYearValue[$data['Month'] - 1] = $data['Number'];
            $moneyOfYearValue[$data['Month'] - 1] = $data['Money'];
        }
    ?>
    <script>
    const data = {
        labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
        datasets: [{
            label: 'Tổng số đơn hàng theo năm',
            data: <?=json_encode($ordersOfYearValue)?>,
            backgroundColor: 'rgba(0,184,148,0.2)',
            borderColor: 'rgba(0,184,148,1)',
            borderWidth: 2,
            pointBackgroundColor: 'rgba(0,184,148,1)',
            pointRadius: 4,
            tension: 0.3
        }]
    };

    const data1 = {
        labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
        datasets: [{
            label: 'Doanh thu theo năm',
            data: <?=json_encode($moneyOfYearValue)?>,
            backgroundColor: 'rgba(253,203,110,0.2)',
            borderColor: 'rgba(253,203,110,1)',
            borderWidth: 2,
            pointBackgroundColor: 'rgba(253,203,110,1)',
            pointRadius: 4,
            tension: 0.3
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    const config1 = {
        type: 'line',
        data: data1,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    var myChart = new Chart(document.getElementById("ordersOfYear"), config);
    var myChart1 = new Chart(document.getElementById("moneyOfYear"), config1);
    </script>
</div>
<?php include '../footer.php'?>