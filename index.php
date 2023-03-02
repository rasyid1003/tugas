<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faris Rasyid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
		<h1 class="text-center">Faris Rasyid</h1>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="card">
					<div class="card-header bg-primary text-white text-center">Form Tagihan pelanggan PDAM</div>
					<div class="card-body">
		<div class="form-group">
				<label for="lokasi">Lokasi:</label>
				<select class="form-control" id="lokasi" name="lokasi">
                <?php
					$lokasi = array("Jakarta", "Depok", "Bogor", "Tangerang", "Bekasi");
					foreach ($lokasi as $value) {
						echo "<option>$value</option>";
					}
					?>
				</select>
			</div>
        	
        <div class="form-group">
				<label for="nama">Nama Pelanggan:</label>
				<input type="text" class="form-control" id="nama" name="nama">
			</div>
			<div class="form-group">
				<label for="nomor">Nomor Pelanggan:</label>
				<input type="text" class="form-control" id="nomor" name="nomor">
			</div>
			<div class="form-group">
				<label for="golongan">Golongan Pemakaian:</label>
				<select class="form-control" id="golongan" name="golongan">
					<option value="A">Golongan A</option>
					<option value="B">Golongan B</option>
					<option value="C">Golongan C</option>
					<option value="D">Golongan D</option>
				</select>
			</div>
			
			<div class="form-group">
				<label for="pemakaian">Pemakaian:</label>
				<input type="text" class="form-control" id="pemakaian" name="pemakaian">
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
		</form>
	</div>

	<?php
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$nama = $_POST["nama"];
		$nomor = $_POST["nomor"];
		$lokasi = $_POST["lokasi"];
		$golongan = $_POST["golongan"];
		$pemakaian = $_POST["pemakaian"];

		
		$tarif_dasar = array(
			"A" => 1500,
			"B" => 2000,
			"C" => 2500,
			"D" => 3000
		);

		
		$tarif_pemakaian = $tarif_dasar[$golongan] * $pemakaian;
		$total_tagihan = $tarif_pemakaian + 1195 + 3000 + 4400;

	
		$data = array(
			"nama" => $nama,		"nomor" => $nomor,
            "lokasi" => $lokasi,
            "golongan" => $golongan,
            "pemakaian" => $pemakaian,
            "tarif_pemakaian" => $tarif_pemakaian,
            "total_tagihan" => $total_tagihan
        );
    
    
        $json_file = "data.json";
	$current_data = file_get_contents($json_file);
	$array_data = json_decode($current_data, true);
	$array_data[] = $data;
	$final_data = json_encode($array_data, JSON_PRETTY_PRINT);
	file_put_contents($json_file, $final_data);
     
        echo "<div class='container'>";
        echo "<h2>Tagihan Pelanggan</h2>";
        echo "<table class='table'>";
        echo "<tr><td>Nama Pelanggan:</td><td>$nama</td></tr>";
        echo "<tr><td>Nomor Pelanggan:</td><td>$nomor</td></tr>";
        echo "<tr><td>Lokasi:</td><td>$lokasi</td></tr>";
        echo "<tr><td>Golongan Pemakaian:</td><td>$golongan</td></tr>";
        echo "<tr><td>Pemakaian:</td><td>$pemakaian</td></tr>";
        echo "<tr><td>Tarif Pemakaian:</td><td>$tarif_pemakaian</td></tr>";
        echo "<tr><td>Total Tagihan:</td><td>$total_tagihan</td></tr>";
        echo "</table>";
        echo "</div>";
    }
    ?>
    

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>    