<?php
require 'includes/validation.php';

$errors = [];
$name   = '';
$email  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['full-name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm-password'] ?? '';

    // Full name
    if ($name === '') {
        $errors['full-name'] = 'Please enter your full name';
    } elseif (strlen($name) < 2) {
        $errors['full-name'] = 'Name must be at least 2 characters';
    } elseif (!preg_match(NAME_REGEX, $name)) {
        $errors['full-name'] = 'Use letters only, no numbers, no repeated capital letters, and single spaces between words.';
    }

    // Email
    if ($email === '') {
        $errors['email'] = 'Please enter your email address';
    } elseif (!preg_match(EMAIL_REGEX, $email)) {
        $errors['email'] = 'Please enter a valid email address';
    }

    // Password
    if ($password === '') {
        $errors['password'] = 'Please enter a password';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    } elseif (!preg_match(PASSWORD_REGEX, $password)) {
        $errors['password'] = 'Password must contain at least one letter and one number';
    }

    // Confirm password
    if ($confirm === '') {
        $errors['confirm-password'] = 'Please confirm your password';
    } elseif (!hash_equals($password, $confirm)) {
        $errors['confirm-password'] = 'Passwords do not match';
    }

    if (!$errors) {
        // No database here — a real app would save the user (with password_hash) first.
        header('Location: login.php?registered=1');
        exit;
    }
}

$pageTitle  = 'Create Account — Terra Coffee Co.';
$bodyClass  = 'auth-page';
$extraCss   = 'css/forms.css';
$navCtaText = 'Log In';
$navCtaHref = 'login.php';

include 'includes/header.php';
include 'includes/nav.php';
?>

  <!-- Auth section -->
  <section class="auth-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">

          <div class="auth-heading">
            <h1>Create your account</h1>
            <p>Start a subscription, save your favorite blends, and skip the line.</p>
          </div>

          <div class="auth-card">
            <form id="registerForm" action="register.php" method="post" novalidate>
              <div class="bean-field">
                <label for="full-name">Full name</label>
                <input type="text" id="full-name" name="full-name" placeholder="Juan Dela Cruz" autocomplete="name"
                       class="<?= input_class($errors, 'full-name') ?>" value="<?= e($name) ?>">
                <?php field_error($errors, 'full-name', 'full-name'); ?>
              </div>

              <div class="bean-field">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" autocomplete="email"
                       class="<?= input_class($errors, 'email') ?>" value="<?= e($email) ?>">
                <?php field_error($errors, 'email', 'email'); ?>
              </div>

              <div class="bean-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a password" autocomplete="new-password"
                       class="<?= input_class($errors, 'password') ?>">
                <p class="bean-field-hint">At least 8 characters, with a letter and a number.</p>
                <?php field_error($errors, 'password', 'password'); ?>
              </div>

              <div class="bean-field">
                <label for="confirm-password">Confirm password</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Re-enter your password" autocomplete="new-password"
                       class="<?= input_class($errors, 'confirm-password') ?>">
                <?php field_error($errors, 'confirm-password', 'confirm-password'); ?>
              </div>

              <button type="submit" class="btn-roast btn-roast-full">Create Account</button>
            </form>

            <p class="account-switch">
              Already have an account? <a href="login.php">Log in</a>
            </p>

            <p class="fine-print">
              By creating an account, you agree to Terra Coffee Co.'s Terms of Service and Privacy Policy.
            </p>
          </div>

        </div>
      </div>
    </div>
  </section>

<?php include 'includes/footer-simple.php'; ?>
