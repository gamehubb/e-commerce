<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'product_name', 'product_code', 'category', 'brand', 'image', 'quantity', 'price', 'total_amount', 'color', 'discount'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
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

    public function fetchCart($product)
    {
        foreach ($product as $data) {
            $item = [
                'id' => $data['product_id'],
                'name' => $data['product_name'],
                'vendor' => $data['vendor'],
                'code' => $data['product_code'],
                'category' => $data['category'],
                'brand' => $data['brand'],
                'product_type' => $data['product_type'],
                'price' => $data['price'],
                'discount' => $data['discount'],
                'color' => $data['color'],
                'qty' => $data['quantity'],
                'image' => $data['image']
            ];
            if (!array_key_exists($data['product_id'], $this->items)) {

                $this->items[$data['product_id']] = $item;
                $this->totalQty += $data['quantity'];
                $this->totalPrice += $data['total_amount'];
            }

            $this->items[$data['product_id']]['qty'] = $data['quantity'];
        }
    }

    public function add($product, $color, $image)
    {
        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'vendor' => $product->vendor,
            'code' => $product->code,
            'category' => $product->category_id,
            'brand' => $product->brand_id,
            'product_type' => $product->product_type,
            'price' => $product->productDetail[0]->price,
            'discount' => $product->productDetail[0]->discount,
            'color' => $color,
            'qty' => 0,
            'image' => $image
        ];
        if (!array_key_exists($product->id, $this->items)) {

            $this->items[$product->id] = $item;
            $this->totalQty += 1;
            $this->totalPrice += $product->productDetail[0]->price - ($product->productDetail[0]->price *  ($product->productDetail[0]->discount / 100));
        } else {
            $this->totalQty += 1;

            $this->totalPrice +=  $product->productDetail[0]->price - ($product->productDetail[0]->price *  ($product->productDetail[0]->discount / 100));
        }
        $this->items[$product->id]['qty'] += 1;
    }
    public function updateQty($id, $qty, $discount)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= ($this->items[$id]['price'] - ($this->items[$id]['price'] * ($discount / 100))) * $this->items[$id]['qty'];
        //Add Items with new quantity
        $this->items[$id]['qty'] = $qty;
        $this->totalQty += $qty;
        $this->totalPrice +=  ($this->items[$id]['price'] - ($this->items[$id]['price'] * ($discount / 100))) * $qty;
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