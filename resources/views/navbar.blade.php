 <div class="nav-header">
     <div class="brand-logo">
         <a href="index.html">
             <b class="logo-abbr">D</b>
             <img class="brand-title" src="{{ asset('/assets/images1/avatar/logo.png') }}" height="50" width="155"
                 alt="">
         </a>
     </div>
 </div>


 <div class="header">
     <div class="header-content clearfix">
         <div class="header-left">
             <div class="input-group icons">
                 <div class="s_input_wrapper d-flex">
                     <input class="input_flied mt-3 rounded" type="text" placeholder="Let's find something..." />
                     <div class="drop-down animated flipInX d-md-none">
                         <form action="#">
                             <input type="text" class="form-control" placeholder="Search">
                         </form>
                     </div>
                 </div>
             </div>

         </div>
         <div class="header-right">

             <ul class="clearfix">
                 <li class="icons">
                     <div class="user-img c-pointer-x">
                         <span class="activity active"></span>
                         <img src="{{ asset('/assets/images1/avatar/1.jpg') }}" height="40" width="40"
                             alt="">
                     </div>
                     <div class="drop-down dropdown-profile animated flipInX">
                         <div class="dropdown-content-body">
                             <ul>
                                 <li><a href="javascript:void()"><i class="icon-user"></i> <span>My Profile</span></a>
                                 </li>

                                 <li><a href="javascript:void()"><i class="icon-check"></i> <span>Online</span></a>
                                 </li>
                                 <li><a href="{{ route('logout') }}"><i class="icon-key"></i> <span>Logout</span></a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </li>
             </ul>
         </div>


     </div>
 </div>
