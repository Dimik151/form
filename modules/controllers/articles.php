<?php 

namespace Controllers;

class Articles extends BaseController {

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
        $artics = new \Models\Artic();
        $artic = $artics->get_or_404($index, 'articles.id', 'articles.id, title, ' .
            'description, filename, uploaded, users.name AS user_name, ' .
            'categories.name AS cat_name, categories.slug, ' .
            '(SELECT COUNT(*) FROM comments WHERE ' .
            'comments.article = articles.id) AS comment_count',
            ['users', 'categories']);
        $comments = new \Models\Comment();
        $comments->select('comments.id, content, users.name AS user_name, ' .
            'uploaded', ['users'], 'article = ?', [$index], '');
        $ctx = ['artic' => $artic, 'site_title' => $artic['title'], 'comment' => $comments];
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
            'comments.article = articles.id) AS comment_count', 
            ['users'], $w, $p, '',
            $paginator->first_record_num, \Settings\RECORD_ON_PAGE);
        $ctx = ['user' => $use, 'artic' => $artics, 'paginator' => $paginator];
        $this->render('by_user', $ctx);
    }
}
