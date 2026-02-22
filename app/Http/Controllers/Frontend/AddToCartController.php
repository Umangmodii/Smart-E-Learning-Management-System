<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
class AddToCartController extends Controller
{
    public function add($id)
    {
        $course = Course::findOrFail($id);

        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            $cart[$id] = [
                "id" => $course->id,
                "title" => $course->title,
                "price" => $course->discount_price > 0 
                            ? $course->discount_price 
                            : $course->price,
                "image" => $course->thumbnail,
                "slug" => $course->slug
            ];

            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Course added to cart!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Course removed from cart!');
    }
}