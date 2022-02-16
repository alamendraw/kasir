<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Portal</title>
	<link href="<?= base_url(); ?>assets/main.css" rel="stylesheet">
</head>
<style>
	body,
	html {
		height: 100%;
	}

	.bg {
		/* The image used */
		background-image: url('assets/images/back.jpg');

		/* Full height */
		height: 100%;

		/* Center and scale the image nicely */
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}

	.tengah {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.tombol {
		font-size: xxx-large;
		font-weight: bold;
		color: white;
	}
</style>

<body>
	<div class="bg">
		<div class="tengah">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6"><button class="mb-2 mr-2 btn btn-warning btn-lg btn-block tombol" data-toggle='modal' data-target='#adminModal'>ADMIN </button></div>
					<div class="col-md-6"><button class="mb-2 mr-2 btn btn-primary btn-lg btn-block tombol" onclick="kasir()" data-toggle='modal' data-target='#kasirModal'>KASIR </button></div>


				</div>
			</div>
		</div>
		<div class="modal fade" id="kasirModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3 style="font-weight: bold;">Masukan PIN</h3>
					</div>
					<div class="modal-body">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12"> <input type="password" id="pin" class="form-control form-group" maxlength="6" style="font-size: xxx-large; height: 40px;"> </div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" onclick="prosesMasuk(2)" data-dismiss="modal">Masuk</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
					</div>
				</div>
			</div>
		</div>


		<div class="modal fade" id="adminModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3 style="font-weight: bold;">Masukan PIN</h3>
					</div>
					<div class="modal-body">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12"> <input type="password" id="pinAdmin" class="form-control form-group" maxlength="6" style="font-size: xxx-large; height: 40px;"> </div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" onclick="prosesMasuk(1)" data-dismiss="modal">Masuk</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="<?= base_url(); ?>assets/scripts/main.js"></script>
		<script src="<?= base_url('assets/jquery.min.js') ?>"></script>
		<script>
			function kasir() {
				$('#pin').val('');
				$("#pin").focus();
			}

			function prosesMasuk(pilih) {

				if (pilih == 1) {
					pinnya = $("#pinAdmin").val();
				} else {
					pinnya = $("#pin").val();
				}
				$.get("<?= site_url('Portal/prosesMasuk?id=') ?>" + pinnya, function(data) {

					if (data == 'true') {
						if (pilih == 1) {
							window.location = "<?= site_url('page-admin') ?>";
						} else {
							window.location = "<?= site_url('page-kasir') ?>";
						}

					} else {
						alert('Pin Salah')
						location.reload();
					}
				});
			}
		</script>
	</div>
</body>

</html>