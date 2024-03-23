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
                <a href="/teller" class="text-xl px-5 py-2 rounded-full mr-5 border-transparent hover:border-[#292929] border-2 transition ease-in-out duration-300">Home</a>
                <a href="/teller" class="text-xl px-5 py-2 rounded-full mr-5 bg-[#292929]">Send and Request</a>
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
    
    <div class="flex flex-row justify-start mx-52 my-7">
        <a href="/teller-send" class="w-32 py-3 text-xl text-center rounded-full hover:border-[#DD390D] border-transparent border-[1px] transition ease-in-out duration-150 mr-3.5">Send</a>
        <a href="/teller-request" class="w-32 py-3 text-xl text-center mr-3.5 rounded-full hover:border-[#DD390D] border-transparent border-[1px] transition ease-in-out duration-150">Request</a>
        <a href="#" class="w-32 py-3 bg-[#DD390D] text-xl mr-3.5 text-center rounded-full">Contacts</a>
    </div>

    <div class="mx-52 pt-7">
        <h2 class="text-2xl mb-7">Contacts</h2>
        @foreach( $tellers as $cont )
            <a> {{ $cont->first_name }} {{ $cont->middle_name }} {{ $cont->last_name }}</a>
        @endforeach
    </div>



</main>
<script>
</script>
</body>
</html>
