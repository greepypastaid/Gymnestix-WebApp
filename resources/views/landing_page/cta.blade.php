<section id="daftar" class="relative h-64 sm:h-80 md:h-96 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/CTA.png') }}" alt="CTA Background" class="w-full h-full object-cover">
        <div class="absolute inset-0"></div>
    </div>

    <div class="relative z-10 h-full flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-2xl text-center lg:text-left text-white">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-poppins leading-tight mb-6 sm:mb-8">
                    Let's Join Membership
                </h2>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4 items-center justify-center lg:justify-start">
                    <a href="{{ route('register') }}"
                        class="inline-block md:w-full w-1/2 lg:w-auto md:px-5 sm:px-6 py-2.5 sm:py-3 text-base sm:text-lg bg-[#ADFF2F] text-black font-semibold rounded-md hover:bg-[#9DE626] transition-all shadow-sm tracking-wide text-center">
                        Join Now
                    </a>
                    <a href="{{ route('classes.index') }}"
                        class="inline-block md:w-full w-1/2 lg:w-auto md:px-5 sm:px-6 py-2.5 sm:py-3 text-base sm:text-lg border-2 border-white/30 text-white font-semibold rounded-md hover:border-[#ADFF2F] hover:text-[#ADFF2F] transition-all tracking-wide text-center">
                        Join Free Trial
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>