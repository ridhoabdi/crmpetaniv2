<!DOCTYPE html>
<html lang="en-US" dir="ltr">


    <head>
        @include('layouts.link')
    </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        @include('nav.navwagon')


        @yield('section')

      
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    @include('script.script')

  </body>

</html>