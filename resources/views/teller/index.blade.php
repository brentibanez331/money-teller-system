<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="text-white bg-[#161513]">
<main>
    <div class="px-52 flex flex-row items-center py-7 justify-between">
        <div class="flex flex-row items-center">
            <!-- <h1 class="font-bold text-3xl py-10 pr-32">CashFlow</h1> -->
            <img src='/image/coinflux.png' class="size-10 mr-24"/>
            <div class="flex flex-row">
                <a href="/teller" class="text-xl px-5 py-2 rounded-full mr-5 bg-[#292929]">Home</a>
                <a href="/teller-send" class="text-xl px-5 py-2 rounded-full mr-5 border-transparent hover:border-[#292929] border-2 transition ease-in-out duration-300">Send and Request</a>
                <a href="/teller" class="text-xl px-5 py-2 rounded-full mr-5 border-transparent hover:border-[#292929] border-2 transition ease-in-out duration-300">Wallet</a>
                <a href="/teller" class="text-xl px-5 py-2 rounded-full mr-5 border-transparent hover:border-[#292929] border-2 transition ease-in-out duration-300">Activity</a>
            </div>
        </div>    
        
        <form method="POST" action="{{ route('logout') }}">
        @csrf
            <a href="route('logout')" class="text-lg font-semibold leading-6"
                       onclick="event.preventDefault();
                                    this.closest('form').submit();">
                Logout <span aria-hidden="true">&rarr;</span>
            </a>
        </form>
    </div>
    <div class="flex flex-row mx-52 my-10 justify-between">
        <div class="w-7/12 pr-7">
            <div class="mb-7">
                <h1 class="text-5xl mb-10">Welcome {{$user->first_name}}</h1>
                <p class="text-3xl">{{$user->branch->country_iso_code}} Time</p>
                <p class="text-3xl font-bold"><span id="time"></span></p>
                <p class="text-3xl"><span id="date"></span></p>      
            </div>
            <div class="bg-[#1C1C22] p-6 rounded-lg border-neutral-700 border-[1px]">
                <h3 class="text-2xl mb-5">Coinflux Balance</h3>
                <h3 class="text-5xl mb-2"><span id="currency"></span> {{$user->balance}}.00 <span></span></h3>
                <h3 class="text-md mb-3.5">Available</h3>

            </div>
        </div>
        <div class="w-5/12">
            <div class="flex flex-row mb-9">
                <div class="text-2xl bg-[#DD390D] py-2 rounded-full h-12 w-52 items-center flex justify-center mr-3.5 hover:bg-[#DB532E] transition ease-in-out duration-300 hover:cursor-pointer">
                    <a href="">Send</a>
                </div>
                <div class="text-2xl border-[#DD390D] py-2 border-[1px] rounded-full h-12 w-52 items-center flex justify-center hover:bg-[#DD390D] transition ease-int-out duration-300 hover:cursor-pointer">
                    <a href="/teller-request">Request</a>
                </div>
            </div>
            <div class="bg-[#1C1C22] p-6 rounded-lg border-neutral-700 border-[1px]">
                <h3 class="text-2xl mb-5">Recent Activity</h3>
                <!-- <h3 class="text-5xl mb-2"><span id="currency"></span> {{$user->balance}}.00 <span></span></h3> -->
                <!-- <h3 class="text-md mb-3.5">Available</h3> -->
            </div>
        </div>
    </div>
    
    <div class="h-screen">
        <div class="bg-[#1C1C22]">
            
        </div>
    </div>



</main>
<script>
    window.userCountry = "{{$user->branch->country_iso_code}}";
</script>
</body>
</html>
