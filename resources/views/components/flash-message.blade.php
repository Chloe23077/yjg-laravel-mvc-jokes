@props(['message','icon','type','fgColour','bgColour','fgText','bgText'])

{{--@if (session('message'))--}}
{{--    <x-flash-message--}}
{{--        :message="session('message')"--}}
{{--        :icon="session('icon', 'fa-solid fa-info-circle')"--}}
{{--        :type="session('type', 'Info')"--}}
{{--        :fgColour="session('fgColour', 'text-white')"--}}
{{--        :bgColour="session('bgColour', 'bg-blue-500')"--}}
{{--        :fgText="session('fgText', 'text-gray-800')"--}}
{{--        :bgText="session('bgText', 'bg-blue-100')"/>--}}
{{--@endif--}}

@if ($message)
    <section class="-mx-2 flex items-center {{ $bgText }} overflow-hidden">
        <div class="p-6 py-2 {{ $bgColour }} text-center">
            <i class="{{ $icon }} text-5xl min-w-24 {{ $fgColour }}"></i>
        </div>
        <div class="px-6 {{ $fgText }}">
            <h3 class="tracking-wider">{{$type}}</h3>
            <p class="text-xl">{{ $message }}</p>
        </div>
    </section>
@endif
