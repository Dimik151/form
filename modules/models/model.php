<?php 

namespace Models;

require_once $base_path . 'modules\helpers.php';

class Model implements \Iterator {

    protected const TABLE_NAME = '';
    protected const DEFAULT_ORDER = '';
    protected const RELATIONS = [];

    static private $connection = NULL;
    static private $connection_count = 0;

    private $query = NULL;
    private $record = FALSE;

    function __construct() {
        if (!self::$connection)
            self::$connection = \Helpers\connect_to_db();
        self::$connection_count++;
    }

    function __destruct() {
        self::$connection_count--;
        if (self::$connection_count == 0)
            self::$connection = NULL;
    }

    function run($sql, $params = NULL) {
        if ($this->query)
            $this->query->closeCursor();
        $this->query = self::$connection->prepare($sql);
        if ($params) {
            foreach ($params as $key => $value) {
                $k = (is_integer($key)) ? $key + 1 : $key;
                switch (gettype($value)) {
                    case 'integer':
                        $t = \PDO::PARAM_INT;
                        break;
                    case 'boolean':
                        $t = \PDO::PARAM_BOOL;
                        break;
                    case 'NULL':
                        $t = \PDO::PARAM_NULL;
                        break;
                    default:
                        $t = \PDO::PARAM_STR;
                }
                $this->query->bindValue($k, $value, $t);
            }
        }
        $this->query->execute();
    }

    function select ($field = '*', $links = NULL, $where = '', $params = NULL, $order = '', $offset = NULL, $limit = NULL, $group = '', $having = '') {
        $s = 'SELECT ' . $field . ' FROM ' . static::TABLE_NAME;
        if ($links)
            foreach ($links as $ext_table) {
                $rel = static::RELATIONS[$ext_table];
                $s .= ' ' . ((key_exists('type', $rel)) ? 
                    $rel['type'] : 'INNER') . ' JOIN ' . $ext_table . 
                    ' ON ' . static::TABLE_NAME . '.' . 
                    $rel['external'] . ' = ' . $ext_table . '.' . 
                    $rel['primary'];
            }
        if ($where)
            $s .= ' WHERE ' . $where;
        if ($group){
            $s .= ' GROUP BY ' . $group;
            if ($having)
                $s .= ' HAVING ' . $having;
        }
        if ($order)
            $s .= ' ORDER BY ' . $order;
        else
            $s .= ' ORDER BY ' . static::DEFAULT_ORDER;
        if ($limit && $offset !== NULL)
            $s .= ' LIMIT ' . $offset . ', ' . $limit;
        $s .= ';';
        $this->run($s, $params);
    }

    function current() {
        return $this->record;
    }

    function key() {
        return 0;
    }

    function next() {
        $this->record = $this->query->fetch(\PDO::FETCH_ASSOC);
    }

    function rewind() {
        $this->record = $this->query->fetch(\PDO::FETCH_ASSOC);
    }

    function valid() {
        return $this->record !== FALSE;
    }

    function get_record ($fields = '*', $links = NULL, $where = '', $params = NULL) {
        $this->record = FALSE;
        $this->select($fields, $links, $where, $params);
        return $this->query->fetch(\PDO::FETCH_ASSOC);
    }

    function get ($value, $key_field = 'id', $fields = '*', $links = NULL) {
        return $this->get_record($fields, $links, $key_field . ' = ?', [$value]);
    }

    function get_or_404 ($value, $key_field = 'id', $fields = '*', $links = NULL) {
        $rec = $this->get($value, $key_field, $fields, $links);
        if ($rec)
            return $rec;
        else 
            throw new \Page404Exception();
    }
}
