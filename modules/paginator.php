<?php 

require_once $base_path . 'modules\helpers.php';

class Paginator implements \Iterator {
    public $current_page = 1;
    public $page_count = 1;
    public $first_record_num = 1;

    private $existring_params;
    private $cur = 1;

    function __construct(int $record_count, array $existring_params = []) {
        $this->page_count = ceil($record_count /\Settings\RECORD_ON_PAGE);
        $page_num = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        if ($page_num < 1)
            $page_num = 1;
        if ($page_num > $this->page_count)
            $page_num = $this->page_count;
        $this->current_page = $page_num;
        $this->first_record_num = ($page_num - 1) * \Settings\RECORD_ON_PAGE;
        $this->existring_params = $existring_params;
    }
    
    function current() {
        return \Helpers\get_GET_params($this->existring_params, ['page' => $this->cur]);
    }

    function key() {
        return $this->cur;
    }

    function next() {
        return $this->cur++;
    }

    function rewind() {
        $this->cur = 1;
    }

    function valid() {
        return $this->cur >= 1 && $this->cur <= $this->page_count;
    }
}