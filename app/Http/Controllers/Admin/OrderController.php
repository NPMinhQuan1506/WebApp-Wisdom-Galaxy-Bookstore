<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = DB::select('SELECT o.id, e.name as employee, c.name as customer, o.total_amount, o.total_payment
        FROM `order` AS o
        INNER JOIN `employee` AS e ON `o`.`employee_id` = `e`.`id`
        INNER JOIN `customer` AS c ON `o`.`customer_id` = `c`.`id`
        WHERE `o`.`is_enable` = 1
        ORDER BY `o`.`id`  ASC');

        return view('admin.order_list',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $products = DB::select('SELECT p.sku, p.barcode, p.name, s.name AS supplier,i.path, p.unit, p.inventory_number , p.min_inventory_number, p.selling_price,pd.publisher, pd.edition
        FROM `product` AS p
        INNER JOIN `supplier` AS s ON `p`.`supplier_id` = `s`.`id`
        INNER JOIN `image` AS i ON `p`.`image_id` = `i`.`id`
        INNER JOIN (SELECT pd.sku, pl.name AS publisher, pd.edition FROM `product_detail` AS pd
                    INNER JOIN `publisher` AS pl ON `pd`.`publisher_id` = `pl`.`id`
                    WHERE `pd`.`is_enable` = 1 AND `pl`.`is_enable` = 1) as pd
             		ON `p`.`sku` = `pd`.`sku`
        WHERE `p`.`is_enable` = 1
        ORDER BY `p`.`sku`  ASC');

        return view('admin.order_add',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $id = $request->id;
        $order_detail = DB::select('SELECT pd.product_id, pd.order_id, p.name as pro_name, p.unit, pd.amount, pd.selling_price
        FROM `order_detail` as pd
        INNER JOIN product as p ON `pd`.`product_id` = `p`.`sku`
        WHERE `pd`.`is_enable` =1 and `p`.`is_enable` = 1 and `pd`.`order_id` = ?', [$id]);
        return $order_detail;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function destroyDetail($order_id, $product_id)
    {
        //
    }
}
