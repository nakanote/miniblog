<?php foreach ($statuses as $key => $status) : ?>
<?php echo $this->render('status/status', array('key' => $key, 'status' => $status)); ?>
<?php endforeach;
