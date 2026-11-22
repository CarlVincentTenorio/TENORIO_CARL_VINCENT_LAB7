<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
class CustomerController extends Controller {
 public function index(){return view('customers', ['customers'=>Customer::latest()->get()]);}
 public function create(){return view('customers.form', ['customer'=>new Customer]);}
 public function store(Request $request){$data=$request->validate(['full_name'=>'required|string|max:255','email'=>'required|email|max:255','phone'=>'nullable|string|max:50']);Customer::create($data);return redirect()->route('customers')->with('success','Customer created.');}
 public function edit(Customer $customer){return view('customers.form',compact('customer'));}
 public function update(Request $request,Customer $customer){$data=$request->validate(['full_name'=>'required|string|max:255','email'=>'required|email|max:255','phone'=>'nullable|string|max:50']);$customer->update($data);return redirect()->route('customers')->with('success','Customer updated.');}
}
