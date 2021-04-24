<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    //

    public function showForm(){
    	$user = User::withTrashed()->get()->toArray();

    	return view('welcome',compact('user'));
    }

    public function submitForm(Request $request){

    
		$validator =  $this->validate($request, [
          'name' => 'required',
          'email' => 'required|email',
          'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
          'date' => 'required',
          'password' => 'required|min:6',
          'profile_picture' => 'required|image|mimes:png,jpg|max:2048',
       	]);

		$Employee = User::withTrashed()->whereEmail($request->email)->first();
		$Employee = json_decode(json_encode($Employee),true);
	
		if(!empty($Employee)){
			$request->session()->flash('message', 'Employee with this email already exists.Please change the email.'); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return \Redirect::back();
		}
		$file_name = time().'.'.$request->profile_picture->extension();  
        $request->profile_picture->move(public_path('uploads'), $file_name);
    	$password = bcrypt($request->password);
    	$save = User::create([
				    		'name' => $request->name,
				    		'email' => $request->email,
				    		'mobile_number' => $request->mobile_number,
				    		'dob' => $request->date,
				    		'password' => $password,
				    		'profile_image' => $file_name,
				    		'encoded_password' => $request->password

		    			]);
    	$request->session()->flash('message', 'Employee saved successfully.'); 
		$request->session()->flash('alert-class', 'alert-success'); 
		return \Redirect::back();
    }

    public function editRecord($id){
    	$employee = User::whereId($id)->first();
    	$employee = json_decode(json_encode($employee),true);
    	return view('edit-employee',compact('employee'));
    }

    public function updateRecord($id,Request $request){
		$validator =  $this->validate($request, [
          'name' => 'required',
          'email' => 'required|email',
          'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
          'date' => 'required',
          'password' => 'required|min:6',
          'profile_picture' => 'image|mimes:png,jpg|max:2048',
       	]);

		$Employee = User::whereId($id)->first();
		$Employee = json_decode(json_encode($Employee),true);

		if(!empty($request->profile_picture)){
			$file_name = time().'.'.$request->profile_picture->extension();  
        	$request->profile_picture->move(public_path('uploads'), $file_name);
        }else{
        	$file_name = $Employee['profile_image'];
        }
    	$password = bcrypt($request->password);
    	$save = User::whereId($id)->update([
				    		'name' => $request->name,
				    		'email' => $request->email,
				    		'mobile_number' => $request->mobile_number,
				    		'dob' => $request->date,
				    		'password' => $password,
				    		'profile_image' => $file_name,
				    		'encoded_password' => $request->password

		    			]);
    	$request->session()->flash('message', 'Employee updated successfully.'); 
		$request->session()->flash('alert-class', 'alert-success'); 
		return \Redirect::to('/');
    }

    public function filterSearch(Request $request){
    	
    	if($request->data_type == "name"){
    		$user = User::withTrashed()->Where('name', 'LIKE', '%' . $request->search . '%')->get()->toArray();
    	
    	}else if($request->data_type == "email"){
    		$user = User::withTrashed()->Where('email', 'LIKE', '%' . $request->search . '%')->get()->toArray();

    	}else{
    		$employee = User::withTrashed()->get()->toArray();
    		$user = array();
    		if($request->search == "active"){
			  $user = User::get()->toArray();
    		}else{
				foreach ($employee as $key => $value) {
    				if(!empty($value['deleted_at'])){
    					 $user[$key] = $value;
    				}
    			}
    		}
    	}
		return view('users',compact('user'));
    	
    }

    public function viewForm($id){
		$user = User::whereId($id)->first();
    	$user = json_decode(json_encode($user),true);
    	return $user;
    }
    public function deleteData($id){
      User::whereId($id)->delete();
      return array('message'=>'Record Deleted');
    }
}
