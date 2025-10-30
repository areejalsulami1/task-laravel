@extends('layout')

@section('content')
<h2>Logs</h2>
<table id="logs">
  <thead>
    <tr>
      <th>ID</th>
      <th>User</th>
      <th>Action</th>
      <th>Details</th>
      <th>When</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>
@endsection

@push('scripts')
<script>
async function loadLogs(){
  const res = await fetch('/ajax/logs', { headers:{'Accept':'application/json'} });
  const data = await res.json();
  document.querySelector('#logs tbody').innerHTML = data.map(l => `
    <tr>
      <td>${l.id}</td>
      <td>${l.user}</td>
      <td>${l.action}</td>
      <td>${l.details ?? ''}</td>
      <td>${l.created_at}</td>
    </tr>
  `).join('');
}
loadLogs();
</script>
@endpush
