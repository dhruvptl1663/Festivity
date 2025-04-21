<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'event_id' => 'nullable|exists:events,event_id',
            'package_id' => 'nullable|exists:packages,package_id',
        ]);

        if (!$request->event_id && !$request->package_id) {
            return response()->json([
                'error' => 'Missing identifier',
                'message' => 'No event_id or package_id provided',
                'is_in_cart' => false
            ], 400);
        }

        try {
            if (!Auth::check()) {
                return response()->json([
                    'error' => 'Authentication required',
                    'message' => 'Please login to add items to cart',
                    'is_in_cart' => false
                ], 401);
            }

            // First check if item already exists in cart
            $cart = Cart::where('user_id', Auth::id())
                ->when($request->package_id, function ($query) use ($request) {
                    return $query->where('package_id', $request->package_id)
                        ->whereNull('event_id');
                })
                ->when($request->event_id, function ($query) use ($request) {
                    return $query->where('event_id', $request->event_id)
                        ->whereNull('package_id');
                })
                ->first();

            if ($cart) {
                $cart->delete();
                return response()->json([
                    'status' => 'removed',
                    'is_in_cart' => false,
                    'message' => 'Item removed from cart'
                ]);
            }

            // Create new cart item
            $cart = new Cart();
            $cart->user_id = Auth::id();
            
            if ($request->package_id) {
                $cart->package_id = $request->package_id;
                $cart->event_id = null;
            } else {
                $cart->event_id = $request->event_id;
                $cart->package_id = null;
            }

            $cart->save();

            return response()->json([
                'status' => 'added',
                'is_in_cart' => true,
                'message' => 'Item added to cart'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to toggle cart item',
                'message' => $e->getMessage(),
                'is_in_cart' => false
            ], 500);
        }
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cartItems = Cart::with(['event.category', 'package.decorator', 'package.events'])
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($item) {
                if ($item->event) {
                    return [
                        'type' => 'event',
                        'id' => $item->event_id,
                        'name' => $item->event->title,
                        'desc' => $item->event->description,
                        'image' => $item->event->image,
                        'price' => $item->event->price,
                        'original_price' => $item->event->price,
                        'availability' => 'in_stock',
                    ];
                } else {
                    $eventImages = $item->package->events->pluck('image')->toArray();
                    return [
                        'type' => 'package',
                        'id' => $item->package_id,
                        'name' => $item->package->title,
                        'desc' => $item->package->description,
                        'images' => $eventImages,
                        'price' => $item->package->price,
                        'original_price' => $item->package->price,
                        'availability' => 'in_stock',
                    ];
                }
            });

        $subtotal = $cartItems->sum(function ($item) {
            return $item['price'];
        });

        $discount = $cartItems->sum(function ($item) {
            return $item['original_price'] - $item['price'];
        });

        return view('cart', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $subtotal - $discount
        ]);
    }
}
