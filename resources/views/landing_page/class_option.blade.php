<section id="kelas" class="py-20">
    @php
    $classes = [
    [
        'name' => 'HIIT BURN',
        'desc' => 'Latihan intensitas tinggi untuk membakar kalori cepat dan meningkatkan stamina dalam waktu singkat.',
        'image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=800&auto=format&fit=crop',
    ],
    [
        'name' => 'POWER LIFTING',
        'desc' => 'Fokus kekuatan maksimal: squat, bench press, dan deadlift dengan teknik yang benar dan aman.',
        'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=800&auto=format&fit=crop',
    ],
    [
        'name' => 'MOBILITY FLOW',
        'desc' => 'Perbaiki mobilitas sendi, fleksibilitas, dan kurangi risiko cedera dengan gerakan dinamis.',
        'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800&auto=format&fit=crop',
    ],
    [
        'name' => 'CYCLING CLASS',
        'desc' => 'Sesi cardio energik dengan musik upbeat dan instruktur motivatif untuk pembakaran kalori maksimal.',
        'image' => 'https://images.unsplash.com/photo-1507398941214-572c25f4b1dc?w=800&auto=format&fit=crop',
    ],
    ];
    @endphp

    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-stretch gap-8 mb-16">
            <a href="{{ route('classes.index') }}" class="w-1/2 text-left text-6xl font-poppins font-base">Yuk, Explore Kelas Populer di Gymnestix!</a>
            <div class="w-1/3 flex flex-col justify-end">
                <p class="text-neutral-400 text-right">Pilih kelas yang sesuai dengan tujuanmu — dari kelas-kelas terbaik. Instruktur berpengalaman siap membimbingmu di setiap sesi.</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6">
            @foreach ($classes as $c)
            <div class="group relative h-[420px] rounded-2xl overflow-hidden cursor-pointer bg-neutral-800">
                <!-- Background Image -->
                <div class="absolute inset-0">
                    <img src="{{ $c['image'] }}" 
                         alt="{{ $c['name'] }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <!-- Dark overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>
                </div>

                <!-- Content -->
                <div class="relative h-full flex flex-col justify-end p-6 text-white">
                    <!-- Class Name -->
                    <h3 class="text-2xl font-poppins font-bold uppercase mb-3 tracking-wide group-hover:text-[#ADFF2F] transition-colors">
                        {{ $c['name'] }}
                    </h3>
                    
                    <!-- Description -->
                    <p class="text-sm text-gray-300 mb-5 leading-relaxed">
                        {{ $c['desc'] }}
                    </p>
                    
                    <!-- CTA Button -->
                    <a href="{{ route('classes.index') }}" 
                       class="inline-flex items-center gap-2 font-semibold text-sm uppercase tracking-wider hover:gap-3 transition-all group">
                        <span>Find Out More</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Hover border glow effect -->
                <div class="absolute inset-0 border-2 border-green-500/0 group-hover:border-[#ADFF2F] rounded-2xl transition-all duration-300 pointer-events-none"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>