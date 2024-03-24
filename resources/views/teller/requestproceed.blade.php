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
                <img src='/image/coinflux.png' class="size-10 mr-24" />
                <div class="flex flex-row">
                    <a href="/teller"
                        class="text-xl px-5 py-2 rounded-full mr-5 border-transparent hover:border-[#292929] border-2 transition ease-in-out duration-300">Home</a>
                    <a href="/teller" class="text-xl px-5 py-2 rounded-full mr-5 bg-[#292929]">Send and Request</a>
                    <a href="/teller"
                        class="text-xl px-5 py-2 rounded-full mr-5 border-transparent hover:border-[#292929] border-2 transition ease-in-out duration-300">Wallet</a>
                    <a href="/teller"
                        class="text-xl px-5 py-2 rounded-full mr-5 border-transparent hover:border-[#292929] border-2 transition ease-in-out duration-300">Activity</a>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="route('logout')" class="text-lg font-semibold leading-6" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    Logout <span aria-hidden="true">&rarr;</span>
                </a>
            </form>
        </div>
        <div class="w-full flex justify-center mt-7">
            <div class="w-5/12 bg-[#1C1C22] rounded-lg flex flex-col justify-center items-center">
                <h1 class="text-lg mt-7">Sender</h1>
                <h1 class="text-2xl mb-16"> {{$teller->email}} </h1>
                <form action="{{ route("teller.transaction-details", $teller->id) }}" method="POST" class="flex flex-col justify-center items-center">
                @csrf
                    <div class="relative">
                        <input type="text"
                            class="peer block min-h-[auto] w-full text-center rounded border-b-2 bg-transparent py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-dark dark:placeholder:text-dark-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-75 text-white text-2xl"
                            id="amount" name="amount" placeholder="0.00" />
                    </div>
                    <input type="hidden" name="process" value="request">
                    <div class="mt-5 bg-neutral-700 px-3.5 py-1 rounded-full">{{$user->branch->currency}}</div>

                    <!--Submit button-->
                    <div class="flex items-center justify-center pb-6 mt-16 mb-7">
                        <button type="submit"
                            class="inline-block pull-right rounded-full bg-[#006699] px-10 pb-2 pt-2.5 text-lg font-medium leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-[#0099CC] hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-[#0099CC] focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]"
                            data-te-ripple-init data-te-ripple-color="light">
                            Next
                        </button>
                    </div>
                </form>

            </div>
        </div>



    </main>
    <script>
        window.userCountry = "{{$user->branch->country_iso_code}}";
        function confirmMessage(){
            alert('Transaction is en-route!');
        }
    </script>
</body>

</html>