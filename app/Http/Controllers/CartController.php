<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Cart;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    //

    public function addToCart(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        if (Gate::allows('loggedIn')) {
            $existingCart = Cart::where('book_id', $request->id)->where('user_id', auth()->user()->id);
            if ($existingCart->exists()) {
                $quantity = $existingCart->value('quantity');
                $existingCart->update([
                    'quantity' => $quantity + 1,
                ]);
                return redirect('/store')->with('success', 'Sikeresen hozzáadva a kosárhoz. A kosárban: ' . $existingCart->value('quantity') . ' darab.');
            } else {
                Cart::create([
                    'user_id' => auth()->user()->id,
                    'book_id' => $request->id,
                    'quantity' => 1,
                ]);
                return redirect('/store')->with('success', 'Sikeresen hozzáadva a kosárhoz.');
            }
        } else {
            return redirect('/login')->with('error', 'Az oldal megtekintéséhez be kell jelentkeznie.');
        }
    }

    public function changeQuantity(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required',
        ]);
        if (Gate::allows('loggedIn') && Gate::allows('inCart', $request->id) && $request->quantity > 0) {
            Cart::where('id', $request->id)->update([
                'quantity' => $request->quantity,
            ]);
            return redirect('/cart')->with('success', 'Kosár sikeresen frissítve.');
        } elseif ($request->quantity <= 0) {
            return redirect('/cart')
                ->with('delete', 'Biztosan törölni szeretnéd ezt a terméket?')
                ->with('id', $request->id);
        } else {
            return redirect('/cart')->with('error', 'Nincs nyulkapiszka :))');
        }
    }

    public function deleteFromCart(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        if (Gate::allows('loggedIn') && Gate::allows('inCart', $request->id)) {
            Cart::where('id', $request->id)->delete();
            return redirect('/cart')->with('delete', 'Sikeresen törölve a kosárból.');
        } else {
            return redirect('/cart')->with('error', 'Nincs nyulkapiszka :))');
        }
    }

    public function order(Request $request)
    {
        Log::info($request->all());
        if (Gate::allows('loggedIn')) {
            $card = false;
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'street' => 'required',
                'houseNumber' => 'required',
                'postalCode' => 'required',
                'city' => 'required',
                'deliveryMethod' => 'required',
                'paymentMethod' => 'required',
            ]);
            if ($request->paymentMethod == 'card') {
                $card = true;
                $request->validate([
                    'cardNumber' => 'required',
                    'cardName' => 'required',
                    'cardCVC' => 'required',
                    'cardExpiry' => 'required',
                ]);
            }
            $userCart = Cart::where('user_id', auth()->user()->id);
            $order = [
                'user_id' => auth()->user()->id,
                'order_id' => Order::max('order_id') + 1,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => auth()->user()->email,
                'street' => $request->street,
                'house_number' => $request->houseNumber,
                'postal_code' => $request->postalCode,
                'city' => $request->city,
                'delivery_method' => $request->deliveryMethod,
                'payment_method' => $request->paymentMethod,
            ];
            if ($card) {
                $order['card_number'] = $request->cardNumber;
                $order['card_name'] = $request->cardName;
                $order['card_cvc'] = $request->cardCVC;
                $order['card_expiry'] = $request->cardExpiry;
            }

            foreach ($userCart->get() as $value) {
                $order['book'] = $value['book_id'];
                $order['quantity'] = $value['quantity'];
                $order['price'] = Book::where('id', $value['book_id'])->first()->price * $value['quantity'];

                Order::create($order);
            }
            
            Cart::where('user_id', auth()->user()->id)->delete();

            return view('cart.orders');
        } else {
        }
    }
}
