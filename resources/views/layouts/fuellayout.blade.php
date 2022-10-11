<!DOCTYPE html>
  <!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== --> 
    {{-- <link rel="stylesheet" href="style.css"> --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="/maindir/css/bootstrap.min.css">
    <link rel="stylesheet" href="/maindir/css/fuel.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->

    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
    <!--<title>Dashboard Sidebar Menu</title>--> 
</head>
<body>
    
    @yield('navs')

    {{-- <section class="home">
        <div class="text">Dashboard Sidebar</div>
    </section> --}}

    @yield('content')

    <script>

        // sessionStorage.setItem("x", 'True..!');
        // // sessionStorage.getItem("x");
        // alert(sessionStorage.getItem("x"));

      const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");

        $x = sessionStorage.getItem("my_mode");
        if($x == 'light'){
            // alert(sessionStorage.getItem("my_mode"));
            modeText.innerText = "Dark mode";
        }else{
            body.classList.toggle("dark");
            modeText.innerText = "Light mode";
        }


        toggle.addEventListener("click" , () =>{
            sidebar.classList.toggle("close");
        })

        searchBtn.addEventListener("click" , () =>{
            sidebar.classList.remove("close");
        })

        modeSwitch.addEventListener("click" , () =>{
            body.classList.toggle("dark");
            sessionStorage.setItem("my_mode", 'dark');
            
            if(body.classList.contains("dark")){
                modeText.innerText = "Light mode";
            }else{
                modeText.innerText = "Dark mode";
                sessionStorage.setItem("my_mode", 'light');
            }
        });

    </script>


  {{-- <script src="/maindir/js/bootstrap.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}

</body>
</html>
