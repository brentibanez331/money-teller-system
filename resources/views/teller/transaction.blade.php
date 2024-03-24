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
            <div class="w-5/12 bg-[#1C1C22] rounded-lg flex flex-col justify-center px-24">
                <h1 class="text-3xl mt-7 text-center">Transaction Details</h1>
                <p class="text-2xl text-center text-success-200">
                    
                    @if($user->branch->country_iso_code == $teller->branch->country_iso_code)
                        Local
                    @else
                        International
                    @endif
                </p>
                <div class="mt-16 mb-16 text-center">
                    <p>Amount</p>
                    <p class="text-4xl">
                        {{ $amount }} <span class="text-2xl">{{ $user->branch->currency }}</span> 
                        @if($user->branch->currency != $teller->branch->currency)
                        = {{$newAmount}} <span class="text-2xl">{{ $teller->branch->currency }}</span>
                        @endif
                    </p>
                    <p>Fee: {{ $newRate }} {{ $user->branch->currency }}</p>
                    
                </div>

                <div class="mb-16 text-center">
                    <p>Total Amount</p>
                    <p class="text-4xl">
                        {{ $totalAmount }} <span class="text-2xl">{{ $user->branch->currency }}</span>
                    </p>
                    
                </div>

                <h1 class="text-2xl mb-7"></h1>
                <div class="flex w-full">
                    <div class="w-1/2">
                        <div class="mt-4 border-b-2 pb-2 border-neutral-700">
                            <strong>Sender:</strong>
                            <p>{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</p>
                        </div>
                        <div class="mt-4 border-b-2 pb-2 border-neutral-700">
                            <strong>Recipient:</strong>
                            <p>{{$teller->first_name}} {{$teller->middle_name}} {{$teller->last_name}}</p>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div class="mt-4 border-b-2 pb-2 border-neutral-700">
                            <strong>Email Address:</strong>
                            <p>{{$user->email}}</p>
                        </div>
                        <div class="mt-4 border-b-2 pb-2 border-neutral-700">
                            <strong>Email Address:</strong>
                            <p>{{$teller->email}}</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex w-full">
                    <div class="w-1/2">
                        <div class="mt-4">
                            <strong>Branch Sent:</strong>
                            <p>{{$user->branch->branch_name}}</p>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div class="mt-4">
                            <strong>Branch Recipient:</strong>
                            <p>{{$teller->branch->branch_name}}</p>
                        </div>
                    </div>
                </div>
                <div class="flex mt-24 justify-center mb-10">
                    <form method="POST" action="{{route('teller.storetransaction', $teller->id)}}">
                        @csrf 
                        <input type="hidden" name="rateID" value="{{ $rateID }}">
                        <input type="hidden" name="totalAmount" value="{{ $totalAmount }}">
                        <input type="hidden" name="amount" value="{{ $amount }}">
                        <input type="hidden" name="newAmount" value="{{ $newAmount }}">
                        <input type="hidden" name="process" value="send">
                        <button type="submit" class="w-32 bg-success text-center mx-3 py-2 rounded-full hover:bg-success-600 transition ease-in-out duration-150">CONFIRM</button>    
                    </form>
                    <a href="" class="w-32 bg-danger text-center mx-3 py-2 rounded-full hover:bg-danger-600 transition ease-in-out duration-150">CANCEL</a>
                </div>
            </div>
        </div>



    </main>
    <script>
        window.userCountry = "{{$user->branch->country_iso_code}}";
    </script>
</body>

</html>