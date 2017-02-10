<ul id="error_list" class="error_list">
    <?php foreach ($errors as $error) : ?>
    <li><?php echo $this->escape($error); ?></li>
    <?php endforeach; ?>
</ul>
