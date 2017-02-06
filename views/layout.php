<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo isset($title) ? $this->escape($title) . " - " : ""; ?>Mini Blog</title>

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
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $base_url; ?>/">Mini Blog</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li<?php echo ($path === "/") ? " class=\"active\"" : ""; ?>><a href="<?php echo $base_url; ?>/">ホーム</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($session->isAuthenticated()) : ?>
                        <li class="dropdown">
                            <a href="<?php echo $base_url; ?>/account" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">アカウント <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li<?php echo ($path === "/account") ? " class=\"active\"" : ""; ?>><a href="<?php echo $base_url; ?>/account">アカウント情報</a></li>
                                <li<?php echo ($path === "/account/password") ? " class=\"active\"" : ""; ?>><a href="<?php echo $base_url; ?>/account/password">パスワード変更</a></li>
                                <li><a href="<?php echo $base_url; ?>/account/signout">ログアウト</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo $base_url; ?>/account/delete">退会</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li<?php echo ($path === "/account/signup") ? " class=\"active\"" : ""; ?>><a href="<?php echo $base_url; ?>/account/signup">会員登録</a></li>
                        <li<?php echo ($path === "/account/signin") ? " class=\"active\"" : ""; ?>><a href="<?php echo $base_url; ?>/account/signin">ログイン</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php echo $_content; ?>
    </div>

    <script src="<?php echo $base_url; ?>/js/jquery.min.js"></script>
    <script src="<?php echo $base_url; ?>/js/bootstrap.min.js"></script>
<?php if (isset($js)) : ?>
    <script src="<?php echo $base_url; ?>/js/<?php echo $this->escape($js); ?>"></script>
<?php endif; ?>

</body>
</html>
