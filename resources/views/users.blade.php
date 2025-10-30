@extends('layout')

@section('content')
<h2>Users</h2>

<form id="addForm">
  <button type="submit">Add New User</button>
  <input name="password" type="password" placeholder="password" required>
  <input name="email" type="email" placeholder="email" required>
  <input name="age" type="number" min="0" placeholder="age">
  <input name="name" placeholder="name">
  <input name="username" placeholder="username" required>
</form>
<p id="addMsg" style="color:#c00"></p>

<table id="tbl">
  <thead>
    <tr>
      <th>Actions</th>
      <th>Email</th>
      <th>Age</th>
      <th>Name</th>
      <th>Username</th>
      <th>ID</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>
@endsection

@push('scripts')
<script>
const tbody = document.querySelector('#tbl tbody');
const addMsg = document.getElementById('addMsg');

async function loadUsers(){
  try{
    const res = await fetch('/ajax/users', { headers:{'Accept':'application/json'} });
    const raw = await res.text();
    let data; try{ data = JSON.parse(raw); }catch(_){ throw new Error('Unexpected: '+raw.slice(0,180)); }
    tbody.innerHTML = data.map(u => row(u)).join('');
  }catch(err){
    addMsg.textContent = 'Load error: ' + (err.message || err);
  }
}

function row(u){
  return `<tr data-id="${u.id}">
    <td>
      <button class="editBtn" type="button">Edit</button>
      <button class="cancelBtn" type="button" style="display:none">Cancel</button>
      <button class="delBtn" type="button">Delete</button>
    </td>
    <td data-k="email">${u.email??''}</td>
    <td data-k="age">${u.age??''}</td>
    <td data-k="name">${u.name??''}</td>
    <td data-k="username">${u.username??''}</td>
    <td>${u.id}</td>
  </tr>`;
}

/* ===== Helpers ===== */
function setEditable(tr, enabled){
  tr.querySelectorAll('[data-k]').forEach(td => td.contentEditable = enabled ? 'true' : 'false');
  tr.querySelector('.editBtn').textContent = enabled ? 'Save' : 'Edit';
  tr.querySelector('.cancelBtn').style.display = enabled ? '' : 'none';
  tr.dataset.editing = enabled ? '1' : '0';
  // إضافة/إزالة مستمع مفاتيح Enter/Escape
  if(enabled){
    tr.addEventListener('keydown', keyHandler);
  }else{
    tr.removeEventListener('keydown', keyHandler);
  }
}

function keyHandler(e){
  if(e.key === 'Enter'){ e.preventDefault(); this.querySelector('.editBtn').click(); }
  if(e.key === 'Escape'){ e.preventDefault(); this.querySelector('.cancelBtn').click(); }
}

function validatePayload(p){
  const emailOk = !p.email || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(p.email);
  if(!emailOk) return 'Invalid email format';
  if(p.age && isNaN(Number(p.age))) return 'Age must be a number';
  if(p.username !== undefined && !p.username.trim()) return 'Username is required';
  return null;
}

function getEditingRow(){
  return tbody.querySelector('tr[data-editing="1"], tr[data-editing="true"], tr[data-editing="1"]');
}

/* ===== Add User ===== */
document.getElementById('addForm').addEventListener('submit', async (e)=>{
  e.preventDefault(); addMsg.textContent='';
  const f = new FormData(e.target);
  const payload = Object.fromEntries(f.entries());
  // تنظيف مبسّط
  payload.username = (payload.username||'').trim();
  payload.name     = (payload.name||'').trim();
  payload.email    = (payload.email||'').trim();

  const err = validatePayload(payload);
  if(err){ addMsg.textContent = err; return; }

  try{
    const res = await fetch('/ajax/users', {
      method:'POST',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
      body: JSON.stringify(payload)
    });
    const raw = await res.text();
    let data; try{ data = JSON.parse(raw); }catch(_){ throw new Error('Unexpected: '+raw.slice(0,180)); }
    if(res.ok && data.status==='success'){ e.target.reset(); loadUsers(); }
    else{
      if(data.errors){ addMsg.textContent = Object.values(data.errors)[0][0]; }
      else{ addMsg.textContent = data.message || ('HTTP '+res.status); }
    }
  }catch(err){ addMsg.textContent = err.message || 'Request failed'; }
});

/* ===== Row actions ===== */
tbody.addEventListener('click', async (e)=>{
  const tr = e.target.closest('tr'); if(!tr) return;
  const id = tr.dataset.id;

  // Edit / Save toggle
  if(e.target.classList.contains('editBtn')){
    // اسمحي فقط بصف واحد في وضع التعديل
    const current = getEditingRow();
    if(current && current !== tr){
      // ألغِ الصف الآخر قبل فتح هذا
      try{
        const original = JSON.parse(current.dataset.original || '{}');
        current.querySelectorAll('[data-k]').forEach(td => {
          const k = td.dataset.k;
          if(k in original) td.textContent = original[k] ?? '';
        });
      }catch(_){}
      setEditable(current, false);
    }

    if(tr.dataset.editing !== '1'){
      // Switch to edit mode
      setEditable(tr, true);
      tr.dataset.original = JSON.stringify(Object.fromEntries(
        Array.from(tr.querySelectorAll('[data-k]')).map(td => [td.dataset.k, td.textContent.trim()])
      ));
      tr.setAttribute('data-editing','1');
      return;
    }

    // Save (we are already in edit mode)
    const payload = {};
    tr.querySelectorAll('[data-k]').forEach(td => payload[td.dataset.k]=td.textContent.trim());
    const vErr = validatePayload(payload);
    if(vErr){ alert(vErr); return; }

    try{
      const res = await fetch(`/ajax/users/${id}`, {
        method:'PUT',
        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if(res.ok && data.status==='success'){ setEditable(tr,false); tr.removeAttribute('data-editing'); loadUsers(); }
      else { alert((data.errors && Object.values(data.errors)[0][0]) || data.message || 'Update failed'); }
    }catch(err){ alert(err.message || 'Update failed'); }
  }

  // Cancel
  if(e.target.classList.contains('cancelBtn')){
    try{
      const original = JSON.parse(tr.dataset.original || '{}');
      tr.querySelectorAll('[data-k]').forEach(td => {
        const k = td.dataset.k;
        if(k in original) td.textContent = original[k] ?? '';
      });
    }catch(_){}
    setEditable(tr, false);
    tr.removeAttribute('data-editing');
  }

  // Delete
  if(e.target.classList.contains('delBtn')){
    if(confirm('Delete user?')){
      try{
        const res = await fetch(`/ajax/users/${id}`, { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'} });
        const data = await res.json();
        if(res.ok && data.status==='success'){ tr.remove(); }
        else { alert(data.message || 'Delete failed'); }
      }catch(err){ alert(err.message || 'Delete failed'); }
    }
  }
});

loadUsers();
</script>
@endpush
