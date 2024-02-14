<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contact;
use App\Models\User;

use Auth;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
     {
        $success_msg =  $request->session()->get('success');
        $error_msg =  $request->session()->get('error');

        $id = Auth::id();
  
        return view ('/contact/add',['success_msg' => $success_msg,'error_msg' => $error_msg , 'login' => $id ]);
     }

    public function add(Request $request){
      
        $this->validate($request,[
 
            'name' => ['required'],
            'email' => ['required'],
            'image' => ['required'],
            'phone' => ['required'],
            
        ]);
    
        // print_r($request->input('name'));die;
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = public_path('images'); 
        $image->move($imagePath, $imageName);

        $author_id = $_POST['author_id'];
    
        $student = new contact();
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->image = $imageName;
        $student->phone = $request->input('phone');
        $student->author_id = $author_id;
    
        if($student->save()){
           $request->session()->flash('success','Contact created successfully');
           
        } else {
            $request->session()->flash('error','something went wrong. Please try again!');
        }

        return redirect('/contact/add');
  
  }
    public function list(Request $req)
    {
        $id = Auth::id();
        $dataa = contact::where('author_id','=', $id)->simplePaginate(3);
    
        return view ('/contact/list', ['data' => $dataa]);
    }
    public function logout(Request $req){

        $req->session()->flush();
        return redirect('login');
        
    }
    public function delete($id){

        $data = contact::find($id);
        $data->delete();
        return redirect('/contact/list')->with('success','Entry deleted successfully!');

    }
    public function edit($id){

        $student = contact::find($id);
        return view('/contact/edit',['data' => $student]);

    }
    public function updateData(Request $req){

        $image = $req->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = public_path('images'); 
        $image->move($imagePath, $imageName);

        $data = contact::find($req->id);
        $data->name = $req->name;
        $data->email = $req->email;
        $data->image = $imageName;
        $data->phone = $req->phone;
        $data->save();
        
        return redirect('/contact/edit/'.$req->id)->with('success','Entry edit successfully!');
    }
    public function search(Request $req){

        $search = $req->input('keyword');
          $id = Auth::id();

        $dataa = contact::where('author_id','=',$id)
                        ->Where(function ($query)  use ($search)  {
                            $query->orWhere('name','LIKE',"%{$search}%")
                            ->orWhere('phone','LIKE',"%{$search}%")
                            ->orWhere('email','LIKE',"%{$search}%");
                        })->simplePaginate(3);
                        
           // echo $data;die;
        // dd($data);
        // if($data){    
        //    $req->session()->flash('data', $data);
        // }
    
         return view('/contact/list', ['data' => $dataa]);

    }

    public function userEdit(){

        $id = Auth::id();
        $output = User::where('id','=',$id)->first();
        
        return view('/contact/userEdit',['data' => $output]);
    }
    public function changeUser(Request $req){

        $image = $req->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = public_path('images'); 
        $image->move($imagePath, $imageName);

        $id = Auth::id();

        $data = User::find($id);
        $data->name = $req->name;
        $data->image = $imageName;
        $data->password = $req->password;
        $data->save();
        
        return redirect('/contact/userEdit')->with('success','Entry edit successfully!');
    }
}
