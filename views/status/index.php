<?php $this->setLayoutVar('title', 'ホーム') ?>
<?php $this->setLayoutVar('css', 'status/index.css') ?>
<?php $this->setLayoutVar('js', 'status/index.js') ?>

<h2>ホーム</h2>

<form id="form-comment" action="<?php echo $base_url; ?>/status/post" method="post">
    <input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />
    <input type="hidden" name="offset" value="" />

    <div id="error_area"></div>

    <textarea class="form-control" name="body" rows="2" cols="60"><?php echo $this->escape($body); ?></textarea>
    <p>
        <input class="btn btn-primary" type="submit" value="発言" />
    </p>
</form>

<button id="method-reload">更新</button>

<ul class="timeline" id="timeline">
<?php foreach ($statuses as $key => $status) : ?>
<?php echo $this->render('status/status', array('key' => $key, 'status' => $status)); ?>
<?php endforeach; ?>
</ul>
