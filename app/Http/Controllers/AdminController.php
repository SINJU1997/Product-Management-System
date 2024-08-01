<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function home(Request $request)
    {
        $user = $request->session()->get('user');

        // Access user details
        $userId = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;

        return view('admin-dashboard', compact('userId', 'userName', 'userEmail'));
    }

    public function index(Request $request)
    {

        // Retrieve user details from session
        $user = $request->session()->get('user');

        // Access user details
        $userId = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;

        // $products = Product::all();
        $products = Product::with('user')->get();

        // Pass user details to the view
        return view('products-list-admin', compact('userId', 'userName', 'userEmail', 'products'));
    }

    public function createProduct(Request $request)
    {
        $user = $request->session()->get('user');

        // Access user details
        $userId = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;;
        return view('add-product', compact('userId', 'userName', 'userEmail'));
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
        return redirect('/products-list-admin')->with('success', 'Product added successfully.');
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

        return redirect('/products-list-admin')->with('success', 'Product deleted successfully.');
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

        return view('edit-product', compact('userId', 'userName', 'userEmail', 'product'));
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
        return redirect('/products-list-admin')->with('success', 'Product updated successfully.');
    }

    public function listVendors()
    {
        $vendors = User::where('role', 'vendor')->get();
        return view('vendors-list-admin', compact('vendors'));
    }

    public function destroyVendor(string $id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect('/admin-vendors-list')->with('success', 'Vendor deleted successfully.');
    }

    public function editVendor(string $id)
    {

        $user = User::find($id);

        return view('edit-vendor', compact('user'));
    }

    public function updateVendor(Request $request, string $id)
    {
        $user = User::find($id);
        $formData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $formData['role'] = 'vendor';
        $formData['password'] = Hash::make($formData['password']);
        $user->update($formData);
        return redirect('/admin-vendors-list')->with('success', 'Vendor updated successfully.');
    }

    public function createVendor()
    {
        return view('new-vendor');
    }

    public function storeVendor(Request $request)
    {
        $formData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $formData['role'] = 'vendor';
        $formData['password'] = Hash::make($formData['password']);

        User::create($formData);

        return redirect('/admin-vendors-list')->with('success', 'Vendor added successfully.');
    }
}
