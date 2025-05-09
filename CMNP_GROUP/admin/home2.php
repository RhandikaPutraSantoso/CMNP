<?php
session_start();
include '../koneksi.php';
?><h1>Selamat Datang di Administrator CMNP GROUP Official</h1>
<br><br>

<!-- Set Tanggal Penginputan -->
<?php
$where = "WHERE 1=1";
if (!empty($_GET['bulan'])) {
    $where .= " AND MONTH(TGL_ACTIVITY) = " . (int)$_GET['bulan'];
}
if (!empty($_GET['tahun'])) {
    $where .= " AND YEAR(TGL_ACTIVITY) = " . (int)$_GET['tahun'];
}

$query = "SELECT NM_COMPANY, COUNT(*) as jumlah 
          FROM SBO_CMNP_KK.ACTIVITY 
          $where
          GROUP BY NM_COMPANY";

$stmt = $koneksi->query($query);
$dataPerusahaan = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
// Menyiapkan data untuk chart 
$dataPerusahaan = array_map(function($item) {
    return [
        'NM_COMPANY' => $item['NM_COMPANY'],
        'jumlah' => $item['JUMLAH']
    ];
}, $dataPerusahaan);
?>


<!-- Form Tanggal Penginputan -->
<form method="GET" class="form-inline mb-3">
    <label for="bulan">Bulan: </label>
    <select name="bulan" class="form-control mx-2">
        <option value="">Semua</option>
        <?php for ($i=1; $i<=12; $i++): ?>
            <option value="<?php echo $i; ?>" <?php if(isset($_GET['bulan']) && $_GET['bulan']==$i) echo 'selected'; ?>>
                <?php echo date('F', mktime(0, 0, 0, $i, 10)); ?>
            </option>
        <?php endfor; ?>
    </select>

    <label for="tahun">Tahun: </label>
    <select name="tahun" class="form-control mx-2">
        <option value="">Semua</option>
        <?php
        $tahunSekarang = date('Y');
        for ($t=$tahunSekarang; $t >= $tahunSekarang - 5; $t--):
        ?>
            <option value="<?php echo $t; ?>" <?php if(isset($_GET['tahun']) && $_GET['tahun']==$t) echo 'selected'; ?>>
                <?php echo $t; ?>
            </option>
        <?php endfor; ?>
    </select>
    

    <button class="btn btn-primary" type="submit">Filter</button>
</form>
<br><br>
<!-- Chart Canvas -->
<canvas id="bar-chart" width="" height=""></canvas>

<!-- Custom Legend -->
<div id="custom-legend" style="display: flex; flex-wrap: wrap; justify-content: center; margin-top: 20px; gap: 20px;"></div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = <?php echo json_encode(array_column($dataPerusahaan, 'NM_COMPANY')); ?>;
    const initialData = <?php echo json_encode(array_map('intval', array_column($dataPerusahaan, 'jumlah'))); ?>;

    // Ini array path foto logo perusahaan
    const logos = [
        "assets/foto_logo_perusahaan/cmnproper.png",
        "assets/foto_logo_perusahaan/cmnp.png",
        "assets/foto_logo_perusahaan/cms.png",
        "assets/foto_logo_perusahaan/cpi.png",
        "assets/foto_logo_perusahaan/cmlj.png",
        "assets/foto_logo_perusahaan/cw.jpg",
        "assets/foto_logo_perusahaan/ckjt.jpg"
        // Tambah terus sesuai jumlah perusahaan
    ];

    const backgroundColors = [
        'rgba(54, 162, 235, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(255, 99, 132, 0.6)',
        'rgba(201, 203, 207, 0.6)',
        'rgba(255, 159, 64, 0.6)'
        // Tambahkan warna lain jika ada lebih banyak perusahaan
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
                    backgroundColor: backgroundColors.slice(0, labels.length), // Sesuaikan jumlah warna
                    borderColor: backgroundColors.slice(0, labels.length).map(color => color.replace('0.6', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false // Sembunyikan legend default
                    },
                    title: {
                        display: true,
                        text: 'Banyaknya Aktivitas Perusahaan',
                        font: {
                            size: 16,
                            weight: 'bold',
                            family: 'Times New Roman'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.formattedValue}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Aktivitas',
                            font: {
                                family: 'Times New Roman'
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Nama Perusahaan',
                            font: {
                                family: 'Times New Roman'
                            }
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
            labels: [companyName],
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
                    text: `Aktivitas ${companyName}`,
                    font: { size: 16, weight: 'bold', family: 'Times New Roman' }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Jumlah Aktivitas', font: { family: 'Times New Roman' } }
                },
                x: {
                    title: { display: true, text: 'Perusahaan', font: { family: 'Times New Roman' } }
                }
            }
        }
    });
}

    // Buat Custom Legend dengan fungsi onclick
    const legendContainer = document.getElementById('custom-legend');
    labels.forEach((label, index) => {
        const item = document.createElement('div');
        item.style.display = 'flex';
        item.style.flexDirection = 'column';
        item.style.alignItems = 'center';
        item.style.fontFamily = 'Times New Roman';
        item.style.fontWeight = 'bold';
        item.style.fontSize = '12px';
        item.style.width = '165px';
        item.style.cursor = 'pointer'; // Tambahkan cursor pointer

        const img = document.createElement('img');
        img.src = logos[index];
        img.style.width = '50px';
        img.style.height = '50px';
        img.style.objectFit = 'contain';
        img.style.borderRadius = '10px';
        img.style.marginBottom = '5px';

        const caption = document.createElement('div');
        caption.innerText = label;
        caption.style.textAlign = 'center';

        item.appendChild(img);
        item.appendChild(caption);
        legendContainer.appendChild(item);

        // Tambahkan event listener untuk menampilkan chart saat logo diklik
        item.addEventListener('click', function() {
            updateBarChart(label, initialData[index], backgroundColors[index % backgroundColors.length]);
        });
    });

    // Tampilkan chart awal saat halaman dimuat
    createInitialBarChart();
</script><br><br>
<!-- Menampilkan data perusahaan dalam tabel -->
    <table class="table table-bordered" id="table">
	<thead>
		<tr>
			<th>No</th>
			<th>Company</th>
			<th>Email</th>
			<th>Username</th>
			<th>Tanggal</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>
		<?php $ambil=$koneksi->query("SELECT*FROM SBO_CMNP_KK.ACTIVITY LEFT JOIN SBO_CMNP_KK.KATEGORI ON ACTIVITY.ID_KATEGORI=KATEGORI.ID_KATEGORI"); ?>
		<?php while($pecah=$ambil->fetch(PDO::FETCH_ASSOC)){?>
		<tr>
			<td><?php echo $nomor;?></td>
			<td><?php echo $pecah['NM_COMPANY']?></td>
			<td><?php echo $pecah['MAIL_COMPANY']?></td>
			<td><?php echo $pecah['NM_USER']?></td>
			<td><?php echo $pecah['TGL_ACTIVITY']?>
			<td>
				<a href="index.php?halaman=detailproduk&id=<?php echo $pecah['ID_ACTIVITY'];?>" class= "btn btn-info" ><i class="glyphicon glyphicon-eye">Detail</a>
			</td>
		</tr>
		<?php $nomor++;?>
		<?php }?>
	</tbody>
</table>
    

    


