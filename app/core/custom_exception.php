<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?= PUBLIC_PATH ?>images/favicon.png" type="image/x-icon">
  <title>404 Not Found</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    .contain-wrapper {
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .exeption {
      color: #B71C1C;
      margin-bottom: 0;
    }

    .box-message {
      margin-top: 2rem;
      padding: 1.7rem;
      border: 1px solid #e7e7e7;
      margin-right: auto;
      margin-left: auto;
      border-radius: 3px;
    }

    .error-message {
      color: #313131;
      width: 80vw;
      overflow-wrap: break-word;
    }
  </style>
</head>

<body>
  <div class="contain-wrapper">
    <h1 class="exeption"><?= $title; ?></h1>
    <div class="box-message">
      <h3 class="error-message">
        <?= $message; ?>
      </h3>
    </div>
  </div>
</body>

</html>