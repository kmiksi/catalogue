<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASE_URL ?>/favicon.ico">
    <title><?= empty($title) ? $_SERVER['REQUEST_URI'] : $title ?></title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <script type="javascript">var BASE_URL = '<?= BASE_URL ?>';</script>
</head>
<body>
<?php if (!empty($_SESSION['flash_message']['message'])) {
    $message = $_SESSION['flash_message']['message'];
    $message_type = $_SESSION['flash_message']['type'];
    unset($_SESSION['flash_message']);
    ?>
    <div id="flash_message" class="alert alert-<?= $message_type ?>">
        <span class="message">
            <?= $message ?>
        </span>
    </div>
<?php } ?>
