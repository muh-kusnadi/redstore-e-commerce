<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.front_partials._head')

    @stack('css')
</head>
<body>
   <!-- start header section -->
   @include('layouts.front_partials._header')
   <!-- end header section -->

   @yield('content')

   <!-- start footer -->
   @include('layouts.front_partials._footer')
   <!-- end footer -->

   <!-- start js -->
   @include('layouts.front_partials._javascript')

   @stack('scripts')
   <!-- end js -->
</body>
</html>