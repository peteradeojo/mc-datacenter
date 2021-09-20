<?php

use Patient\Database;

require './init.php';

$db = new Database();

$id = @$_GET['id'];
if (!$id) {
	header("Location: /documentations.php");
}


try {
	$db->connect();
	$billed_doc = $db->select('documentations', where: "id='$id'")[0];
	$patient = $db->select('biodata', where: "hospital_number='$billed_doc[hospital_number]'")[0];
} catch (Exception $e) {
	//throw $th;
}

if ($_POST) {
	require './process/submitbill.php';
	exit();
}
$title = 'Bill';
require './header.php';
?>
<main>
	<div class="container">
		<div class="py-4">
			<form action="" method="post">
				<fieldset class='row'>
					<legend><?= $patient['name'] ?>: <?= $billed_doc['date'] ?></legend>
					<div class="form-group col-sm-3">
						<label for="total_bill">Total Bill</label>
						<input type="number" step="0.01" class="form-control" id="total_bill" name="total_bill" required="required" value="<?= $billed_doc['total_bill'] ?>">
					</div>
					<div class="form-group col-sm-3">
						<label for="amount_paid">Amount Paid</label>
						<input type="number" step="0.01" class="form-control" id="amount_paid" name="amount_paid" required="required" value="<?= $billed_doc['amount_paid'] ?>">
					</div>
					<div class="form-group col-sm-3">
						<label for="deposit">Deposit</label>
						<input type="number" step="0.01" class="form-control" id="deposit" name="deposit" required="required" value="<?= $billed_doc['deposit'] ?>">
					</div>
					<div class="form-group mt-2">
						<button type="submit" class="btn btn-dark">Submit</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</main>
<?php

require './footer.php';
