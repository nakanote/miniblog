<li name="comment[]" data-id="<?php echo $status['id']; ?>"<?php echo ((boolean)$status['flg_own']) ? " class=\"timeline-inverted\"" : ""; ?>>
    <div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div>
    <div class="timeline-panel">
        <div class="timeline-body">
            <p><?php echo $this->escape($status['body']); ?></p>
        </div>
        <div class="timeline-heading">
            <p>
                <small class="text-muted">
                    <i class="glyphicon glyphicon-time"></i> 
                    <a href="<?php echo $base_url; ?>/user/<?php echo $this->escape($status['user_name']); ?>/status/<?php echo $this->escape($status['id']); ?>">
                        <?php echo $this->escape($status['created_at']); ?>
                    </a> by 
                    <a href="<?php echo $base_url; ?>/user/<?php echo $this->escape($status['user_name']); ?>">
                        <?php echo $this->escape($status['user_name']); ?>
                    </a>
                </small>
            </p>
        </div>
        <div class="action">
            <button type="button" class="btn btn-primary btn-xs" title="Edit">
                <span class="glyphicon glyphicon-pencil"></span>
            </button>
            <button type="button" class="btn btn-success btn-xs" title="Approved">
                <span class="glyphicon glyphicon-ok"></span>
            </button>
            <button type="button" class="btn btn-danger btn-xs" title="Delete">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
        </div>
    </div>
</li>
