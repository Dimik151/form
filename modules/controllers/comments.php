<?php 

namespace Controllers;

class Comments extends BaseController {

    private function check_user(int $comment_index) {
        $comments = new \Models\Comment();
        $comment = $comments->get_or_404($comment_index, 'id', 'user');
        if (!($this->current_user && ($this->current_user['id'] == $comment['user'] || $this->current_user['admin'])))
            throw new \Page403Exception();
    }

    function edit(int $article_index, int $comment_index) {
        $this->check_user($comment_index);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \Helpers\check_token($_POST);
            $comment_form = \Forms\Comment::get_normalized_data($_POST);
            if (!isset($comment_form['__errors'])) {
                $comment_form = \Forms\Comment::get_prepared_data($comment_form);
                $comments = new \Models\Comment();
                $comments->update($comment_form, $comment_index);
                \Helpers\redirect('/' . $article_index . \Helpers\get_GET_params(['page', 'filter', 'ref']));
            }
        }else {
            $comments = new \Models\Comment();
            $comment = $comments->get_or_404($comment_index);
            $comment_form = \Forms\Comment::get_initial_data($comment);
        }
        $comment_form['__token'] = \Helpers\generate_token();
        $users = new \Models\User();
        $users->select('*', NULL, '', NULL, 'name');
        $ctx = ['form' => $comment_form, 'users' => $users, 'article' => $article_index, 'site_title' => 'Правка комментария'];
        $this->render('comment_edit', $ctx); 
    }

    function delete(int $article_index, int $comment_index) {
        $this->check_user($comment_index);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \Helpers\check_token($_POST);
            $comments = new \Models\Comment();
            $comments->delete($comment_index);
            \Helpers\redirect('/' . $article_index . \Helpers\get_GET_params(['page', 'filter', 'ref']));
        }else {
            $comments = new \Models\Comment();
            $comment = $comments->get_or_404($comment_index, 'comments.id', 'users.name AS user_name, content, uploaded', ['users']);
            $ctx = ['comment' => $comment, 'article' => $article_index, 'site_title' => 'Удаление комментария', '__token' => \Helpers\generate_token()];
            $this->render('comment_delete', $ctx);
        }
    }
}