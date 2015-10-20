<?php
 

 
class FabricController extends BaseController {
 
 
  public function add()
  {
    $rules = array(
      'code'    => 'required|unique:fabrics,code', 
      'file' => 'mimes:jpeg,bmp,png',
      'detail'    => 'max:50',
     
    );
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) 
    {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withErrors($validator)
        ->withInput(); 
    } 
    else 
    {
   
       
      $destinationPath = '';
          $filename        = '';

      if (Input::hasFile('file')) {
          $file            = Input::file('file');
          $destinationPath = public_path().'/uploads/fabric/';
          $filename        = str_random(6) . '_' . $file->getClientOriginalName();
          $uploadSuccess   = $file->move($destinationPath, $filename);
      }

        $fabric_save= new Fabric;
        $fabric_save->code=strip_tags(Input::get('code'));;
        $fabric_save->details=strip_tags(Input::get('details'));;
        $fabric_save->file=$filename;
        $fabric_save->save();
    
    
      Session::put('msgsuccess', 'Successfully added fabric.');
      return Redirect::back();

    }
  }
   
  public function edit($id)
  {
    $exist = Fabric::where('id', $id)->count();

    if($exist == 0)
    {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withInput(); 
    }
      

    $rules = array(
      'code'    => 'required', 
      'file' => 'mimes:jpeg,bmp,png',
      'detail'    => 'max:50',
    );
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) 
    {
      Session::put('msgfail', 'Invalid input.');
      return Redirect::back()
        ->withErrors($validator)
        ->withInput(); 
    } 
    else 
    {
          $fabric_save= Fabric::find($id);
          $destinationPath = '';
          $filename        = $fabric_save->file;

      if (Input::hasFile('file')) {
          $file            = Input::file('file');
          $destinationPath = public_path().'/uploads/fabric/';
          $filename        = str_random(6) . '_' . $file->getClientOriginalName();
          $uploadSuccess   = $file->move($destinationPath, $filename);
      }
        
        $fabric_save->code=strip_tags(Input::get('code'));;
        $fabric_save->details=strip_tags(Input::get('details'));;
        $fabric_save->file=$filename;
        $fabric_save->save();
    
      Session::put('msgsuccess', 'Successfully edited fabric.');
      return Redirect::to("/admin/fabrics");
    }
  }

public function delete($id)
  {
    $exist = Fabric::where('id', $id)->count();

    if($exist == 0)
    {
      Session::put('msgfail', 'Failed to delete fabric.');
      return Redirect::back()
        ->withInput(); 
    }
      
      Fabric::where('id',$id)->delete();
      Roll::where('fabric_id',$id)->delete();
      Session::put('msgsuccess', 'Successfully deleted fabric.');
      return Redirect::back();
    
  }
  public function rollDelete($id)
  {
    $exist = Roll::where('id', $id)->count();

    if($exist == 0)
    {
      Session::put('msgfail', 'Failed to delete roll.');
      return Redirect::back()
        ->withInput(); 
    }
      
      Roll::where('id',$id)->delete();
      Session::put('msgsuccess', 'Successfully deleted roll.');
      return Redirect::back();
    
  }
  public function rollAdd()
  {
    $rules = array(
      'code'    => 'required|min:3|max:50|unique:rolls', 
      'yards'   => 'required',
    );
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) 
    {
      Session::put('msgfail', 'Failed to add roll.');
      return Redirect::back()
        
        ->withInput(); 
    } 
    else 
    {
   
      $roll = new Roll();
      $roll->code = strip_tags(Input::get('code'));
      $roll->yards = strip_tags(Input::get('yards'));

      $roll->fabric_id = Input::get('id');
      $roll->save();
      Session::put('msgsuccess', 'Successfully added roll.');
      return Redirect::back();

    }
  }
   
   public function search(){
     
    if(!Auth::check())
      return Redirect::to("/login");
  else
  {
    $term = strip_tags(Input::get('term'));

        $fabrics =  DB::table('fabrics')->where('code', 'LIKE', "%$term%")->orWhere('details', 'LIKE', "%$term%")->paginate(10);
  Session::put('search', 1);
    return View::make('members.browse_inventory')->with('fabrics', $fabrics);
  }

   }

  public function credit()
  {

    $rules = array(
      'code'    => 'required|min:3|max:50|unique:rolls,code', 
      'yards'   => 'required',
      'fabric'    => 'required|min:3|max:50|exists:fabrics,code'
    );
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) 
    {
      Session::put('msgfail', 'Failed to credit roll.');
      return Redirect::back()->withErrors($validator)->withInput(); 
    } 
    else 
    {

      if(Input::get('yards')<5){
        Session::put('msgfail', 'Failed to credit roll. Yards cannot be less than the minimum amount.');
        return Redirect::back()->withInput();
      }
      $checkfabric = Fabric::where("code", strip_tags(Input::get('fabric')) )->first();
   
      $roll = new Roll();
      $roll->code = strip_tags(Input::get('code'));
      $roll->yards = strip_tags(Input::get('yards'));
      $roll->fabric_id = $checkfabric->id;
      $roll->save();

      $transaction = new Transaction();
      $transaction->user_id = Auth::user()->id;
      $transaction->fabric_code = strip_tags(Input::get('fabric'));
      $transaction->roll_code = strip_tags(Input::get('code'));
      $transaction->change = strip_tags(Input::get('yards'));
      $transaction->type = "CREDIT";
      $transaction->save();


      Session::put('msgsuccess', 'Successfully credited roll.');
      return Redirect::back();

    }
  }

  public function debit()
  {
    $rules = array(
      'code'    => 'required|min:3|max:50|exists:rolls,code', 
      'yards'   => 'required',
    );
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) 
    {
      Session::put('msgfail', 'Failed to debit roll.');
      return Redirect::back()->withErrors($validator)->withInput(); 
    } 
    else 
    {
      $checkroll = Roll::where('code', strip_tags(Input::get('code')))->first();

      $roll = Roll::find($checkroll->id);

      if(Input::get('yards')<0||Input::get('yards')>$roll->yards)
      {
      Session::put('msgfail', 'Failed to debit roll. Debitted amount cannot be less that zero or greater than the current supply.');
      return Redirect::back()->withInput();
      }

      $newyards = $roll->yards - strip_tags(Input::get('yards'));
      $fabric = Fabric::find($roll->fabric_id);

      $transaction = new Transaction();
      $transaction->user_id = Auth::user()->id;
      $transaction->fabric_code = $fabric->code;
      $transaction->roll_code = strip_tags(Input::get('code'));
      $transaction->change = strip_tags(Input::get('yards'));
      $transaction->type = "DEBIT";
      $transaction->save();

      if($newyards<5)
      {
        Roll::where('code', strip_tags(Input::get('code')))->delete();
      }
      else
      {
        $roll->yards = $newyards; 
        $roll->save();
      }

      

      Session::put('msgsuccess', 'Successfully debited roll.');
      return Redirect::back();

    }
  }
}