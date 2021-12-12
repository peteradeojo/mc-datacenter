<?php

namespace Patient;

use Exception;
use Patient\Database;

class Documentation extends Patient
{
  private $cxn;
  // private collate;

  function __construct($data)
  {
    $this->category = $data['category'];
    $this->hospital_number = $data['hospital-number'];
    $this->date = $data['date'];
    $this->auth_code = @$data['auth_code'];
    $this->weight = $data['weight'];
    $this->temp = $data['temp'];
    $this->pulse = $data['pulse'];
    $this->resp = $data['resp'];
    $this->bp = @$data['bp'];
    $this->complaint = @$data['complaint'];
    $this->diagnosis = @$data['diagnosis'];
    $this->investigations = @$data['tests'];
    $this->treatments = @$data['treatments'];
    $this->adm_date = @$data['admission'];
    $this->dis_date = @$data['discharge'];
    $this->adm_summary = @$data['admission-summary'];
    $this->deposit = @$data['deposit'];
    $this->bill = @$data['amt_billed'];
    $this->paid = @$data['amt_paid'];
  }

  public function initFile($columns = null)
  {
    if (!is_dir($this->filedir)) {
      mkdir(directory: $this->filedir, recursive: true);
    }
    // echo $this->filename;
    $fh = fopen($this->filename, 'a+');
    $headers = fgetcsv($fh, filesize($this->filename));
    // print_r($headers);
    if (!$headers) {
      if (!$columns) {
        $columns = array('category', 'hospital_number', 'name', 'sex', 'dob', 'origin', 'tribe', 'address', 'religion', 'marital_status', 'occupation', 'email', 'phone', 'hmo_id', 'nhis_id', 'auth_code', 'company_name');
      }
      fputcsv(stream: $fh, fields: $columns);
    }
    return $fh;
  }

  private function collate()
  {
    $rowval = [
      'documentations' => [
        'category' => $this->category,
        'hospital_number' => $this->hospital_number,
        'date' => $this->date,
        'weight' => (float) $this->weight,
        'temp' => (float) $this->temp,
        'pulse' => (int) $this->pulse,
        'bp' => $this->bp,
        'complaint' => $this->complaint,
        'diagnosis' => $this->diagnosis,
        'lab_tests' => $this->investigations,
        'treatments' => $this->treatments,
        'admission_date' => $this->adm_date ? $this->adm_date : null,
        'discharge_date' => $this->dis_date ? $this->dis_date : null,
        'admission_summary' => $this->adm_summary,
        'resp' => (int) $this->resp,
        'total_bill' => (float) $this->bill,
        'deposit' => (float) $this->deposit,
        'amount_paid' => (float) $this->paid,
      ],
    ];

    if ($this->auth_code) {
      $rowval['documentations']['auth_code'] = $this->auth_code;
    }

    return $rowval;
  }

  public function save()
  {
    // echo json_encode($this->collate());
    // print_r($this->collate());
    try {
      $this->insert($this->collate());
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
  }
}
