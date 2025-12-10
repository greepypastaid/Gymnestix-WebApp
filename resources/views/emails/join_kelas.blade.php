<h2 style="font-weight: bold; color: #4CAF50;">Invoice Pembelian Kelas</h2>

<p>Halo {{ $booking->member->user->nama }},</p>

<p>Terima kasih telah membeli kelas:</p>

<ul>
    <li><strong>{{ $class->nama_kelas }}</strong></li>
    <li>Hari: {{ ucfirst($class->hari) }}</li>
    <li>Waktu: {{ $class->waktu_mulai }} - {{ $class->waktu_selesai }}</li>
    <li>Tanggal Pembelian: {{ $booking->tanggal_booking }}</li>
</ul>

<p>Semoga latihanmu menyenangkan! 💪</p>
<p>Gymnestix</p>
