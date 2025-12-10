<p>Hai {{ $user->nama ?? $user->name }},</p>

@if ($type == 'H-1')
    <p>Ini adalah pengingat bahwa Anda memiliki jadwal latihan <b>besok</b>:</p>
@else
    <p>Ini adalah pengingat bahwa Anda memiliki jadwal latihan <b>hari ini</b>:</p>
@endif

<p>
    <b>{{ $class->nama_kelas }}</b><br>
    Hari: {{ ucfirst($class->hari) }}<br>
    Jam:
    {{ $class->waktu_mulai ? $class->waktu_mulai->format('H:i') : '-' }}
    -
    {{ $class->waktu_selesai ? $class->waktu_selesai->format('H:i') : '-' }}
</p>


<p>Sampai bertemu di kelas! 💪</p>
