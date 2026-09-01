<div class="swiper mySwiper fixed right-0 top-1/2 -translate-y-1/2 z-50 h-[80vh] w-[110px] bg-white rounded-l-2xl shadow-2xl border-l border-gray-200 flex flex-col justify-center items-center overflow-hidden"
     style="box-shadow: -4px 0 24px rgba(37,99,235,0.10);">
    <div class="swiper-wrapper h-full overflow-hidden">
        @foreach($slides as $slide)
            <div class="swiper-slide flex items-center justify-center h-[180px] w-full p-2">
                <img src="{{ $slide['img'] }}" alt="{{ $slide['alt'] ?? '' }}" class="rounded-xl shadow w-full h-full object-cover">
            </div>
        @endforeach
    </div>
    <div class="swiper-button-prev !top-8 !left-1/2 !-translate-x-1/2 !translate-y-0 !rotate-90"></div>
    <div class="swiper-button-next !bottom-8 !left-1/2 !-translate-x-1/2 !translate-y-0 !-rotate-90"></div>
</div> 