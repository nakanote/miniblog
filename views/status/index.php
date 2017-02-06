<?php $this->setLayoutVar('title', 'ホーム') ?>
<?php $this->setLayoutVar('css', 'status/index.css') ?>

<h2>ホーム</h2>

<form action="<?php echo $base_url; ?>/status/post" method="post">
    <input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />

    <?php if (isset($errors) && count($errors) > 0) : ?>
    <?php echo $this->render('errors', array('errors' => $errors)) ?>
    <?php endif; ?>

    <textarea class="form-control" name="body" rows="2" cols="60"><?php echo $this->escape($body); ?></textarea>
    <p>
        <input class="btn btn-primary" type="submit" value="発言" />
    </p>
</form>

<ul class="timeline">
<?php foreach ($statuses as $key => $status) : ?>
<?php echo $this->render('status/status', array('key' => $key, 'status' => $status)); ?>
<?php endforeach; ?>
</ul>
