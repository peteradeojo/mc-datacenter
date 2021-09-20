<?php

use Patient\Database;

require 'init.php';

$db = new Database();
$db->connect();

$patientID = @$_GET['id'];
if (!$patientID) {
	header("Location: /");
}

if ($_POST) {
	require './process/editpatient.php';
}

$patient = $db->select('biodata', where: "id='$patientID'")[0];
// print_r($patient);
if (!$patient) {
	flash(['message' => 'Patient Data not found', 'mode' => 'danger']);
	header("Location: /");
}

$insurance = @$db->select('insurance_data', where: "hospital_number='$patient[hospital_number]'")[0];
// print_r($insurance);

$title = "$patient[name]";
require 'header.php';
?>
<main>
	<div class="container mt-4">
		<form action="" method="post">
			<fieldset class="row border py-3">
				<legend><?= $patient['name'] ?></legend>
				<div class="form-group col-sm-6 col-md-3">
					<label for="category">Category</label>
					<select name="category" id="category" class="form-control" readonly required>
						<option value="<?= $patient['category'] ?>" selected><?= ucfirst($patient['category']) ?></option>
					</select>
				</div>
				<div class="form-group col-sm-6 col-md-4">
					<label for="hospital-no">Hospital Number</label>
					<input type="text" name="hosp-no" id="hospital-no" class="form-control" value='<?= $patient['hospital_number'] ?>' required>
				</div>
				<div class="form-group col-sm-6 col-md-5">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" required="required" class="form-control" value='<?= $patient['name'] ?>'>
				</div>
				<div class="form-group col-sm-6 col-md-3">
					<label for="sex">Sex</label>
					<select name="sex" id="sex" required="required" class="form-control">
						<option value="1" <?= $patient['gender'] == 1 ? 'selected' : '' ?>>Male</option>
						<option value="0" <?= $patient['gender'] == 0 ? 'selected' : '' ?>>Female</option>
					</select>
				</div>
				<div class="form-group col-sm-6 col-md-3">
					<label for="dob">Date of Birth</label>
					<input type="date" name="dob" id="dob" class="form-control" value='<?= $patient['birthdate'] ?>' required>
				</div>
				<div class="form-group col-sm-6 col-md-3">
					<label for="origin">State of Origin</label>
					<input type="text" name="origin" id="origin" class="form-control" value="<?= $patient['state_of_origin'] ?>">
				</div>
				<div class="form-group col-sm-6 col-md-3">
					<label for="tribe">Tribe</label>
					<input type="text" name="tribe" id="tribe" class="form-control" value="<?= $patient['tribe'] ?>">
				</div>
				<div class="form-group col-12">
					<label for="address">Address</label>
					<input type="text" name="address" id="address" class="form-control" value="<?= $patient['address'] ?>">
				</div>
				<div class="form-group col-sm-6 col-md-4">
					<label for="religion">Religion</label>
					<select name="religion" id="religion" class="form-control">
						<option value="Christianity" <?= $patient['religion'] == 'Christianity' ? 'selected' : '' ?>>Christianity</option>
						<option value="Muslim" <?= $patient['religion'] == 'Muslim' ? 'selected' : '' ?>>Muslim</option>
						<option value="Other" <?= $patient['religion'] == 'Other' ? 'selected' : '' ?>>Other</option>
					</select>
				</div>
				<div class="form-group col-sm-6 col-md-4">
					<label for="marital">Marital Status</label>
					<select name="marital" id="marital" class="form-control">
						<option value="Single" <?= $patient['marital_status'] == 'Single' ? 'selected' : '' ?>>Single</option>
						<option value="Married" <?= $patient['marital_status'] == 'Married' ? 'selected' : '' ?>>Married</option>
						<option value="Divorced" <?= $patient['marital_status'] == 'Divorced' ? 'selected' : '' ?>>Divorced</option>
					</select>
				</div>
				<div class="form-group col-sm-6 col-md-4">
					<label for="occupation">Occupation</label>
					<input type="text" name="occupation" id="occupation" class="form-control" value="<?= $patient['occupation'] ?>">
				</div>
				<div class="form-group col-sm-6">
					<label for="email">E-mail Address</label>
					<input type="email" name="email" id="email" class="form-control" value="<?= $patient['email_address'] ?>">
				</div>
				<div class="form-group col-sm-6">
					<label for="phone">Phone Number</label>
					<input type="text" name="phone" id="phone" class="form-control" value="<?= $patient['phone_number'] ?>">
				</div>
				<div class="form-group col-sm-6">
					<label for="notes">Notes</label>
					<input type="text" name="notes" id="notes" class="form-control" value="<?= $patient['notes'] ?>">
				</div>
			</fieldset>
			<fieldset class="border row mt-4 py-3">
				<legend>Insurance Info</legend>
				<div class="form-group col-sm-6 col-md-4">
					<label for="company-name">Company/Organization Name</label>
					<input type="text" name="company-name" id="company-name" class="form-control" value="<?= @$insurance['company'] ?>">
				</div>
				<div class="form-group col-sm-6 col-md-4">
					<label for="hmo-name">HMO Name</label>
					<input type="text" name="hmo-name" id="hmo-name" class="form-control" value="<?= @$insurance['hmo_name'] ?>">
				</div>
				<div class="form-group col-sm-6 col-md-4">
					<label for="hmo-id">HMO Identification No</label>
					<input type="text" name="hmo-id" id="hmo-id" class="form-control" value=<?= @$insurance['hmo_id'] ?>>
				</div>
				<div class="form-group col-sm-6 col-md-3">
					<label for="auth-code">Authorization Code</label>
					<input type="text" name="auth-code" id="auth-code" class="form-control" value=<?= @$insurance['authorization_code'] ?>>
				</div>
			</fieldset>

			<div class="form-group py-2">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</main>
<?php
require 'footer.php';
