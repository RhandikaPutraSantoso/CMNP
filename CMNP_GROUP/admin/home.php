<h1>Selamat Datang di Administrator CMNP GROUP Official</h1>
<br><br>

<!-- PHP: Filter dan Ambil Data -->
<?php
$where = "WHERE 1=1";
if (!empty($_GET['bulan'])) {
    $where .= " AND MONTH(TGL_ACTIVITY) = " . (int)$_GET['bulan'];
}
if (!empty($_GET['tahun'])) {
    $where .= " AND YEAR(TGL_ACTIVITY) = " . (int)$_GET['tahun'];
}

$query = "
    SELECT COMPANY_SAP.NM_COMPANY, COUNT(*) AS jumlah 
    FROM SBO_CMNP_KK.ACTIVITY 
    LEFT JOIN SBO_CMNP_KK.COMPANY_SAP ON ACTIVITY.ID_COMPANY = COMPANY_SAP.ID_COMPANY
    $where 
    GROUP BY COMPANY_SAP.NM_COMPANY
";
$stmt = $koneksi->query($query);
$dataPerusahaan = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Untuk chart
$dataPerusahaan = array_map(function($item) {
    return [
        'NM_COMPANY' => $item['NM_COMPANY'],
        'jumlah' => $item['JUMLAH']
    ];
}, $dataPerusahaan);
?>

<!-- Form Filter Bulan & Tahun -->
<form method="GET" class="form-inline mb-3">
    <label for="bulan">Bulan: </label>
    <select name="bulan" class="form-control mx-2">
        <option value="">Semua</option>
        <?php for ($i=1; $i<=12; $i++): ?>
            <option value="<?= $i; ?>" <?= (isset($_GET['bulan']) && $_GET['bulan'] == $i) ? 'selected' : ''; ?>>
                <?= date('F', mktime(0, 0, 0, $i, 10)); ?>
            </option>
        <?php endfor; ?>
    </select>

    <label for="tahun">Tahun: </label>
    <select name="tahun" class="form-control mx-2">
        <option value="">Semua</option>
        <?php
        $tahunSekarang = date('Y');
        for ($t = $tahunSekarang; $t >= $tahunSekarang - 5; $t--): ?>
            <option value="<?= $t; ?>" <?= (isset($_GET['tahun']) && $_GET['tahun'] == $t) ? 'selected' : ''; ?>>
                <?= $t; ?>
            </option>
        <?php endfor; ?>
    </select>

    <button class="btn btn-primary" type="submit">Filter</button>
</form>

<!-- Chart -->
<canvas id="bar-chart"></canvas>
<div id="custom-legend" style="display: flex; flex-wrap: wrap; justify-content: center; margin-top: 20px; gap: 20px;"></div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = <?= json_encode(array_column($dataPerusahaan, 'NM_COMPANY')); ?>;
    const initialData = <?= json_encode(array_map('intval', array_column($dataPerusahaan, 'jumlah'))); ?>;

    const logos = [
        "assets/foto_logo_perusahaan/cmnproper.png",
        "assets/foto_logo_perusahaan/cmnp.png",
        "assets/foto_logo_perusahaan/cms.png",
        "assets/foto_logo_perusahaan/cpi.png",
        "assets/foto_logo_perusahaan/cmlj.png",
        "assets/foto_logo_perusahaan/cw.jpg",
        "assets/foto_logo_perusahaan/ckjt.jpg"
    ];

    const backgroundColors = [
        'rgba(54, 162, 235, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(255, 99, 132, 0.6)',
        'rgba(201, 203, 207, 0.6)',
        'rgba(255, 159, 64, 0.6)'
    ];

    let currentChart;

    function createInitialBarChart() {
        const ctx = document.getElementById('bar-chart').getContext('2d');
        currentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Aktivitas',
                    data: initialData,
                    backgroundColor: backgroundColors.slice(0, labels.length),
                    borderColor: backgroundColors.slice(0, labels.length).map(c => c.replace('0.6', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Banyaknya Aktivitas Perusahaan',
                        font: { size: 16, weight: 'bold', family: 'Times New Roman' }
                    },
                    tooltip: {
                        callbacks: {
                            label: context => `Jumlah Aktivitas: ${context.formattedValue}`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Aktivitas',
                            font: { family: 'Times New Roman' }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Nama Perusahaan',
                            font: { family: 'Times New Roman' }
                        }
                    }
                }
            }
        });
    }

    function updateBarChart(companyName, activityCount, color) {
        if (currentChart) currentChart.destroy();

        const ctx = document.getElementById('bar-chart').getContext('2d');
        currentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [''],
                datasets: [{
                    label: 'Jumlah Aktivitas',
                    data: [activityCount],
                    backgroundColor: color,
                    borderColor: color.replace('0.6', '1'),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: `Jumlah Aktivitas`,
                        font: { size: 16, weight: 'bold', family: 'Times New Roman' }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Aktivitas',
                            font: { family: 'Times New Roman' }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Nama Perusahaan',
                            font: { family: 'Times New Roman' }
                        }
                    }
                }
            }
        });
    }

    const legendContainer = document.getElementById('custom-legend');
    labels.forEach((label, index) => {
        const item = document.createElement('div');
        item.style.cssText = "display:flex; flex-direction:column; align-items:center; font-family:'Times New Roman'; font-weight:bold; font-size:12px; width:110px; cursor:pointer";

        const img = document.createElement('img');
        img.src = logos[index];
        img.style.cssText = "width:50px; height:50px; object-fit:contain; border-radius:10px; margin-bottom:5px";

        const caption = document.createElement('div');
        caption.innerText = label;
        caption.style.textAlign = 'center';

        item.appendChild(img);
        item.appendChild(caption);
        item.addEventListener('click', () => {
            updateBarChart(label, initialData[index], backgroundColors[index % backgroundColors.length]);
        });

        legendContainer.appendChild(item);
    });

    createInitialBarChart();
</script>
<br><br>

<!-- Menampilkan data perusahaan dalam tabel -->
<div class="table-responsive">
    <table class="table table-bordered" id="table">
	<thead>
		<tr>
			<th>No</th>
			<th>Company</th>
			<th>Email</th>
			<th>Username</th>
			<th>Tanggal</th>
			
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>
		<?php $ambil=$koneksi->query("SELECT*FROM SBO_CMNP_KK.ACTIVITY  LEFT JOIN SBO_CMNP_KK.COMPANY_SAP ON ACTIVITY.ID_COMPANY = COMPANY_SAP.ID_COMPANY"); ?>
		<?php while($pecah=$ambil->fetch(PDO::FETCH_ASSOC)){?>
		<tr>
			<td><?php echo $nomor;?></td>
			<td><?php echo $pecah['NM_COMPANY']?></td>
			<td><?php echo $pecah['MAIL_COMPANY']?></td>
			<td><?php echo $pecah['NM_USER']?></td>
			<td><?php echo $pecah['TGL_ACTIVITY']?>
			
		</tr>
		<?php $nomor++;?>
		<?php }?>
	</tbody>
</table>
</div>
