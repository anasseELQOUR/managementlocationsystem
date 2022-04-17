<!DOCTYPE html>

<html lang="en">
<head><script nonce="f6799280-4ce1-45d1-b90d-874080e85e73">(function(w,d){!function(a,e,t,r){a.zarazData=a.zarazData||{},a.zarazData.executed=[],a.zarazData.tracks=[],a.zaraz={deferred:[]},a.zaraz.track=(e,t)=>{for(key in a.zarazData.tracks.push(e),t)a.zarazData["z_"+key]=t[key]},a.zaraz._preSet=[],a.zaraz.set=(e,t,r)=>{a.zarazData["z_"+e]=t,a.zaraz._preSet.push([e,t,r])},a.addEventListener("DOMContentLoaded",(()=>{var t=e.getElementsByTagName(r)[0],z=e.createElement(r),n=e.getElementsByTagName("title")[0];n&&(a.zarazData.t=e.getElementsByTagName("title")[0].text),a.zarazData.w=a.screen.width,a.zarazData.h=a.screen.height,a.zarazData.j=a.innerHeight,a.zarazData.e=a.innerWidth,a.zarazData.l=a.location.href,a.zarazData.r=e.referrer,a.zarazData.k=a.screen.colorDepth,a.zarazData.n=e.characterSet,a.zarazData.o=(new Date).getTimezoneOffset(),z.defer=!0,z.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(a.zarazData))),t.parentNode.insertBefore(z,t)}))}(w,d,0,"script");})(window,document);</script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AdminLTE 3 | Starter</title>
<link rel="stylesheet" href="{{ mix("css/app.css") }}">
@livewireStyles

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <x-topnav/>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a href="index3.html" class="brand-link">
<span class="brand-text font-weight-light" style="font-size: 1.3em"><b>MLS</b></span>
</a>

<div class="sidebar">

<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="image">
<img src="{{ asset('images/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
</div>
<div class="info">
<a href="#" class="d-block">{{ userFullName() }}</a>
</div>
</div>

<x-menu/>

</div>

</aside>

<div class="content-wrapper">


    <div class="content">
        <div class="container-fluid">
            @yield("contenu")
        </div>

    </div>

</div>


<x-sidebar/>


<footer class="main-footer">

<div class="float-right d-none d-sm-inline">
Anything you want
</div>

<strong>Copyright &copy; 2022 <a href="https://adminlte.io">AnasseELQOUR.ae</a>.</strong> All rights reserved.
</footer>
</div>
<script src="{{ mix('js/app.js') }}"></script>
@livewireScripts
</body>
</html>
