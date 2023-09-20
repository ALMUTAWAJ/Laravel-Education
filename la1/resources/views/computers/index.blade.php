@extends('layout') 
@section("PageTitle","Computers Index")

@section("content")
<div class="C1">
<div style='font-family:Courier New, Courier, monospace;color:red;''>
 <h1>Computers Types</h1>
</div>

    @if(count($computer)>0)
    <ul>
        @foreach ($computer as $pc)
{{-- Note that PC.show refers to the route which called PC then . the function 
show which is related to the route PC, and the PC variable in 
[ 'PC' => $pc['id']] below must be exactly PC becuase it must be same name as
the route name which is PC. This variable 'PC'will be used by the show
function that is located in the ComputerController PC is actually called 
$pc_id in the show function parameter --}}

           <a href={{route('PC.show',[ 'PC' => $pc['id']])}}>
            {{-- Note that if you wrote $pc['id'] instead of [ 'PC' => $pc['id']], it is better because no need to assign it to a variable called PC --}}
            <li>{{$pc['name']}} (<strong>{{$pc['origin']}}</strong>) - <strong>{{$pc['price']}}$</strong></li>
           </a>
        @endforeach
       </ul>
       @else  {{--the else is related to the "if" above --}}
       <p>There is no computers to display.</p>

       @endif  {{--ending the conditions for the above if and its else --}}
</div>
   
    {{-- {{print_r($computer);}} --}}
    
@endsection

