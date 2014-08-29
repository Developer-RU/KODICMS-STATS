<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Stats_Insert extends Model {

    public $_table = 'stats';
	
    public function insert($columns, $values) {

        $query = DB::insert($this->_table, $columns)
                ->values($values);

        return $query->execute();
    }

}
