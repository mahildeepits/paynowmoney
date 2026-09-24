<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $methods = PaymentMethod::all();
        return view('admin.payment_methods.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.payment_methods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'details' => 'nullable',
            'qr_image' => 'nullable|image',
        ]);

        $method = new PaymentMethod();
        $method->type = $request->type;
        $method->details = $request->details;
        $method->is_active = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('qr_image')) {
            $originalName = $request->qr_image->getClientOriginalName();
            $sanitizedName = preg_replace('/[^A-Za-z0-9\-.]/', '_', $originalName);
            $imageName = time() . '_' . $sanitizedName;
            $request->qr_image->storeAs('public/payment_qrs', $imageName);
            $method->qr_image = $imageName;
        }

        $method->save();

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment method added successfully');
    }

    public function edit($id)
    {
        $method = PaymentMethod::findOrFail($id);
        return view('admin.payment_methods.edit', compact('method'));
    }

    public function update(Request $request, $id)
    {
        $method = PaymentMethod::findOrFail($id);
        $method->type = $request->type;
        $method->details = $request->details;
        $method->is_active = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('qr_image')) {
            $originalName = $request->qr_image->getClientOriginalName();
            $sanitizedName = preg_replace('/[^A-Za-z0-9\-.]/', '_', $originalName);
            $imageName = time() . '_' . $sanitizedName;
            $request->qr_image->storeAs('public/payment_qrs', $imageName);
            $method->qr_image = $imageName;
        }

        $method->save();

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment method updated successfully');
    }

    public function destroy($id)
    {
        PaymentMethod::findOrFail($id)->delete();
        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment method deleted successfully');
    }
}
