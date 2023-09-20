@extends('layout') 
@section("PageTitle","New Computer")

@section("content")
<div style='font-family:Courier New, Courier, monospace;color:red; margin:2rem;' align=center>
 <h1>Computers Types</h1>
</div>
<link rel="stylesheet" href={{url("css/create.css")}}>
<div class="cf">
     <form action="{{route("PC.store")}}" method="post"> {{--we send the form to the store function in the ComputerController to save the data in the database --}}
        @csrf {{-- All forms must mention @csrf or the form will not be sent due to the security concerns, 
            Cross site request forgery (CSRF), also known as XSRF, Sea Surf or Session Riding, is an attack vector that tricks a web browser into executing an unwanted action in an application to which a user is logged in
            --}}    
        <div>
            <label for="pc-name">Name: </label>
            <input type="text" name="pc-name" value={{old('pc-name')}}>
            {{-- To show the error we use function in laravel called error --}}
            <div class="form-error">
                @error('pc-name')
             {{$message}} {{--laravel gives this message compatable with the error --}}
            @enderror
            </div>
        </div>

        <div>
            <label for="pc-origin">origin: </label>
            <input type="text" name="pc-origin" value={{old('pc-origin')}}>
            <div class="form-error">
                @error('pc-origin')
                {{$message}}
                @enderror
            </div>
        </div>
        <div>
            <label for="pc-price">Price: </label>
            <input type="text" name="pc-price" value={{old('pc-price')}}>
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