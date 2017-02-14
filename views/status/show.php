<?php $this->setLayoutVar('title', $status['user_name']) ?>
<?php $this->setLayoutVar('css', 'status/index.css') ?>

<ul class="timeline" id="timeline">
<?php echo $this->render('status/status', array('key' => 0, 'status' => $status)); ?>
</ul>
