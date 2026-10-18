<?php
$navCtaText = $navCtaText ?? 'Order Online';
$navCtaHref = $navCtaHref ?? 'login.php';
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-roastery" aria-label="Main navigation">
  <div class="container">
    <a class="navbar-brand" href="index.php">Terra Coffee Co.</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="mainNav">
      <ul class="navbar-nav align-items-md-center gap-md-2">
        <li class="nav-item"><a class="nav-link" href="index.php#roasts">Roasts</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#story">Our Story</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#visit">Visit</a></li>
        <li class="nav-item mt-2 mt-md-0">
          <a class="btn-roast d-inline-block" href="<?= htmlspecialchars($navCtaHref) ?>"><?= htmlspecialchars($navCtaText) ?></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
