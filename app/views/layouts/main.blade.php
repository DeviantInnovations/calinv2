<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Cal Inventory</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('assets/css/bootstrap.css') }}
    <!--external css-->
    {{ HTML::style('assets/font-awesome/css/font-awesome.css') }}
    {{ HTML::style('assets/css/zabuto_calendar.css') }}
    {{ HTML::style('assets/js/gritter/css/jquery.gritter.css') }}
    {{ HTML::style('assets/lineicons/style.css') }}
    
    <!-- Custom styles for this template -->
    {{ HTML::style('assets/css/style.css') }}
    {{ HTML::style('assets/css/style-responsive.css') }}
    
    
     {{ HTML::script('assets/js/chart-master/Chart.js') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      {{ HTML::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
      {{ HTML::script('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>Cal Inventory</b></a>
            <!--logo end-->
            
           
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="/logout">Logout</a></li>
                </ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  
                  <h5 class="centered">{{Auth::user()->name}}</h5>
                  <br>
                  <li class="sidebar-search">
                    {{ Form::open(array( 'method'=> 'POST', 'action' => '/search')) }}
                            <div class="custom-search-form">

                                <input type="text" class="form-control" name ="term" placeholder="Search...">
                            
                            </div>
                            <!-- /input-group -->
                            {{ Form::close();}}
                  </li>
                  <br>

                  <li class="sub-menu">
                      <a href="/home" @if(Session::get('home')==1) {{Session::forget('home')}} class= "active" @endif >
                          <i class="fa fa-desktop"></i>
                          <span>Home</span>
                      </a>
                   
                  </li>
                   <li class="sub-menu">
                      <a href="/search" @if(Session::get('search')==1) {{Session::forget('search')}} class= "active" @endif >
                          <i class="fa fa-book"></i>
                          <span>Browse Inventory</span>
                      </a>
            
                    </li>
                    <li class="sub-menu">
                      <a href="/transact/credit" @if(Session::get('credit')==1) {{Session::forget('credit')}} class= "active" @endif>
                          <i class="fa fa-book"></i>
                          <span>Credit</span>
                      </a>
            
                    </li>
                    <li class="sub-menu">
                      <a href="/transact/debit" @if(Session::get('debit')==1) {{Session::forget('debit')}} class= "active" @endif>
                          <i class="fa fa-book"></i>
                          <span>Debit</span>
                      </a>
            
                    </li>
                  <li class="sub-menu">
                      <a href="/edit/account" @if(Session::get('account')==1) {{Session::forget('account')}} class= "active" @endif >
                          <i class="fa fa-cogs"></i>
                          <span>Account Settings</span>
                      </a>
                     
                  </li>
                 
                 @if(Auth::user()->type==0)
                  <li class="sub-menu">
                      <a href="javascript:;"  @if(Session::get('management')==1) {{Session::forget('management')}} class= "active" @endif >
                          <i class="fa fa-tasks"></i>
                          <span>Management</span>
                      </a>
                      <ul class="sub">
                          
                          <li><a  href="/admin/members">Members</a></li>
                          
                          <li><a  href="/admin/fabrics">Fabrics</a></li>
                          
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="/admin/transactions" @if(Session::get('transactions')==1) {{Session::forget('transactions')}} class= "active" @endif >
                          <i class="fa fa-th"></i>
                          <span>Transactions</span>
                      </a>
                   
                  </li>
                 
                  @endif
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

            <h3><i class="fa fa-angle-right"></i> @yield('title')</h3>
  
              
                @yield('main')

                @yield('dialogs')
            </section>
        </section>
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2015 - Project Deviance 
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
              @yield('footer')
          </div>
      </footer>
      <!--footer end-->
  </section>
    
   
    {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js') }}
    {{ HTML::script('assets/js/jquery.githubRepoWidget.min.js') }}

    <!-- js placed at the end of the document so the pages load faster -->
    {{ HTML::script('assets/js/jquery.js') }}
    {{ HTML::script('assets/js/jquery-1.8.3.min.js') }}
    {{ HTML::script('assets/js/bootstrap.min.js') }}
    {{ HTML::script('assets/js/jquery.dcjqaccordion.2.7.js') }}
    {{ HTML::script('assets/js/jquery.scrollTo.min.js') }}
    {{ HTML::script('assets/js/jquery.nicescroll.js') }}
    {{ HTML::script('assets/js/jquery.sparkline.js') }}

    <!--common script for all pages-->
    {{ HTML::script('assets/js/common-scripts.js') }}
    {{ HTML::script('assets/js/gritter/js/jquery.gritter.js') }}
    {{ HTML::script('assets/js/gritter-conf.js') }}
    
    <!--script for this page-->
    {{ HTML::script('assets/js/sparkline-chart.js') }}
    {{ HTML::script('assets/js/zabuto_calendar.js') }}
    
    
    
    <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</html>
