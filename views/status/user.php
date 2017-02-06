<?php $this->setLayoutVar('title', $user['user_name']) ?>
<?php $this->setLayoutVar('css', 'status/index.css') ?>

<h2><?php echo $this->escape($user['user_name']); ?></h2>

<?php if (!is_null($following)) : ?>
<?php if ($following) : ?>
<p>フォローしています</p>
<?php else : ?>
<form action="<?php echo $base_url; ?>/follow" method="post">
    <input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />
    <input type="hidden" name="following_name" value="<?php echo $this->escape($user['user_name']); ?>" />

    <input type="submit" value="フォローする" />
</form>
<?php endif; ?>
<?php endif; ?>

<ul class="timeline">
<?php foreach ($statuses as $key => $status) : ?>
<?php echo $this->render('status/status', array('key' => $key, 'status' => $status)); ?>
<?php endforeach; ?>
</ul>
