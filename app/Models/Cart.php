<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'product_name','product_code','category','brand', 'image', 'quantity', 'price', 'total_amount', 'color', 'discount'];
}

class Cart
{
    public $items = [];
    public $totalQty;
    public $totalPrice;

    public function __construct($cart = null)
    {
        if ($cart) {
            $this->items = $cart->items;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQty = $cart->totalQty;
        } else {
            $this->items = [];
            $this->totalPrice = 0;
            $this->totalQty = 0;
        }
    }
    public function add($product)
    {
        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'code' => $product->code,
            'category' => $product->category_id,
            'brand' => $product->brand_id,
            'product_type' => $product->product_type,
            'price' => $product->productDetail->price,
            'discount' => $product->productDetail->discount,
            'color' => $product->productDetail->color,
            'qty' => 0,
            'image' => $product->productDetail->image_1
        ];
        if (!array_key_exists($product->id, $this->items)) {
            
            $this->items[$product->id] = $item;
            $this->totalQty += 1;
            $this->totalPrice += $product->productDetail->price;
        } else {
            $this->totalQty+=1;

            $this->totalPrice += $product->productDetail->price;
        }
        $this->items[$product->id]['qty'] += 1;
    }
    public function updateQty($id, $qty)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'] * $this->items[$id]['qty'];
        //Add Items with new quantity
        $this->items[$id]['qty'] = $qty;
        $this->totalQty += $qty;
        $this->totalPrice += $this->items[$id]['price'] * $qty;
    }
    public function remove($id)
    {
        if (array_key_exists($id, $this->items)) {
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['price'];
            unset($this->items[$id]);
        }
    }
}