<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index(Request $request)
    {

        // Retrieve user details from session
        $user = $request->session()->get('user');

        // Access user details
        $userId = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;

        $products = Product::with('user')->get();
 
        // Pass user details to the view
        return view('vendor-dashboard', compact('userId', 'userName', 'userEmail', 'products'));
    }
    

    public function createProduct(Request $request)
    {
        $user = $request->session()->get('user');

        // Access user details
        $userId = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;;
        return view('add-product-vendor', compact('userId', 'userName', 'userEmail'));
    }
    public function storeProduct(Request $request)
    {
        $formData = $request->validate([
            'user_id' => 'required',
            'product_name' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'added_by' => 'required',
        ]);

        if (request()->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $formData['image'] = $filename;
        }

        Product::create($formData);
        return redirect('vendor-dashboard')->with('success', 'Product added successfully.');
    }
    public function destroyProduct(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect('/admin-dashboard')->with('error', 'Product not found.');
        }

        if ($product->image) {
            $imagePath = public_path('images/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);  // Delete the image file from the server
            }
        }

        $product->delete();

        return redirect('vendor-dashboard')->with('success', 'Product deleted successfully.');
    }
    public function editProduct(Request $request, string $id)
    {
        // Retrieve user details from session
        $user = $request->session()->get('user');

        // Access user details
        $userId = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;

        $product = Product::find($id);

        return view('vendor-edit-product', compact('userId', 'userName', 'userEmail', 'product'));
    }
    public function updateProduct(Request $request, string $id)
    {
        $product = Product::find($id);
        $formData = $request->validate([
            'user_id' => 'required',
            'product_name' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ]);

        if (request()->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $formData['image'] = $filename;
        }
        $product->update($formData);
        return redirect('vendor-dashboard')->with('success', 'Product updated successfully.');
    }
    public function editStock(Request $request, string $id)
    {
        // Retrieve user details from session
        $user = $request->session()->get('user');

        // Access user details
        $userId = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;

        $product = Product::find($id);

        return view('stock-manage-vendor', compact('userId', 'userName', 'userEmail', 'product'));
    }

    public function updateStock(Request $request, string $id)
    {
        $product = Product::find($id);
        $formData = $request->validate([
            'user_id' => 'required',
            'product_name' => 'required',
            'stock' => 'required',
        ]);
        $user = $request->session()->get('user');

        // Access user details
        
        $userName = $user->name;
        $formData['added_by'] = $userName;
        $product->update($formData);
        return redirect('/vendor-dashboard')->with('success', 'Stock updated successfully.');
    }
}
