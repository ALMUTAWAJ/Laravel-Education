@extends('layout') 
@section("PageTitle","Edit Computer Info")

@section("content")
<div style='font-family:Courier New, Courier, monospace;color:red; margin:2rem;' align=center>
 <h1>Computers Types</h1>
</div>
<link rel="stylesheet" href={{url("css/create.css")}}>
<div class="cf">
    {{-- Note that in the route in the action I wrote it previously as {{route('PC.update', ['pc_id' => $computer->id])}}
    but I don't know why it does not work, I solve it by just removing the variable pc_id, because actually we don't need an array 
    just pass the id and that's it. --}}
     <form action="{{route('PC.update', $computer->id)}}" method="post"> {{--we send the form to the store function in the ComputerController to save the data in the database --}}
        @csrf {{-- All forms must mention @csrf or the form will not be sent due to the security concerns, 
            Cross site request forgery (CSRF), also known as XSRF, Sea Surf or Session Riding, is an attack vector that tricks a web browser into executing an unwanted action in an application to which a user is logged in
            --}}    
          @method('PUT')  {{--  we need PUT method to update and the browser just understand POST so we need we write here  --}}
        <div>
            <label for="pc-name">Name: </label>
            <input type="text" name="pc-name" value={{$computer->name}}>
            {{-- To show the error we use function in laravel called error --}}
            <div class="form-error">
                @error('pc-name')
             {{$message}} {{--laravel gives this message compatable with the error --}}
            @enderror
            </div>
        </div>

        <div>
            <label for="pc-origin">origin: </label>
            <input type="text" name="pc-origin" value={{$computer->origin}}>
            <div class="form-error">
                @error('pc-origin')
                {{$message}}
                @enderror
            </div>
        </div>
        <div>
            <label for="pc-price">Price: </label>
            <input type="text" name="pc-price" value={{$computer->price}}>
            <div class="form-error">
                @error('pc-price')
                {{$message}}
                @enderror
            </div>
        </div>
        <div>
            <button type="submit">Save</button>
        </div>
    </form> 
</div>
    
   
    {{-- {{print_r($computer);}} --}}
    

@endsection