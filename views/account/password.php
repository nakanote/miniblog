<?php $this->setLayoutVar('title', 'パスワード変更') ?>

<h2>パスワード変更</h2>

<form action="<?php echo $base_url; ?>/account/password/edit" method="post">
    <input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />

    <?php if (isset($errors) && count($errors) > 0) : ?>
        <?php echo $this->render('errors', array('errors' => $errors)); ?>
    <?php endif; ?>

    <table>
        <tbody>
            <tr>
                <th>現在のパスワード</th>
                <td>
                    <input type="password" name="password" value="<?php echo $this->escape($password); ?>" />
                </td>
            </tr>
            <tr>
                <th>新しいパスワード</th>
                <td>
                    <input type="password" name="new_password" value="<?php echo $this->escape($new_password); ?>" />
                </td>
            </tr>
            <tr>
                <th>新しいパスワード（確認）</th>
                <td>
                    <input type="password" name="new_password_confirm" value="<?php echo $this->escape($new_password_confirm); ?>" />
                </td>
            </tr>
        </tbody>
    </table>

    <p>
        <input type="submit" value="パスワード変更" />
    </p>
</form>
