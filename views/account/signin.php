<?php $this->setLayoutVar('title', 'ログイン') ?>
<?php $this->setLayoutVar('css', 'account/signin.css') ?>

<form class="form-signin" action="<?php echo $base_url; ?>/account/authenticate" method="post">
    <h2 class="form-signin-heading">ログイン</h2>
    <input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />

    <?php if (isset($errors) && count($errors) > 0) : ?>
        <?php echo $this->render('errors', array('errors' => $errors)); ?>
    <?php endif; ?>

    <?php echo $this->render('account/inputs', array(
        'user_name' => $user_name, 'password' => $password,
    )); ?>

    <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
</form>

