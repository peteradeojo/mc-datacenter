<?php

require 'init.php';

if (!$_GET['category'] or !$_GET['hospital_number']) {
  flash(['mode' => 'danger', 'title' => 'Error', 'message' => 'Incomplete patient details supplied']);
  header("Location: /");
}

$category = $_GET['category'];
$hosp_number = $_GET['hospital_number'];

$title = 'Documentation';
require 'header.php';
?>
<main>
  <div class="container pt-4">
    <h3>Enter a Documentation</h3>

    <div>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="regular-tab" data-bs-toggle="tab" data-bs-target="#regular" type="button" role="tab" aria-controls="regular" aria-selected="true">Regular</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="antenatal-tab" data-bs-toggle="tab" data-bs-target="#antenatal" type="button" role="tab" aria-controls="antenatal" aria-selected="false">Antenatal</button>
        </li>
      </ul>

      <div class="tab-content" id="myTabContent">
        <div class="tab-pane show active container p-3" id="regular" role="tabpanel" aria-labelledby="regular-tab">
          <form action="/process/documentation.php" method="post" class="row">
            <div class="form-group col-sm-3">
              <label for="category">Category</label>
              <input type="text" name="category" id="category" readonly="readonly" required="required" class="form-control" value="<?= $category ?>">
            </div>
            <div class="form-group col-sm-3">
              <label for="hospital-number">Hospital Number</label>
              <input type="text" name="hospital-number" id="hospital-number" readonly="readonly" required="required" class="form-control" value="<?= $hosp_number ?>">
            </div>
            <div class="form-group col-sm-3">
              <label for="date">Date</label>
              <input type="date" name="date" id="date" required="required" class="form-control" min="<?= date('Y-m-d', time() - 60 * 60 * 24 * 365 * 2) ?>" max="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group col-sm-3">
              <label for="auth_code">Authorization Code</label>
              <input type="text" name="auth_code" id="auth_code" class="form-control">
            </div>
            <div class="form-group col-sm-6 col-md-2">
              <label for="temp">Temperature</label>
              <input type="number" name="temp" id="temp" class="form-control" step="0.1" required>
            </div>
            <div class="form-group col-sm-6 col-md-2">
              <label for="pulse">Pulse</label>
              <input type="number" name="pulse" id="pulse" class="form-control" step="0.1" required>
            </div>
            <div class="form-group col-sm-6 col-md-2">
              <label for="resp">Respiration</label>
              <input type="number" name="resp" id="resp" class="form-control" step="0.1" required>
            </div>
            <div class="form-group col-sm-6 col-md-2">
              <label for="bp">B/P</label>
              <input type="text" name="bp" id="bp" class="form-control">
            </div>
            <div class="form-group col-sm-6 col-md-2">
              <label for="weight">Weight</label>
              <input type="number" name="weight" id="weight" class="form-control" step="0.1" required>
            </div>
            <div class="form-group col-md-6">
              <label for="complaint">Complaint</label>
              <textarea name="complaint" id="complaint" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group col-md-6">
              <label for="diagnosis">Diagnosis</label>
              <textarea name="diagnosis" id="diagnosis" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group col-md-4">
              <label for="tests">Lab Tests</label>
              <textarea name="tests" id="tests" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group col-md-7">
              <label for="treatments">Treatments</label>
              <textarea name="treatments" id="treatments" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group col-sm-6 col-md-3">
              <label for="addmission_date">Admission Date</label>
              <input type="date" name="admission" id="addmission_date" class="form-control" min="<?= date('Y-m-d', time() - 60 * 60 * 24 * 7 * 4 * 2) ?>" max="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group col-sm-6 col-md-3">
              <label for="discharge_date">Discharge Date</label>
              <input type="date" name="discharge" id="discharge_date" class="form-control" min="<?= date('Y-m-d', time() - 60 * 60 * 24 * 7 * 4 * 2) ?>" max="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group col-md-6">
              <label for="admission-summary">Admission Summary</label>
              <textarea name="admission-summary" id="admission-summary" rows="5" class="form-control"></textarea>
            </div>
            <fieldset class="col-12">
              <legend>Payment</legend>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="deposit">Deposit</label>
                  <input type="number" name="deposit" id="deposit" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label for="amt_billed">Total Bill</label>
                  <input type="number" name="amt_billed" id="amt_billed" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label for="amt_paid">Amount Paid</label>
                  <input type="number" name="amt_paid" id="amt_paid" class="form-control">
                </div>
              </div>
            </fieldset>
            <div class="form-group">
              <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </div>
          </form>
        </div>

        <!-- Antenatal Patients form -->
        <div class="tab-pane container p-3" id="antenatal" role="tabpanel" aria-labelledby="antenatal-tab">...</div>
      </div>
    </div>

  </div>
</main>

<?php
require 'footer.php';
