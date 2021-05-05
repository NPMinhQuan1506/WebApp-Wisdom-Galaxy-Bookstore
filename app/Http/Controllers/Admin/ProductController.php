<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Core\GoogleDriverController;
use App\Models\Author;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Publisher;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        return view('admin.product_list',compact('products'));
    }
    public static  function getAuthor($sku){
        $authorList =  ProductDetail::find($sku)->author;
        $authors = "";
        foreach ($authorList as $author){
            $authors =  $authors.", ".$author->name;
        }
        return substr($authors, 1, strlen($authors)-1);
    }
    public static  function getCategory($sku){
        $categoryList = Product::find($sku)->category()->whereRaw("`category`.`right` -`category`.`left` = 1")->get();
        $categories = "";
        foreach($categoryList as $row){
            $categories = $categories.", ".$row->name;
        }
        return substr($categories, 1, strlen($categories)-1);
    }
    //FIND THE IMMEDIATE SUBORDINATES OF A NODE IN CATEGORY
    public function getChildCategory(Request $request)
    {
        $id = $request->id;
        $child_categories = DB::select('SELECT node.id, node.name, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth
        FROM category AS node,
                    category AS parent,
                    category AS sub_parent,
                    (
                        SELECT node.name, (COUNT(parent.name) - 1) AS depth
                        FROM category AS node,
                                    category AS parent
                        WHERE node.left BETWEEN parent.left AND parent.right  AND node.id = ?
                        GROUP BY node.name
                        ORDER BY node.left
                    ) AS sub_tree
        WHERE node.left BETWEEN parent.left AND parent.right
                AND node.left BETWEEN sub_parent.left AND sub_parent.right
                AND sub_parent.name = sub_tree.name
        GROUP BY node.name, node.id
        HAVING depth = 1
        ORDER BY node.left', [$id]);
        $categories="";
                foreach($child_categories as $row){
                    $categories = $categories.", ".$row->name;
                }
        return $child_categories;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = DB::select('SELECT c.id, c.name
        FROM (SELECT node.id, node.name, (COUNT(parent.name)-1) as depth
                    FROM category as node, category as parent
                    WHERE  node.left BETWEEN parent.left AND parent.right
                    GROUP BY node.name, node.id
                    ORDER BY node.left) as c
                    WHERE c.depth = (SELECT MIN(d.depth)
                                                    FROM(SELECT node.name, (COUNT(parent.name)-1) as depth
                                                                FROM category as node, category as parent
                                                                WHERE  node.left BETWEEN parent.left AND parent.right
                                                                GROUP BY node.name
                                                                ORDER BY node.left) as d)');
        $suppliers = Supplier::all();
    	$publishers = Publisher::all();
        $authors = Author::all();
        return view('admin.product_add', compact('categories', 'suppliers', 'publishers', 'authors'));
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
    public function show($id)
    {
        //
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
}
