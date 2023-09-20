<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// to use the database you should use the model file 
// which has been created along with the migration file
use App\Models\Computer;

class ComputersController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     // Array of static data just to show how to handle the data
    //  private static function getData()
    //  {
    //     return [
    //         ['id'=>1, "name"=>"LG", "origin"=>"Koria"],
    //         ['id'=>2, "name"=>"HP", "origin"=>"USA"],
    //         ['id'=>3, "name"=>"Siemens", "origin"=>"Germany"],
    //         ['id'=>4, "name"=>"Lenovo", "origin"=>"France"],
    //     ];
    //  }



    public function index()
    {
        return view("computers.index", ["computer"=>Computer::all()]);
        // means send the variable $computer which takes its data from
        // the model file (class Computer) and using the static method all
        // which will return all attributes of database table 2D array or
        // more precisely array containing arrays, one for each row.
  
     // the below comments were related to the static data instead of the data from the database
        /*return view('computers.index',[
            "computer"=>self::getData()
        ]);*/

    # index function return the page index which is in the folder computers
    # the an associated data are prepared as a second parameter
    # the file of the path views/computers/index.blade.php will
    # receive the variable $computers which is a 2D array.
    # Note: "self" means the class exists in the class itself, 
    # :: used for static things like static variables or static class, etc. 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('computers.CreateComputer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation to avoid getting empty field
        $request->validate([
            'pc-name'=>"required",
            'pc-origin'=>"required",
            'pc-price'=>['required','numeric'] // there are many of the built in validation look at the documentation
            // another way'pc-price'=>"required|numeric",
        ]);


        // creating instance (object) of the model Computer file
       $computer = new Computer();
       // from this instance which represents a table 
       // which has been created in the migration file
       // then we can reach the attributes of this table
       // using the instance of the Computer model file
       // $request-> input('name of the input') means that the
       // the variable $request which is from the class
       // Request is accessing the input of a submitted
       // form using the input name of this input then
       // associating the value of that input into one 
       // of the attributes of the accessed database table
       $computer->name = strip_tags($request->input('pc-name'));
       $computer->origin = strip_tags($request->input('pc-origin'));
       $computer->price = strip_tags($request->input('pc-price'));

       // use save() to save the entered data
       $computer->save();

       //returning to the page index using redirect()
       return redirect()->route('PC.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $pc_id)  
    {
        // $pc_id is same as the PC sent by the route when the link is clicked in the computers.index
        // page, the the id sent to the controller then after searching for the index of this id the 
        // row of this index will be sent to the page computers.UsingShow to display it  

        
        // $computers = self::getData();// saving the multi-demention array in the variable $computers
        // $index = array_search($pc_id, array_column($computers, 'id'));
        // first array_column function will extract the column of id keys only in array $computers
        // the column which is a single-demension, each id of this single-demension array will be 
        // compared to the $pc_id in the array_search function, if the entered id ($pc_id) is existed
        // the index of that id will be returned, otherwise it will return false.
        // if($index===false)
        //     abort(404); // it will show the abort page (The page does not exist)
        // return view("computers.UsingShow",['computer'=>$computers[$index]]);
        // if the id is existed, return the page computers.UsingShow and send it the variable
        // $computer which contains the row of the id which has been sent to this page by the 
        // computers.index page previously.
    
        /*Now the follwoing code is using the databse instead of the static data*/
         // you can use find() but findOrFail() is better to get 404 page if the id is not found,
         // while if you used find() if not found the function will return false
         // then you have to do the logic e.g. if($row==false) abort(404); 
        $row = Computer::findOrFail($pc_id);
        return view("computers.UsingShow",['computer'=>$row]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $comp_id)
    { // the id will be sent to this function
      // then the function will search for it in the database
      // if not found page 404 will be appearing otherwise the row will be sent 
      // to computers/edit page
        return view('computers.edit', ['computer'=>Computer::findOrFail($comp_id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $computer)
    {
        // The $request is the inputs of the form in the page you have come from.
        $request->validate([
            'pc-name'=>"required",
            'pc-origin'=>"required",
            'pc-price'=>['required','numeric'] 
         ]);

         $rowToUpdate = Computer::findOrFail($computer);
         $rowToUpdate->name = strip_tags($request->input('pc-name'));
         $rowToUpdate->origin = strip_tags($request->input('pc-origin'));
         $rowToUpdate->price = strip_tags($request->input('pc-price'));
         $rowToUpdate->save();
  
         //returning to the page index using redirect()
        return redirect()->route('PC.show', $computer);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $pc_id)
    { // this function does an action so it must come from a form
        $row_to_delete = Computer::findOrFail($pc_id);
        $row_to_delete -> delete();
        return redirect() -> route("PC.index");
    }
}
