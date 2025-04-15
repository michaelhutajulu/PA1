<style>
    body {
        font-family: Arial, sans-serif;
    }
    .message-box {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #0d6efd;
        margin-top: 10px;
    }
</style>

<h2 style="color:#0d6efd;">📩 Kritik & Saran dari Pengguna</h2>

<p><strong>Nama:</strong> {{ $data['nama'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>

<div class="message-box">
    <p><strong>Pesan:</strong></p>
    <p>{{ $data['pesan'] }}</p>
</div>
