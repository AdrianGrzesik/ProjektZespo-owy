<?php

class products {

    public function productsList($active_page = null) {

        if(!$active_page)
            $active_page = 1;
        //for future filters
        $search_name = '';
        $prod_q = productModel::where('deleted','=',0);
        if($search_name)
            $prod_q->where('name','like','%'.$search_name.'%');
        //counting pages
        $products_count = $prod_q->count();
        $per_page = 9;

        $pages_count = floor($products_count/$per_page);
        if($products_count%$per_page!=0)
            $pages_count++;
        //current page
        $offset = $active_page*$per_page-$per_page;
        //products to show
        $products = $prod_q->limit($offset, $per_page)->get();
        //the view
        $view = new views('products_list');
        $view->with('products',$products);
        $view->with('pages_count',$pages_count);
        return $view->render();
    }

    

}