<?php

use Patient\Database;

require 'init.php';

$title = 'Documentation';

if (!$_GET['id']) {
  header("Location: /");
}

$doc_id = $_GET['id'];

$db = new Database();
try {
  $db->connect();
  $doc = $db->select('documentations', where: "id='$doc_id'")[0];
  $patient = $db->select('biodata', where: "hospital_number='$doc[hospital_number]'")[0];
} catch (Exception $e) {
  echo $e->getMessage();
}

require 'header.php';
?>
<main>
  <div class="container">
    <h3 class="my-4"><?= $patient['name'] . ': ' . $doc['date'] ?></h3>
  </div>

  <div class="container">
    <div class="mt-3 row">
      <div class="col-12">
        <h4>Physical</h4>
      </div>
      <div class="col-sm-2">
        <p><b>Temperature</b>: <?= $doc['temp'] ?>&deg;C</p>
      </div>
      <div class="col-sm-2">
        <p><b>Weight</b>: <?= $doc['weight'] ?>kg</p>
      </div>
      <div class="col-sm-2">
        <p><b>Pulse</b>: <?= $doc['pulse'] ?>bps</p>
      </div>
      <div class="col-sm-2">
        <p><b>B/P</b>: <?= $doc['bp'] ?>(mmHg)</p>
      </div>
      <div class="col-sm-2">
        <p><b>B/P</b>: <?= $doc['bp'] ?>(mmHg)</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <p><b>Complaints</b></p>
        <p><?= $doc['complaint'] ?></p>
      </div>
      <div class="col-md-6">
        <p><b>Diagnosis</b></p>
        <p><?= $doc['diagnosis'] ?></p>
      </div>
      <div class="col-md-6">
        <p><b>Investigations</b></p>
        <p><?= $doc['lab_tests'] ?></p>
      </div>
      <div class="col-md-6">
        <p><b>Treatments</b></p>
        <p><?= $doc['treatments'] ?></p>
      </div>
    </div>

    <div class="my-3 row">
      <h4 class="col-12">Admission</h4>
      <div class="col-md-6">
        <p><b>Admitted On</b></p>
        <p><?= $doc['admission_date'] ?></p>
      </div>
      <div class="col-md-6">
        <p><b>Discharged On</b></p>
        <p><?= $doc['discharge_date'] ?></p>
      </div>
      <div class="col-md-6">
        <p><b>Admission Summary</b></p>
        <p><?= $doc['admission_summary'] ?></p>
      </div>
    </div>

    <div class="my-3 row">
      <h4 class="col-12">Billing</h4>
      <div class="col-sm-3"><b>Total Bill: </b><?= $doc['total_bill'] ?></div>
      <div class="col-sm-3"><b>Amount Paid: </b><?= $doc['amount_paid'] ?></div>
      <div class="col-sm-3"><b>Deposit: </b><?= $doc['deposit'] ?></div>
      <div class="col-sm-3"><a href="/bill.php?id=<?= $doc_id ?>">Submit Bill Info</a></div>
    </div>
  </div>
</main>
<?php
require 'footer.php';
