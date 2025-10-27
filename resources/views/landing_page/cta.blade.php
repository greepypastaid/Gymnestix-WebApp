<section id="daftar" class="relative h-96 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('storage/CTA.png') }}" alt="CTA Background" class="w-full h-full object-cover">
        <div class="absolute inset-0"></div>
    </div>

    <div class="relative z-10 h-full flex items-center">
        <div class="max-w-7xl mx-auto px-6 w-full">
            <div class="max-w-2xl">
                <h2 class="text-5xl font-poppins text-white leading-tight mb-8">
                    Let's Join Membership
                </h2>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('register') }}" 
                        class="inline-block px-4 py-2 text-lg bg-[#ADFF2F] text-black font-semibold rounded-md hover:bg-[#9DE626] transition-all shadow-sm tracking-wide">
                         Join Now
                    </a>
                    <a href="{{ route('classes.index') }}" 
                        class="inline-block px-4 py-2 text-lg border-2 border-white/30 text-white font-semibold rounded-md hover:border-[#ADFF2F] hover:text-[#ADFF2F] transition-all tracking-wide">
                         Join Free Trial
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>