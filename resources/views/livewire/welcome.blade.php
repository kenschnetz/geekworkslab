<x-app-layout>
    <div style="height: 60px !important;">
        <p class="p-3 text-white text-right">
            <a href="{{ route('login') }}" class="text-sm text-white underline">Log in</a>
        </p>
    </div>
    <div class="flex flex-wrap content-center justify-center" style="height: 100vh !important; background-image: url('/storage/img/forge-bg.jpg') !important; background-size: cover !important; background-position: center center !important; background-repeat: no-repeat !important; margin-top: -60px !important;">
        <div class="bg-white rounded">
            <img src="/storage/img/logo.png" style="height: 80px">
        </div>
    </div>
    <div style="height: 120px !important; margin-top: -120px !important;">
        <p class="px-3 text-sm text-white text-center">
            This application is currently in closed Beta. If you would like to join, please email your request to <a class="underline" href="mailto:contact@geekworksstudios.com">contact@geekworksstudios.com</a>
        </p>
        <p class="p-3 text-sm text-white text-center">
            <a href="{{ route('terms') }}" target="_blank" class="text-white underline">Terms And Conditions</a>
        </p>
    </div>
</x-app-layout>
