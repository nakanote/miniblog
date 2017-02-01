<label for="user_name" class="sr-only">ユーザID</label>
<input type="text" id="user_name" class="form-control" placeholder="ユーザID" name="user_name" value="<?php echo $this->escape($user_name); ?>" required autofocus>
<label for="password" class="sr-only">パスワード</label>
<input type="password" id="password" class="form-control" placeholder="パスワード" name="password" value="<?php echo $this->escape($password); ?>" required>