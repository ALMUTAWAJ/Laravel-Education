<!--Note that this code will be used as a tempelate for more than one page-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("PageTitle")</title>
<style>/*You can write here if you want*/</style>
        <!--
        Don't do it like the above methodology because if you change the route this file will not find 
        the css file, you have to put url() function like the following url(css/style.css)
        -->
        <link rel="stylesheet" href={{url("css/style.css")}}>

        </head>
<body>
    <nav>
        {{-- <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="/contact">Contact</a> --}}
        <!--Since the route may be changed and the links here are dependent
             on the routes then it is better to link them, so that if the 
             routes have been changed the links also will direct to the same 
             locations of the routes.

             Summary: it is better to define names of the routes and call the routes 
             here as links so if the routes changed the links will direct you to the 
             new routes.
        -->
        <a href="{{route('home.index')}}">Home</a> 
        <a href="{{route('home.about')}}">About</a>
        <a href="{{route('PC.index')}}">Computers</a> {{-- PC.index which is the "name of the route" then "." the "function name" inside the mentioned controller file in the route --}}
        <a href="{{route('PC.create')}}">Create</a>
        {{-- the route name computers.index means the folder computers and the file index,
         but the url in the bar will include only computers and ignore index or any other
         files like if you write route("computers.whatever") you will be directed to the file
         whatever, but the url bar will show only computers, all that because this route is using resource instead of get --}}
        <a href="{{route('home.contact')}}">Contact</a>
        {{-- the name of the route in the first link is home.index
             to see where the names are defined go to web.php
             --}}
    </nav>
        @yield('content')
<!--The previous instruction is to mention that here will be a section of code called content-->
    </body>
</html> 
    