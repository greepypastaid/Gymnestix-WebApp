<section id="kelas" class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-start gap-8 mb-16">
            <a href="{{ route('classes.index') }}" class="md:w-1/2 w-full text-left text-3xl md:text-6xl font-poppins font-base">Yuk, Explore Kelas Populer di Gymnestix!</a>
            <div class="md:w-1/3 w-full flex flex-col justify-end">
                <p class="text-neutral-400 md:text-right text-left">Pilih kelas yang sesuai dengan tujuanmu — dari kelas-kelas terbaik. Instruktur berpengalaman siap membimbingmu di setiap sesi.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($classes as $c)
            <div class="group relative md:h-[420px] h-auto rounded-2xl overflow-hidden cursor-pointer bg-neutral-800">
                <div class="absolute inset-0">
                    <img src="{{ $c->image_url ?? asset('images/default_class.jpg') }}" 
                        alt="{{ $c->nama_kelas }}" 
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy" decoding="async">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>
                </div>

                <div class="relative h-full flex flex-col justify-end p-6 text-white">
                    <h3 class="text-2xl font-poppins font-bold uppercase mb-3 tracking-wide group-hover:text-[#ADFF2F] transition-colors">
                        {{ $c->nama_kelas ?? $c->nama ?? 'Kelas' }}
                    </h3>

                    <p class="text-sm text-gray-300 mb-5 leading-relaxed">
                        {{ Str::limit($c->deskripsi ?? ($c->desc ?? '-'), 120) }}
                    </p>

                    <a href="{{ route('classes.index') }}" 
                       class="inline-flex items-center gap-2 font-semibold text-sm uppercase tracking-wider hover:gap-3 transition-all group">
                        <span>Find Out More</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="absolute inset-0 border-2 border-green-500/0 group-hover:border-[#ADFF2F] rounded-2xl transition-all duration-300 pointer-events-none"></div>
            </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-neutral-500 text-lg">Belum ada kelas tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>