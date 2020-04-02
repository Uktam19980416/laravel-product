<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ {
    Repositories\ProductRepository,
    Models\Product,
    Models\Cart,
    Http\Requests\CartRequest,
    Http\Requests\MailerRequest
};

class ProductController extends Controller
{

        /**
     * The Controller instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductRepository $repository)
    // public function __construct()
    {
        // $this->middleware('auth');
        $this->repository = $repository;
    }

    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index(Request $request, ProductRepository $repository)
    public function index(Request $request)
    {
        // $products = $this->repository->funcSelect($request);
        $products = $this->repository->funcSelect($request);

        // Ajax response
        if ($request->ajax()) {
            return response()->json([
                'table' => view("product.brick-standard", ['products' => $products])->render(),
            ]);
        } 
        
        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the application product.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function product($id, Product $model_product)
    {
        // $product = $this->repository->funcSelectOne($id);
        $product = $model_product->find($id);
        return view('product.product', compact('product'));
    }

        /**
     * Show the application cart.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cart(Request $request)
    {
        $carts = $this->repository->fromCart();

        // Ajax response
        if ($request->ajax()) {
            return response()->json([
                'table' => view("product.cart-standard", ['carts' => $carts])->render(),
            ]);
        }

        return view('product.cart', compact('carts'));
    }

        /**
     * Store data to cart.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tocart(CartRequest $request)
    {
        $this->repository->store($request);
        return redirect(route('cart')); // url('/cart');
    }    

    /**
     * Remove all cart.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clearall(Request $request, Cart $model_cart)
    {
        // $this->repository->clearall();
        $model_cart->truncate();

        // Ajax response
        if ($request->ajax()) {
            return response()->json();
        }

        return redirect(route('cart')); // url('/cart');
    }  

     /**
     * Remove one to cart.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clearone(Request $request)
    {
        $this->repository->clearone($request);
    }   

     /**
     * Mailer for sending message and contact.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function mailer(MailerRequest $request)
    {
        if(isset($request->validator) && $request->validator->fails()) //if you need validator->errors() in Controller
        {
            return json_encode($request->validator->errors());
        }                
        return $this->repository->mailer($request);
    }       

}
