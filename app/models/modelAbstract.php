<?php

abstract class modelAbstract {

    static public function get() {
        $obj = new static();
        $query_buildre = new queryBuilder($obj);
        return $query_buildre->get();
    }

    static public function find($id) {
        $obj = new static();
        $query_builder = new queryBuilder($obj);
        return $query_builder->find($id);
    }

    static public function first() {
        $obj = new static();
        $query_builder = new queryBuilder($obj);
        return $query_builder->first();
    }

    static public function where($key, $operator, $value) {
        $obj = new static();
        $query_builder = new queryBuilder($obj);
        $query_builder->where($key, $operator, $value);
        return $query_builder;
    }

    static public function create(array $params) {
        if(count($params)) {
            $obj = new static();
            $keys = [];
            $values = [];
            foreach($params as $pkey => $pval) {
                $keys[] = db::real_string($pkey);
                $values[] = db::real_string($pval);
            }
            $query_string = " INSERT INTO ".$obj->getTable()." (`".implode("`,`",$keys)."`) values ('".implode("','",$values)."') ";
            db::query($query_string);
            $last_id = db::insert_id();
            return static::find($last_id);
        }
    }

    public function getTable() {
        return $this->_table;
    }

    public function getColumns() {
        return $this->_columns;
    }

    public function prepareModel($val_arr) {
        if(count($val_arr)) {
            $obj = new static();
            foreach($val_arr as $key => $val) {
                $obj->$key = $val;
            }
            return $obj;
        }
    }

    public function save() {
        $columns = $this->getColumns();
        if(count($columns)) {
            $query_string = " UPDATE ".$this->getTable()." SET ";
            foreach($columns as $lp => $column) {
                if($lp>0)
                    $query_string .= ", ";

                $val = 'null';
                if(!empty($this->$column))
                    $val = "'".$this->$column."'";

                $query_string .= " `".$column."`=".$val." ";
            }
            $query_string .= " WHERE id=".$this->id;
            db::query($query_string);
        }
    }

    public function delete() {
        $query = ' delete from '.$this->getTable().' where id='.$this->id;
        db::query($query);
    }

}

?>