<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<?php if (isset($title)) : ?>
    <title><?php echo $this->escape($title); ?> - Mini Blog</title>
<?php else : ?>
    <title>Mini Blog</title>
<?php endif; ?>

    <link href="<?php echo $base_url; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/css/style.css" rel="stylesheet">
<?php if (isset($css)) : ?>
    <link href="<?php echo $base_url; ?>/css/<?php echo $this->escape($css); ?>" rel="stylesheet">
<?php endif; ?>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="header">
        <h1><a href="<?php echo $base_url; ?>/">Mini Blog</a></h1>
    </div>

    <div id="nav">
        <p>
            <?php if ($session->isAuthenticated()) : ?>
                <a href="<?php echo $base_url; ?>/">ホーム</a>
                <a href="<?php echo $base_url; ?>/account">アカウント</a>
            <?php else : ?>
                <a href="<?php echo $base_url; ?>/account/signin">ログイン</a>
                <a href="<?php echo $base_url; ?>/account/signup">アカウント登録</a>
            <?php endif; ?>
        </p>
    </div>

    <div id="main">
        <?php echo $_content; ?>
    </div>

    <script src="<?php echo $base_url; ?>/js/jquery.min.js"></script>
    <script src="<?php echo $base_url; ?>/js/bootstrap.min.js"></script>
<?php if (isset($js)) : ?>
    <script src="<?php echo $base_url; ?>/js/<?php echo $this->escape($js); ?>"></script>
<?php endif; ?>

</body>
</html>
