<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GAP STYLE - Login</title>

  <!-- Bootstrap & Theme -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/app-theme.css" rel="stylesheet">

  <style>
    body {
      background-color: var(--bg);
      font-family: "Segoe UI", Tahoma, Arial, sans-serif;
      margin: 0;
      height: 100vh; /* full viewport height */
      display: flex;
      justify-content: center; /* horizontal center */
      align-items: center;     /* vertical center */
    }

    /* Login card style */
    .login-card {
      background-color: var(--white);
      padding: 40px 30px;
      border-radius: 14px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 400px;
    }

    .login-card h2 {
      text-align: center;
      color: var(--primary);
      margin-bottom: 30px;
      font-weight: 700;
    }

    /* Input fields */
    .login-card input {
      width: 100%;
      padding: 12px 15px;
      margin-bottom: 20px;
      border: 1.5px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      transition: all 0.3s ease;
    }

    .login-card input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 8px rgba(28,77,141,0.3);
      outline: none;
    }

    /* Login button */
    .login-card .btn-primary {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .login-card .btn-primary:hover {
      background-color: var(--dark);
      border-color: var(--dark);
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
      .login-card {
        padding: 30px 20px;
      }
    }
  </style>
</head>

<body>

  <div class="login-wrapper">
    <div class="login-card dashboard-card">
      <h2>GAP STYLE Login</h2>
      <form method="post" action="login_process.php">
        <input type="text" name="username" placeholder="Staff ID" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>

  <!-- jQuery & Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</body>
</html>
