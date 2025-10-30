@extends('layout')

@section('content')
<h2>Sign in</h2>
<form id="loginForm">
  <input id="username" placeholder="username" required>
  <input id="password" type="password" placeholder="password" required>
  <button type="submit">Login</button>
</form>
<p id="msg" style="color:#c00"></p>
@endsection

@push('scripts')
<script>
document.getElementById('loginForm').addEventListener('submit', async (e)=>{
  e.preventDefault();
  msg.textContent = '';
  try {
    const res = await fetch('/ajax/login', {
      method: 'POST',
      headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
      body: JSON.stringify({username: username.value.trim(), password: password.value})
    });
    const raw = await res.text();
    let data; try{ data = JSON.parse(raw); }catch(_){ throw new Error('Unexpected response: '+raw.slice(0,160)); }
    if(res.ok && data.status==='success'){ location.href='/users'; }
    else { msg.textContent = data.message || ('HTTP '+res.status); }
  } catch (err) {
    msg.textContent = err.message || 'Request failed';
  }
});
</script>
@endpush
