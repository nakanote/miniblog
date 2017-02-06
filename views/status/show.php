<?php $this->setLayoutVar('title', $status['user_name']) ?>
<?php $this->setLayoutVar('css', 'status/index.css') ?>

<ul class="timeline">
<?php echo $this->render('status/status', array('key' => 0, 'status' => $status)); ?>
</ul>
