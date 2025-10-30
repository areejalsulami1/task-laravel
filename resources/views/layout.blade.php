<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name','TaskProject') }}</title>
  <style>
    body{font-family:system-ui,Segoe UI,Tahoma,Arial;margin:20px}
    nav a, nav button{margin-right:10px}
    table{border-collapse:collapse;width:100%;margin-top:14px}
    td,th{border:1px solid #ddd;padding:8px}
    form input, form button{margin:4px;padding:6px}
  </style>
</head>
<body>
  <nav style="margin-bottom:12px">
    @auth
      <a href="/users">Users</a> |
      <a href="/logs">Logs</a> |
      <button id="logoutBtn" type="button">Logout</button>
    @else
      <a href="/">Login</a>
    @endauth
  </nav>

  @yield('content')

  <script>
    // Global helpers
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;
    async function post(url, data){return fetch(url,{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},body:JSON.stringify(data)});}
    async function put(url, data){return fetch(url,{method:'PUT', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},body:JSON.stringify(data)});}
    async function del(url){return fetch(url,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});}

    const logoutBtn=document.getElementById('logoutBtn');
    if(logoutBtn){ logoutBtn.addEventListener('click', async ()=>{ await post('/ajax/logout',{}); location.href='/';});}
  </script>
  @stack('scripts')
</body>
</html>
