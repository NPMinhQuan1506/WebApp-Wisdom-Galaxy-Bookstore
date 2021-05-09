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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Process\Process;

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

        $googleDriver = new GoogleDriverController();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = date('d-m-Y H:i:s')."_Product_".$request->name."_".$file->getClientOriginalName();
            $fileName = preg_replace('/\-|\s|\:/', '_', $fileName);
            $extensionFile = $file->getClientOriginalExtension();
            $googleDriver->uploadFileInFolder("Product", $fileName, $file->getContent());
            $path = $googleDriver->getFileId("Product" ,$fileName);
        }
        //

        $pro_avatar = new Image();
        if(isset($path)){
            $pro_avatar->path = $path;
        }
        if(isset($extensionFile)){
        $pro_avatar->extension = $extensionFile;
        }
        $pro_avatar->save();
        if(isset($path)){
        $image_id =$pro_avatar->where('path', $path)->first()->id;
        }
        $product = new Product();
        if(isset($path)){
            $product->image_id = $image_id;
        }
        $product->barcode = $request->barcode;
        $product->name = $request->name;
        $product->selling_price = $request->selling_price;
        $product->inventory_number = 0;
        $product->unit = $request->unit;
        $product->min_inventory_number  = $request->min_inventory_number;
        $product->supplier_id = $request->supplier;
        $product->save();

        if($request->has('genre')){
            $product->category()->attach(
                $request->genre,
                [
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]
            );
        }
        else{
            $product->category()->attach(
                $request->group_genre,
                [
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]
            );
        }
        $product_detail = new ProductDetail();
        if($request->has('publisher')){
            $product_detail->sku = $product->sku;
            $product_detail->publisher_id = $request->publisher;
            $product_detail->edition = $request->has('edition') ? $request->edition : 1;
            $product_detail->save();
        }
        $product_detail =ProductDetail::find($product->sku);
        if($request->has('author')){
            $product_detail->author()->attach(
               $request->author,
                [
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]
            );
        }


        $product->save();
        return Redirect::to('/admin/san-pham/danh-sach')->with("success","Thêm Sản Phẩm thành công");
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
        //load data product
        $product = Product::find($id);
        $product_detail = $product->product_detail;
        $product_category = $product->category;
        $category_path = collect();
        foreach($product_category as $row){
            $db = DB::select('SELECT parent.id, parent.name
            FROM category AS node, category AS parent
            WHERE node.left BETWEEN parent.left AND parent.right
                    AND node.id = ?
            ORDER BY parent.left', [$row->id]);
            $category_path->push($db);
        }

        $product_author = $product_detail->author;
        $image = $product->image;

        //load data select
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
        return view('admin.product_edit', compact('product' ,'product_detail' ,'category_path' ,'product_author' ,'image' ,'categories', 'suppliers', 'publishers', 'authors'));
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
        $googleDriver = new GoogleDriverController();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = date('d-m-Y H:i:s')."_Product_".$request->name."_".$file->getClientOriginalName();
            $fileName = preg_replace('/\-|\s|\:/', '_', $fileName);
            $extensionFile = $file->getClientOriginalExtension();
            $googleDriver->uploadFileInFolder("Product", $fileName, $file->getContent());
            $path = $googleDriver->getFileId("Product" ,$fileName);
        }
        //
        $product = Product::find($id);
        $pro_avatar = Image::find($product->image_id);

        if(isset($path)){
            $pro_avatar->path = $path;
        }
        if(isset($extensionFile)){
        $pro_avatar->extension = $extensionFile;
        }
        $pro_avatar->save();
        if(isset($path)){
        $image_id =$pro_avatar->where('path', $path)->first()->id;
        }

        if(isset($path)){
            $product->image_id = $image_id;
        }
        $product->barcode = $request->barcode;
        $product->name = $request->name;
        $product->selling_price = $request->selling_price;
        $product->inventory_number = 0;
        $product->unit = $request->unit;
        $product->min_inventory_number  = $request->min_inventory_number;
        $product->supplier_id = $request->supplier;
        $product->save();

        if($request->has('genre')){
            $product->category()->sync(
                $request->genre,
                [
                    'updated_at' => date("Y-m-d H:i:s"),
                ]
            );
        }
        else{
            $product->category()->sync(
                $request->group_genre,
                [
                    'updated_at' => date("Y-m-d H:i:s"),
                ]
            );
        }
        $product_detail =ProductDetail::find($product->sku);
        if($request->has('publisher')){
            $product_detail->sku = $product->sku;
            $product_detail->publisher_id = $request->publisher;
            $product_detail->edition = $request->has('edition') ? $request->edition : 1;
            $product_detail->save();
        }

        if($request->has('author')){
            $product_detail->author()->sync(
               $request->author,
                [
                    'updated_at' => date("Y-m-d H:i:s"),
                ]
            );
        }
        $product->save();
        return Redirect::to('/admin/san-pham/danh-sach')->with("success","Sửa Sản Phẩm thành công");
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
        $product = Product::find($id);

        $product_detail = $product->product_detail;
        $image = Image::find($product->image_id);
        $order = $product->order()->whereRaw('`order`.`is_enable`=1');
        $import = $product->import()->whereRaw('`import`.`is_enable`=1');
        $discount = $product->discount()->whereRaw('`discount`.`is_enable`=1');
        if($order->count() > 0 || $import->count() > 0  || $discount->count() > 0)
        {
            return Redirect::to('/admin/san-pham/danh-sach')->with("error","Không thể xóa sản phẩm. Cần xóa các đơn hàng, đơn nhập hàng và chương trình khuyến mãi có sản phẩm này");
        }
        else{
            $product->is_enable = 0;
            if(!$product_detail){
                $product_detail->is_enable = 0;
            }
            $image->is_enable = 0;
            $product->save();
            $product_detail->save();
            $image->save();
            $product->category()->sync(
                $product->category,
                 [
                     'is_enable' => 0,
                 ]
             );
            if($product_detail){
                $product_detail->author()->sync(
                   $product_detail->author,
                    [
                        'is_enable' => 0,
                    ]
                );
            }

            return Redirect::to('/admin/san-pham/danh-sach')->with("success","Xóa sản phẩm thành công");
        }

    }
    public function validateElement(Request $request)
    {
        $request->validate(
            [
                'barcode' => 'bail|required|regex:/^[0-9a-zA-Z].{7,}+$/|unique:product,barcode',
                'name' => 'bail|required|regex:/^[0-9a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/|unique:product,name',
                'avatar' => 'image',
                'min_inventory_number' => 'bail|required|alpha_num',
                'selling_price' => 'bail|required|alpha_num',
            ],
            [
                'avatar.image' => 'Tệp tải lên phải là có đuôi: jpeg, png, bmp, gif, svg.',
                'barcode.required' => 'Không được để trống barcode',
                'barcode.regex' => 'Barcode không có ký tự đặt biệt',
                'barcode.unique' => 'Barcode đã tồn tại',
                'name.required' => 'Không được để trống tên',
                'name.regex' => 'Tên sản phẩm không có ký tự đặt biệt',
                'barcode.unique' => 'Tên sản phẩm đã tồn tại',
                'min_inventory_number.required' => 'Không được để trống hàng tồn tối thiểu',
                'min_inventory_number.alpha_num' => 'Hàng tồn tối thiểu có dạng số',
                'selling_price.required' => 'Không được để trống giá bán',
                'selling_price.alpha_num' => 'Giá bán có dạng số',
            ]
        );
    }
}
