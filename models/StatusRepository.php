<?php

/**
 * StatusRepository.
 *
 * @author Katsuhiro Ogawa <fivestar@nequal.jp>
 */
class StatusRepository extends DbRepository
{
    public function insert($user_id, $body)
    {
        $now = new DateTime();

        $sql = "
            INSERT INTO status(user_id, body, created_at)
                VALUES(:user_id, :body, :created_at)
        ";

        $stmt = $this->execute($sql, array(
            ':user_id'    => $user_id,
            ':body'       => $body,
            ':created_at' => $now->format('Y-m-d H:i:s'),
        ));
    }

    public function fetchAllPersonalArchivesByUserId($user_id, $offset = 0, $flgNew = true)
    {
        $sqlNew = $flgNew ? ">" : "<";

        $sql = "
            SELECT a.*, u.user_name, CASE WHEN a.user_id = :user_id THEN true ELSE false END as flg_own
            FROM status a
                LEFT JOIN user u ON a.user_id = u.id
                LEFT JOIN following f ON f.following_id = a.user_id
                    AND f.user_id = :user_id
                WHERE (f.user_id = :user_id OR u.id = :user_id) AND a.id " . $sqlNew . " :offset
                ORDER BY a.created_at DESC
                LIMIT 10
        ";

        return $this->fetchAll($sql, array(':user_id' => $user_id, ':offset' => $offset));
    }

    public function fetchAllByUserId($user_id)
    {
        $sql = "
            SELECT a.*, u.user_name, CASE WHEN a.user_id = :user_id THEN true ELSE false END as flg_own
                FROM status a
                    LEFT JOIN user u ON a.user_id = u.id
                WHERE u.id = :user_id
                ORDER BY a.created_at DESC
        ";

        return $this->fetchAll($sql, array(':user_id' => $user_id));
    }

    public function fetchByIdAndUserName($id, $user_name)
    {
        $sql = "
            SELECT a.* , u.user_name, true as flg_own
                FROM status a
                    LEFT JOIN user u ON u.id = a.user_id
                WHERE a.id = :id
                    AND u.user_name = :user_name
        ";

        return $this->fetch($sql, array(
            ':id'        => $id,
            ':user_name' => $user_name,
        ));
    }
}
