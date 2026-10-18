<?php
session_start();
require 'includes/validation.php';

$errors   = [];
$email    = '';
$feedback = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '') {
        $errors['email'] = 'Please enter your email address';
    } elseif (!preg_match(EMAIL_REGEX, $email)) {
        $errors['email'] = 'Please enter a valid email address';
    }

    if ($password === '') {
        $errors['password'] = 'Please enter your password';
    }

    if (!$errors) {
        // No database here — this simulates a login check.
        if ($email === 'admin@terracoffee.com' && $password === '12345') {
            session_regenerate_id(true);
            $_SESSION['loggedInUser'] = $email;
            header('Location: index.php');
            exit;
        }
        $feedback = 'Incorrect email or password. Please try again.';
    }
}

$justRegistered = isset($_GET['registered']);

$pageTitle    = 'Log In — Terra Coffee Co.';
$bodyClass    = 'auth-page';
$extraCss     = 'css/forms.css';
$navCtaText   = 'Create Account';
$navCtaHref   = 'register.php';

include 'includes/header.php';
include 'includes/nav.php';
?>

  <!-- Auth section -->
  <section class="auth-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">

          <div class="auth-heading">
            <h1>Welcome back</h1>
            <p>Sign in to reorder your favorite roast and manage your subscription.</p>
          </div>

          <div class="auth-card">
            <form id="loginForm" action="login.php" method="post" novalidate>
              <div class="bean-field">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" autocomplete="email"
                       class="<?= input_class($errors, 'email') ?>" value="<?= e($email) ?>">
                <?php field_error($errors, 'email', 'email'); ?>
              </div>

              <div class="bean-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" autocomplete="current-password"
                       class="<?= input_class($errors, 'password') ?>">
                <?php field_error($errors, 'password', 'password'); ?>
              </div>

              <div class="order-options">
                <label for="remember">
                  <input type="checkbox" id="remember" name="remember">
                  Remember me
                </label>
                <a href="#">Forgot password?</a>
              </div>

              <button type="submit" class="btn-roast btn-roast-full">Log In</button>

              <p id="login-feedback" class="form-feedback <?= $feedback ? 'is-error' : ($justRegistered ? 'is-success' : '') ?>">
                <?php
                if ($feedback) {
                    echo e($feedback);
                } elseif ($justRegistered) {
                    echo 'Account created! You can log in now.';
                }
                ?>
              </p>
            </form>

            <p class="account-switch">
              Don't have an account? <a href="register.php">Create one</a>
            </p>
          </div>

        </div>
      </div>
    </div>
  </section>

<?php include 'includes/footer-simple.php'; ?>
