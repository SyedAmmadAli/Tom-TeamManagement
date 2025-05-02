<h2>Data Deletion Request</h2>
<p>Click button to delete your data:</p>
<form action="/fb-delete-data" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user_id }}">
    <button type="submit">Delete My Data</button>
</form>