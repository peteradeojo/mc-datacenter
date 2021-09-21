<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css" integrity="sha512-F7WyTLiiiPqvu2pGumDR15med0MDkUIo5VTVyyfECR5DZmCnDhti9q5VID02ItWjq6fvDfMaBaDl2J3WdL1uxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/src/css/style.css">
  <title><?= @$title ? $title : 'DCC' ?></title>
</head>

<body>
  <header class="bg-primary">
    <div class="container py-3">
      <div class="row">
        <div class="col-md-7">
          <h1 class="text-light">DCC</h1>
        </div>
        <div class="col-md-5 d-flex align-items-center justify-content-end">
          <a href="/" class="text-light pr-3">HOME</a>
          <a href="/documentations.php" class="pr-3 text-light px-3">DOCUMENTATIONS</a>
          <?= @$_SESSION['login'] ?
            "<a href='/logout.php' class='text-light'>LOG OUT</a>" : ''
          ?>
        </div>
      </div>
    </div>
  </header>

  <?= flash() ?>