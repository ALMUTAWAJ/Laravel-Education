@extends('layout') 
<style>
    body
    {
        display: flex;
        flex-direction: column;
    }

    .buttons
    {
        align-self: center;
    }

button
{
    padding: 0.25rem;
    cursor: pointer;
    width: 5rem;
    border-radius: 5rem;
    border:none;
}

.edit
{
    background-color: rgba(76, 87, 169, 0.571);
}

.delete
{
    background-color: rgba(228, 26, 33, 0.416);
}


button:hover
{
    background-color: rgb(176, 127, 176);
}

</style>
@section("PageTitle","The Chose Computer")

@section("content")
<div style='font-family:Courier New, Courier, monospace;color:red; margin:2rem;' align=center>
 <h1>Computers Types</h1>
</div>

 <h3 align="center">
{{$computer['name']}} (<strong>{{$computer['origin']}}</strong>) - <strong>{{$computer['price']}}$</strong>
 </h3>
    
   <div class="buttons">

    <a  href="{{route("PC.edit", $computer->id)}}"><button class="edit">Edit</button></a>

   <form style="display:inline-block" action="{{route("PC.destroy", $computer->id)}}" method='post'> <!--method = 'post' is for the browser-->
    @csrf  {{--  must be in each form or the form will not be sent  --}}
    @method('DELETE')  {{--to delete use @method(DELETE) [laravel requires that] --}}
    <button type="submit" class="delete">Delete</button>
    </form>

   </div>
   {{-- Note that for the delete button you must send the the id to the route using a form
        because deleting is an action will be executed while edit is a link because the id 
        is sent to the function edit which redirect you to the edit page then by the edit page 
        you will have a form which its data will be sent to update function to do the action of update. --}}
    {{-- {{print_r($computer);}} --}}
    

@endsection