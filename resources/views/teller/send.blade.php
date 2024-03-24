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
                <a href="/teller-send" class="text-xl px-5 py-2 rounded-full mr-5 bg-[#292929]">Send and Request</a>
                <a href="/teller-wallet" class="text-xl px-5 py-2 rounded-full mr-5 border-transparent hover:border-[#292929] border-2 transition ease-in-out duration-300">Wallet</a>
                <a href="/teller-activity" class="text-xl px-5 py-2 rounded-full mr-5 border-transparent hover:border-[#292929] border-2 transition ease-in-out duration-300">Activity</a>
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
        <a href="#" class="w-32 py-3 bg-[#DD390D] text-xl mr-3.5 text-center rounded-full">Send</a>
        <a href="/teller-request" class="w-32 py-3 text-xl text-center rounded-full hover:border-[#DD390D] border-transparent border-[1px] transition ease-in-out duration-150 mr-3.5">Request</a>
        <a href="{{ route("teller.contacts") }}" class="w-32 py-3 text-xl text-center rounded-full hover:border-[#DD390D] border-transparent border-[1px] transition ease-in-out duration-150">Contacts</a>
    </div>

    <div class="mx-52 pt-7">
        <h2 class="text-2xl mb-7">Send payment to</h2>
        <form action="">
            <div class="relative w-5/12" data-te-input-wrapper-init>
                <input type="text"
                class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-dark dark:placeholder:text-dark-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                id="last_name" name="last_name" placeholder="Email Address"/>
                <label for="last_name"
                class="pointer-events-none absolute left-3 top-0 mb-0 origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-400 dark:peer-focus:text-primary">
                Email Address (ex. @gmail.com)
                </label>
            </div>
            <!--Submit button-->
            <div class="flex items-center justify-start pb-6 mt-7">
                <button type="submit"
                class="inline-block pull-right rounded-full bg-[#006699] px-10 pb-2 mr-3.5 pt-2.5 text-lg font-medium leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-[#0099CC] hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-[#0099CC] focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]"
                data-te-ripple-init data-te-ripple-color="light">
                Next
                </button>
            </div>
        </form>
    </div>



</main>
<script>
</script>
</body>
</html>
