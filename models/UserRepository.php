<?php

/**
 * UserRepository.
 *
 * @author Katsuhiro Ogawa <fivestar@nequal.jp>
 */
class UserRepository extends DbRepository
{
    public function insert($user_name, $password)
    {
        $password = $this->hashPassword($password);
        $now = new DateTime();

        $sql = "
            INSERT INTO user(user_name, password, created_at)
                VALUES(:user_name, :password, :created_at)
        ";

        $stmt = $this->execute($sql, array(
            ':user_name'  => $user_name,
            ':password'   => $password,
            ':created_at' => $now->format('Y-m-d H:i:s'),
        ));
    }

    // ユーザの削除
    public function delete($user_id)
    {
        // フォローデータの削除
        $sql = "DELETE FROM following WHERE user_id = :user_id or following_id = :following_id";
        $stmt = $this->execute($sql, array(':user_id' => $user_id, ':following_id' => $user_id));

        // コメントデータの削除
        $sql = "DELETE FROM status WHERE user_id = :user_id";
        $stmt = $this->execute($sql, array(':user_id' => $user_id));

        // ユーザデータの削除
        $sql = "DELETE FROM user WHERE id = :user_id";
        $stmt = $this->execute($sql, array(':user_id' => $user_id));
    }

    public function hashPassword($password)
    {
        return sha1($password . 'GAEF84u8aAtjijfa7663');
    }

    public function fetchByUserName($user_name)
    {
        $sql = "SELECT * FROM user WHERE user_name = :user_name";

        return $this->fetch($sql, array(':user_name' => $user_name));
    }

    public function isUniqueUserName($user_name)
    {
        $sql = "SELECT COUNT(id) as count FROM user WHERE user_name = :user_name";

        $row = $this->fetch($sql, array(':user_name' => $user_name));
        if ($row['count'] === '0') {
            return true;
        }

        return false;
    }

    public function fetchAllFollowingsByUserId($user_id)
    {
        $sql = "
            SELECT u.*
                FROM user u
                    LEFT JOIN following f ON f.following_id = u.id
                WHERE f.user_id = :user_id
        ";

        return $this->fetchAll($sql, array(':user_id' => $user_id));
    }
    
    // パスワード変更
    public function updatePassword($user_id, $password)
    {
        // パスワードのハッシュ化
        $password = $this->hashPassword($password);

        // パスワード変更
        $sql = "UPDATE user SET password = :password WHERE id = :user_id";
        $stmt = $this->execute($sql, array(':password' => $password, ':user_id' => $user_id));
    }
}
