<?php
// Variables a page can set before including this file:
//   $pageTitle  - text for <title>
//   $bodyClass  - optional class on <body> (e.g. "auth-page")
//   $extraCss   - optional extra stylesheet (e.g. "css/forms.css")
$pageTitle = $pageTitle ?? 'Terra Coffee Co. — Small-Batch Roastery';
$bodyClass = $bodyClass ?? '';
$extraCss  = $extraCss  ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/site.css">
<?php if ($extraCss): ?>
  <link rel="stylesheet" href="<?= htmlspecialchars($extraCss) ?>">
<?php endif; ?>
</head>
<body<?= $bodyClass ? ' class="' . htmlspecialchars($bodyClass) . '"' : '' ?>>
