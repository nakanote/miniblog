<?php

/**
 * StatusController.
 *
 * @author Katsuhiro Ogawa <fivestar@nequal.jp>
 */
class StatusController extends Controller
{
    protected $auth_actions = array('index', 'post', 'offset');

    public function indexAction()
    {
        $user = $this->session->get('user');
        $statuses = $this->db_manager->get('Status')
            ->fetchAllPersonalArchivesByUserId($user['id']);

        return $this->render(array(
            'statuses' => $statuses,
            'body'     => '',
            '_token'   => $this->generateCsrfToken('status/post'),
        ));
    }

    // 最新のコメントの差分を取得
    public function offsetAction($params)
    {
        $user = $this->session->get('user');
        $statuses = $this->db_manager->get('Status')
            ->fetchAllPersonalArchivesByUserId($user['id'], $params['id']);

        // リストだけ出力（レイアウトなし）
        return $this->render(array(
            'statuses' => $statuses,
            'body'     => '',
        ), null, '');
    }

    // 古いコメントの読み込み
    public function pageAction($params)
    {
        $user = $this->session->get('user');
        $statuses = $this->db_manager->get('Status')
            ->fetchAllPersonalArchivesByUserId($user['id'], $params['id'], false);

        // リストだけ出力（レイアウトなし）
        return $this->render(array(
            'statuses' => $statuses,
            'body'     => '',
        ), 'offset', '');
    }

    public function postAction()
    {
        // 結果用配列
        $results = [];
        $errors = [];

        if (!$this->request->isPost()) {
            $this->forward404();
        }

        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('status/post', $token)) {
            $errors[] = 'トークンの取得に失敗しました。もう一度送信してください';
            $results['result'] = "fault";
            $results['_token'] = $this->generateCsrfToken('status/post');
            $results['html'] = $this->render(array(
                'errors' => $errors,
            ), '../errors', '');
        }

        $body = $this->request->getPost('body');


        if (!strlen($body)) {
            $errors[] = 'ひとことを入力してください';
        } elseif (mb_strlen($body) > 200) {
            $errors[] = 'ひとことは200 文字以内で入力してください';
        }

        // 入力エラーのない場合
        if (count($errors) === 0) {
            // コメント挿入
            $user = $this->session->get('user');
            $this->db_manager->get('Status')->insert($user['id'], $body);

            // 最新コメント取得
            $user = $this->session->get('user');
            $statuses = $this->db_manager->get('Status')
                ->fetchAllPersonalArchivesByUserId($user['id'], $this->request->getPost('offset'));

            // 成功の時
            $results['result'] = "success";
            $results['_token'] = $this->generateCsrfToken('status/post');
            $results['html'] = $this->render(array(
                'statuses' => $statuses,
            ), 'offset', '');
            // JSON形式で返信
            return json_encode($results);
        }

        // 失敗の時
        $results['result'] = "fault";
        $results['_token'] = $this->generateCsrfToken('status/post');
        $results['html'] = $this->render(array(
            'errors' => $errors,
        ), '../errors', '');
        
        // JSON形式で返信
        return json_encode($results);
    }

    public function userAction($params)
    {
        $user = $this->db_manager->get('User')
            ->fetchByUserName($params['user_name']);
        if (!$user) {
            $this->forward404();
        }

        $statuses = $this->db_manager->get('Status')
            ->fetchAllByUserId($user['id']);
        
        $following = null;
        if ($this->session->isAuthenticated()) {
            $my = $this->session->get('user');
            if ($my['id'] !== $user['id']) {
                $following = $this->db_manager->get('Following')
                    ->isFollowing($my['id'], $user['id']);
            }
        }

        return $this->render(array(
            'user'      => $user,
            'statuses'  => $statuses,
            'following' => $following,
            '_token'    => $this->generateCsrfToken('account/follow'),
        ));
    }

    public function showAction($params)
    {
        $status = $this->db_manager->get('Status')
            ->fetchByIdAndUserName($params['id'], $params['user_name']);

        if (!$status) {
            $this->forward404();
        }

        return $this->render(array('status' => $status));
    }
}
