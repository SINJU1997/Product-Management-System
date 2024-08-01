<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function editStock(Request $request, string $id)
    {
        // Retrieve user details from session
        $user = $request->session()->get('user');

        // Access user details
        $userId = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;

        $product = Product::find($id);

        return view('stock-manage-admin', compact('userId', 'userName', 'userEmail', 'product'));
    }

    public function updateStock(Request $request, string $id)
    {
        $product = Product::find($id);
        $formData = $request->validate([
            'user_id' => 'required',
            'product_name' => 'required',
            'stock' => 'required',
        ]);
        $formData['added_by'] = 'Admin';
        $product->update($formData);
        return redirect('/products-list-admin')->with('success', 'Stock updated successfully.');
    }
}
