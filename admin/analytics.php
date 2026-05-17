
<?php
//session_start();
require_once "../config/database.php";
require_once "../includes/admin-header.php";



/* INCIDENTS BY STATUS */
$statusQuery = $conn->query("
    SELECT status, COUNT(*) as total 
    FROM incidents 
    GROUP BY status
");

$statusData = [];
while($row = $statusQuery->fetch_assoc()){
    $statusData[$row['status']] = $row['total'];
}

/* INCIDENTS BY TYPE */
$typeQuery = $conn->query("
    SELECT incident_type, COUNT(*) as total 
    FROM incidents 
    GROUP BY incident_type
");

$typeData = [];
while($row = $typeQuery->fetch_assoc()){
    $typeData[$row['incident_type']] = $row['total'];
}

/* REPORTS PER MONTH */
$monthQuery = $conn->query("
    SELECT MONTH(created_at) as month, COUNT(*) as total 
    FROM incidents 
    GROUP BY MONTH(created_at)
");

$monthData = array_fill(1,12,0);
while($row = $monthQuery->fetch_assoc()){
    $monthData[$row['month']] = $row['total'];
}
?>

<!-----html for the analytics content ---->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/CSS/analytics.css">
    <title>Analytics</title>
</head>
<body>
    
    <div class="admin-content">
        <h1>Traffic Analytics </h1>  
        <div class="charts">
           <div class="chart-card">
                <h3>Incidents by Status</h3>
                <canvas id="statusChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>Incidents by Type</h3>
                <canvas id="typeChart"></canvas>
            </div>

            <div class="chart-card full">
                <h3>Reports Per Month</h3>
                <canvas id="monthChart"></canvas>
            </div>
        </div>
    </div>
    
    <!----in-line script for the chart online library ----->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!----in-line script for linking the chart to the database ----->
    <script>
        const statusData = <?php echo json_encode($statusData); ?>;
        const typeData   = <?php echo json_encode($typeData); ?>;
        const monthData  = <?php echo json_encode(array_values($monthData)); ?>;
    </script>

    <!----in-line script to create the chart ----->
    <script>

        /* PIE CHART - STATUS */
        new Chart(document.getElementById('statusChart'), {
            type: 'pie',
            data: {
                labels: Object.keys(statusData),
                datasets: [{
                    data: Object.values(statusData),
                    backgroundColor: ['#0f0bf7','#fdf90e','#ff0000','#20f30c']
                }]
            }
        });

        /* BAR CHART - TYPE */
        new Chart(document.getElementById('typeChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(typeData),
                datasets: [{
                    label: 'Incidents',
                    data: Object.values(typeData),
                    backgroundColor: '#0ea5e9'
                }]
            }
        });

        /* LINE CHART - MONTH */
        new Chart(document.getElementById('monthChart'), {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{
                    label: 'Reports',
                    data: monthData,
                    borderColor: '#2f00ff',
                    fill: false
                }]
            }
        });
    </script>


</body>
</html>