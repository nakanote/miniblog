<?php $this->setLayoutVar('title', '会員登録') ?>
<?php $this->setLayoutVar('css', 'account/signup.css') ?>

<form class="form-signup" action="<?php echo $base_url; ?>/account/register" method="post">
    <h2 class="form-signup-heading">会員登録</h2>
    <input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />

    <?php if (isset($errors) && count($errors) > 0) : ?>
        <?php echo $this->render('errors', array('errors' => $errors)); ?>
    <?php endif; ?>

    <?php echo $this->render('account/inputs', array(
        'user_name' => $user_name, 'password' => $password,
    )); ?>

    <button class="btn btn-lg btn-primary btn-block" type="submit">登録</button>
</form>
