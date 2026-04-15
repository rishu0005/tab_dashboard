@extends('layouts.app')

@section('content')
<div class="relative w-full h-screen overflow-hidden">

    {{-- Background Wallpaper --}}
    <div 
        class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('{{ asset('images/Anime community design concept.jpg') }}');">
    </div>

    {{-- Dark overlay --}}
    <div class="absolute inset-0 bg-black/40"></div>


    {{-- LEFT GLASS SIDEBAR --}}
    <div class="absolute top-1/2 left-10 -translate-y-1/2 
                h-[520px] w-[120px] rounded-3xl 
                bg-white/10 backdrop-blur-2xl border border-white/20 
                shadow-[0_8px_40px_rgba(0,0,0,0.4)]
                flex flex-col items-center py-8 space-y-8">

        {{-- ICONS --}}
        <button class="p-3 rounded-xl bg-white/10 hover:bg-white/20 transition">
            <x-icons.home class="w-6 h-6 text-white" />
        </button>

        <button class="p-3 rounded-xl bg-white/10 hover:bg-white/20 transition">
            <x-icons.star class="w-6 h-6 text-white" />
        </button>

        <button class="p-3 rounded-xl bg-white/10 hover:bg-white/20 transition">
            <x-icons.note class="w-6 h-6 text-white" />
        </button>

        <button class="p-3 rounded-xl bg-white/10 hover:bg-white/20 transition">
            <x-icons.fire class="w-6 h-6 text-white" />
        </button>

        <button class="p-3 rounded-xl bg-white/10 hover:bg-white/20 transition">
            <x-icons.settings class="w-6 h-6 text-white" />
        </button>
    </div>



    {{-- MAIN CONTENT PANEL --}}
    <div class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-10
                w-[650px] rounded-3xl bg-white/20 backdrop-blur-xl 
                shadow-2xl border border-white/20 p-10 text-white">

        {{-- Greeting --}}
        <h1 class="text-4xl font-semibold mb-2">Hey Harvester 👋</h1>
        <p class="text-white/80 mb-8 text-lg">What's on your mind today?</p>


        {{-- Quick Notes --}}
        <h2 class="text-xl font-semibold mb-4">Quick Notes</h2>

        <div class="space-y-4">

            <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-2xl border border-white/20">
                Remember to stay hydrated
            </div>

            <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-2xl border border-white/20">
                Plan the weekend adventure
            </div>

            <div class="p-4 rounded-2xl bg-white/10 border border-white/20 
                        backdrop-blur-xl hover:bg-white/20 cursor-pointer transition">
                + Add a new note
            </div>

        </div>

    </div>



    {{-- STREAK PANEL --}}
    <div class="absolute bottom-20 right-20
                w-[230px] p-5 rounded-2xl bg-white/20 backdrop-blur-xl
                border border-white/20 shadow-xl text-white">

        <div class="flex items-center space-x-3 mb-4">
            <x-icons.fire class="w-7 h-7 text-orange-300" />
            <span class="text-lg font-semibold">12 day streak</span>
        </div>

        <button class="w-full py-2 rounded-xl bg-white/30 hover:bg-white/40 transition">
            Check-in
        </button>
    </div>

</div>
@endsection