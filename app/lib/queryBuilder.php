<?php

class queryBuilder {

    private $_obj = null;
    private $_table = '';
    private $_wheres = [];
    private $_offset = null;
    private $_limit = null;
    private $_select = ['*'];

    function __construct($obj) {
        $this->_obj = $obj;
        $this->_table = $this->_obj->getTable();
    }

    public function get($set_all_select = true) {
        if($set_all_select)
            $this->select(['*']);
        $recs = [];
        $q = db::query($this->_makeQuery());
        if(db::num_rows($q)) {
            while($rec = db::fetch_assoc($q))
                $recs[] = $this->_obj->prepareModel($rec);
        }
        return $recs;
    }

    public function select(array $params):self {
        $this->_select = $params;
        return $this;
    }

    public function count() {
        $this->select([' COUNT(id) as cid ']);
        $first = $this->first(false);
        if($first)
            return $first->cid;
        else
            return 0;
    }

    public function find($id) {
        $this->where('id','=',$id);
        $recs = $this->get();
        if(count($recs)==1)
            return current($recs);
    }

    public function first($set_all_select = true) {
        $recs = $this->get($set_all_select);
        if(count($recs)>0)
            return current($recs);
    }

    public function where($key, $operator, $value):self {
        $this->_wheres[] = [
            'key'=>$key,
            'operator'=>$operator,
            'value'=>$value
        ];
        return $this;
    }

    public function limit($offset, $limit):self {
        $this->_offset = $offset;
        $this->_limit = $limit;
        return $this;
    }

    private function _makeQuery() {
        $query_string = 'select '.implode(',',$this->_select).' from '.$this->_table.' ';
        if(count($this->_wheres)) {
            $query_string .= ' where ';
            foreach($this->_wheres as $lp => $one_where) {
                if($lp>0)
                    $query_string .= ' AND ';
                $query_string .= ' '.$one_where['key'].' '.$one_where['operator']." '".$one_where['value']."' ";
            }
        }

        if($this->_limit)
            $query_string .= " LIMIT ".$this->_limit." ";

        if($this->_offset)
            $query_string .= " OFFSET ".$this->_offset." ";

        return $query_string;
    }

}

?>