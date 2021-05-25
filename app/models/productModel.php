<?php

class productModel extends modelAbstract {

    protected $_table = 'products';

    protected $_columns = [
        'name',
        'price',
        'description',
        'image',
        'deleted',
    ];

}