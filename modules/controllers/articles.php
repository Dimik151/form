<?php 

namespace Controllers;

class Articles extends BaseController {

    private function check_user(int $article_index) {
        $articles = new \Models\Artic();
        $article = $articles->get_or_404($article_index, 'id', 'user');
        if (!($this->current_user && ($this->current_user['id'] == $article['user'] || $this->current_user['admin'])))
            throw new \Page403Exception();
    }

    function list () {
        $cats = new \Models\Category();
        $cats->select();
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $w = ' (title LIKE ? OR description LIKE ?)';
            $f = '%' . $_GET['filter'] . '%';
            $p[] = $f;
            $p[] = $f;
        }
        $artics = new \Models\Artic();
        $artic_count_rec = $artics->get_record('COUNT(*) AS cnt', NULL, $w, $p);
        $paginator = new \Paginator($artic_count_rec['cnt'], ['filter']);
        $artics->select('articles.id, title, uploaded, ' . 
            'users.name AS user_name, categories.name AS cat_name, ' . 
            'categories.slug, (SELECT COUNT(*) FROM comments ' . 
            'WHERE comments.article = articles.id) AS comment_count',
            ['users', 'categories'],$w, $p,'', $paginator->first_record_num, \Settings\RECORD_ON_PAGE);
        $ctx = ['cats' => $cats, 'artic' => $artics, 'paginator' => $paginator];
        $this->render('list', $ctx);
    }

    function item(int $index) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$this->current_user)
                throw new \Page403Exception();
            \Helpers\check_token($_POST);
            $comment_form = \Forms\Comment::get_normalized_data($_POST);
            if (!isset($comment_form['__errors'])) {
                $comment_form = \Forms\Comment::get_prepared_data($comment_form);
                $comment_form['article'] = $index;
                $comment_form['user'] = $this->current_user['id'];
                $comments = new \Models\Comment();
                $comments->insert($comment_form);
                \Helpers\redirect('/' . $index . \Helpers\get_GET_params(['page', 'filter', 'ref']));
            }
        } else 
            $comment_form = \Forms\Comment::get_initial_data();
        $comment_form['__token'] = \Helpers\generate_token();
        $artics = new \Models\Artic();
        $artic = $artics->get_or_404($index, 'articles.id', 'articles.id, title, ' .
            'description, filename, uploaded, users.id AS user_id, users.name AS user_name, ' .
            'categories.name AS cat_name, categories.slug, ' .
            '(SELECT COUNT(*) FROM comments WHERE ' .
            'comments.article = articles.id) AS comment_count',
            ['users', 'categories']);
        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            switch ($_GET['sort']) {
                case 'uploaded' :
                    $w = 'uploaded DESC';
                    $s['uploaded'] = 'selected';
                    break;
                case 'users' :
                    $w = 'user_name';
                    $s['users'] = 'selected';
                    break;
            }
        }else 
            $w = 'uploaded DESC';
        $comments = new \Models\Comment();
        $comments->select('comments.id, content, users.name AS user_name, ' .
            'uploaded, users.id AS user_id',  ['users'], 'article = ?', [$index], $w);
        $ctx = ['artic' => $artic, 'site_title' => $artic['title'], 'comment' => $comments, 'form' => $comment_form, 'save' => $s];
        $this->render('item', $ctx);
    }

    function by_cat(string $slug) {
        $cats = new \Models\Category();
        $cat = $cats->get_or_404($slug, 'slug', 'id, name');
        $w = 'category = ?';
        $p = [$cat['id']];
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $w .= ' AND (title LIKE ? OR description LIKE ?)';
            $f = '%' . $_GET['filter'] . '%';
            $p[] = $f; 
            $p[] = $f;
        }
        $artics = new \Models\Artic();
        $artic_count_rec = $artics->get_record('COUNT(*) AS cnt', NULL, $w, $p);
        $paginator = new \Paginator($artic_count_rec['cnt'], ['filter']);
        $artics->select('articles.id, title, uploaded, ' . 
            'users.name AS user_name, ' . 
            '(SELECT COUNT(*) FROM comments WHERE ' .
            'comments.article = articles.id) AS comment_count', 
            ['users'], $w, $p, '',
            $paginator->first_record_num, \Settings\RECORD_ON_PAGE);
        $ctx = ['cat' => $cat, 'artic' => $artics, 'paginator' => $paginator, 'site_title' => $cat['name']];
        $this->render('by_cat', $ctx);
    }

    function all_cat() {
        $cats = new \Models\Category();
        $cats->select('categories.name AS cat_name, slug, ' .
        '(SELECT COUNT(*) FROM articles WHERE ' .
        'articles.category = categories.id) AS pic_cnt');
        $ctx = ['cats' => $cats];
        $this->render('all_cat', $ctx);
    }

    function by_user(string $user) {
        $users = new \Models\User();
        $use = $users->get_or_404($user, 'name', 'id, name');
        $w = 'user = ?';
        $p = [$use['id']];
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $w .= ' AND (title LIKE ? OR description LIKE ?)';
            $f = '%' . $_GET['filter'] . '%';
            $p[] = $f;
            $p[] = $f;
        }
        $artics = new \Models\Artic();
        $artic_count_rec = $artics->get_record('COUNT(*) AS cnt', NULL, $w, $p);
        $paginator = new \Paginator($artic_count_rec['cnt'], ['filter']);
        $artics->select('articles.id, title, uploaded, ' . 
            'users.name AS user_name, ' . 
            '(SELECT COUNT(*) FROM comments WHERE ' .
            'comments.article = articles.id) AS comment_count, articles.user', 
            ['users'], $w, $p, '',
            $paginator->first_record_num, \Settings\RECORD_ON_PAGE);
        $ctx = ['user' => $use, 'artic' => $artics, 'paginator' => $paginator];
        $this->render('by_user', $ctx);
    }

    function add(string $username) {
        if (!$this->current_user)
            throw new \Page403Exception();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \Helpers\check_token($_POST);
            $picture_form = \Forms\Picture::get_normalized_data($_POST);
            if (!isset($picture_form['__errors'])) {
                $picture_form = \Forms\Picture::get_prepared_data($picture_form);
                $users = new \Models\User();
                $user = $users->get_or_404($username, 'name', 'id');
                $picture_form['user'] = $user['id'];
                $articles = new \Models\Artic();
                $articles->insert($picture_form);
                \Helpers\redirect('/users/' . $username);
            }
        } else 
            $picture_form = \Forms\Picture::get_initial_data();
        $picture_form['__token'] = \Helpers\generate_token();
        $categories = new \Models\Category();
        $categories->select();
        $ctx = ['site_title' => 'Добавление изображения', 'username' => $username, 'form' => $picture_form, 'categories' => $categories];
        $this->render('article_add', $ctx);
    }

    function edit(int $index, string $username) {
        $this->check_user($index);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \Helpers\check_token($_POST);
            $picture_form = \Forms\Picture::get_normalized_data($_POST);
            if (!isset($picture_form['__errors'])) {
                $picture_form = \Forms\Picture::get_prepared_data($picture_form);
                $users = new \Models\User();
                $user = $users->get_or_404($username, 'name', 'id');
                $picture_form['user'] = $user['id'];
                $articles = new \Models\Artic();
                $articles->update($picture_form, $index);
                \Helpers\redirect('/');
            }
        } else 
            $articles = new \Models\Artic();
            $article = $articles->get_or_404($index);
            $picture_form = \Forms\Picture::get_initial_data($article);
        $picture_form['__token'] = \Helpers\generate_token();
        $categories = new \Models\Category();
        $categories->select();
        $ctx = ['site_title' => 'Редактирование статьи', 'form' => $picture_form, 'categories' => $categories];
        $this->render('article_edit', $ctx);
    }

    function delete(int $index, string $username) {
        $this->check_user($index);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            \Helpers\check_token($_POST);
            $articles = new \Models\Artic();
            $articles->delete($index);
            \Helpers\redirect('/');
        }else {
            $users = new \Models\User();
            $users->select('*', NULL, '', NULL, 'name');
            $artics = new \Models\Artic();
            $artic = $artics->get_or_404($index, 'articles.id', 'articles.id, title, ' .
                'description, filename, uploaded, users.name AS user_name, ' .
                'categories.name AS cat_name, categories.slug, ' .
                '(SELECT COUNT(*) FROM comments WHERE ' .
                'comments.article = articles.id) AS comment_count',
                ['users', 'categories']);
            $ctx = ['artic' => $artic, 'site_title' => $artic['title'], 'users' => $users, '__token' => \Helpers\generate_token()];
            $this->render('article_delete', $ctx);
        }
    }

}
