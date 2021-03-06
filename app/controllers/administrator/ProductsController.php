<?php
/**
 * Created by PhpStorm.
 * User: CarlosRenato
 * Date: 27/11/2014
 * Time: 06:40 PM
 */
namespace Administrator;
use Repositories\Administrator\ProductRepository;
use Repositories\Administrator\ProductCategoryRepository;
use Repositories\Administrator\ProviderRepository;

class ProductsController extends \BaseController
{
    protected $layout = 'admin.layouts.main';
    protected $breadcrumbs = ['Dashboard' => '/', 'Products' => 'product'];
    protected $product, $categories, $providers;

    public function __construct(ProductRepository $product, ProductCategoryRepository $categories, ProviderRepository $providers)
    {

        $this->beforeFilter("read_product", array("only" => array("index", "show")));
        $this->beforeFilter("create_product", array("only" => array("create", "store")));
        $this->beforeFilter("update_product", array("only" => array("edit", "update")));
        $this->beforeFilter("update_product", array("only" => array("edit", "update")));
        $this->beforeFilter("delete_product", array("only" => "destroy"));
        $this->product = $product;
        $this->categories = $categories;
        $this->providers = $providers;
    }

    public function index()
    {
        $products = $this->product->getAll();
        $productsTotal = $products->get();
        $products = $products->paginate(10);
        $categories = $this->categories->lists();
        $this->layout->content = \View::make('admin.products.index', compact('products', 'productsTotal', 'categories'));
    }

    public function create()
    {
        $categories = $this->categories->lists();
        $providers = $this->providers->lists();
        $measures = \Measure::all();
        $this->layout->breadcrumbs = $this->breadcrumbs;
        $this->layout->content = \View::make('admin.products.create', compact('categories', 'providers', 'measures'));
    }

    public function store()
    {
        $except = ['_token', '_method'];
        $input = array_except(\Input::all(), $except);
        $input['available'] = (\Input::get('available')) ? 1 : 0;
        $this->product->create($input);
        if ($this->product->succeeded()) {
            return \Redirect::to('product')->with('notice', 'Product was created successfully');
        } else {
            return \Redirect::back()->withInput()
                ->withErrors($this->product->errors());
        }
    }

    public function edit($id)
    {
        $product = $this->product->findById($id);
        $categories = $this->categories->lists();
        $providers = $this->providers->lists();
        $measures = \Measure::all();
        $this->layout->breadcrumbs = $this->breadcrumbs;
        $this->layout->content = \View::make('admin.products.edit', compact('product', 'categories', 'providers', 'measures'));
    }

    public function update($id)
    {
        $except = ['_token', '_method'];
        $input = array_except(\Input::all(), $except);
        $this->product->update($id, $input);
        if ($this->product->succeeded()) {
            return \Redirect::to('product');
        } else {
            return \Redirect::back()->withInput()
                ->with('errors', $this->product->errors());
        }
    }

    public function destroy($id)
    {
        if ($this->product->delete($id)) {
            return \Redirect::to('product')->with('Product was deleted successfully');
        } else {
            return \Redirect::back()->with('errors', $this->product->errors());
        }
    }

    public function json()
    {
        if (\Input::has('term')) {
            $match = \Input::get('term');
            $products = $this->product->whereLike(['name', 'sku'], $match)->where('available', 1)->get();
        } else {
            $products = $this->product->lists();
        }
        if (count($products))
        {
            return \Response::json($products);
        } else {
            return \Response::json([['id' => -1, 'name' => 'Product not Found']]);
        }
    }
}