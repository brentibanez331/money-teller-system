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
                    <a href="/teller" class="text-xl px-5 py-2 rounded-full mr-5 bg-[#292929]">Home</a>
                    <a href="/teller-send"
                        class="text-xl px-5 py-2 rounded-full mr-5 border-transparent hover:border-[#292929] border-2 transition ease-in-out duration-300">Send
                        and Request</a>
                    <a href="/teller-wallet"
                        class="text-xl px-5 py-2 rounded-full mr-5 border-transparent hover:border-[#292929] border-2 transition ease-in-out duration-300">Wallet</a>
                    <a href="{{ route("teller.activity") }}"
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
        <div class="flex flex-row mx-52 my-10 justify-between">
            <div class="w-7/12 pr-7">
                <div class="mb-7">
                    <h1 class="text-5xl mb-10">Welcome {{$user->first_name}}</h1>
                    <p class="text-xl">{{$user->branch->country_iso_code}} Time</p>
                    <p class="text-3xl font-bold"><span id="time"></span></p>
                    <p class="text-3xl"><span id="date"></span></p>
                </div>
                <div class="bg-[#1C1C22] p-6 rounded-lg border-neutral-700 border-[1px]">
                    <h3 class="text-2xl mb-5">Coinflux Balance</h3>
                    <h3 class="text-5xl mb-2"><span id="currency"></span> {{$user->balance}} <span></span></h3>
                    <h3 class="text-md mb-3.5">Available</h3>

                </div>
            </div>
            <div class="w-5/12">
                <div class="flex flex-row mb-9">
                    <div
                        class="text-2xl bg-[#DD390D] py-2 rounded-full h-12 w-52 items-center flex justify-center mr-3.5 hover:bg-[#DB532E] transition ease-in-out duration-300 hover:cursor-pointer">
                        <a href="">Send</a>
                    </div>
                    <div
                        class="text-2xl border-[#DD390D] py-2 border-[1px] rounded-full h-12 w-52 items-center flex justify-center hover:bg-[#DD390D] transition ease-int-out duration-300 hover:cursor-pointer">
                        <a href="/teller-request">Request</a>
                    </div>
                </div>
                <div class="bg-[#1C1C22] p-6 rounded-lg border-neutral-700 border-[1px]">
                    <h3 class="text-2xl mb-5">Recent Activity</h3>
                    <h3 class="text-xl mb-5">Send History</h3>
                    @foreach ($transactions as $trans)
                    @if($trans->sender_contact == $user->email && $trans->transaction_status == "COMPLETED")
                    <div class="w-full flex justify-between rounded-md bg-[#232329] border-[1px] border-[#303036] p-3 mb-2">
                        <div class="">
                            <h3 class="text-lg">{{ $trans->receiver->first_name }} {{ $trans->receiver->middle_name }} {{
                                $trans->receiver->last_name }}</h3>
                            <h3>{{ $trans->recipient_contact }}</h3>
                        </div>
                        <div class="text-end">
                            @if($user->branch->currency == $trans->currency_conversion_code)
                            <h2 class="text-2xl">{{ $trans->amount_converted }} <span class="text-sm">{{ $trans->currency_conversion_code }}</span></h2>
                                @else
                                <h2 class="text-2xl">{{ $trans->amount_local_currency }} <span class="text-sm">{{ $trans->original_currency }}</span></h2>
                                @endif
                            
                            @if($trans->transaction_status == "PENDING")
                                <p class="text-warning-400">PENDING</p>
                            @elseif($trans->transaction_status == "COMPLETED")
                                <p class="text-success-400">COMPLETED</p>
                            @elseif($trans->transaction_status == "CANCELLED")
                                <p class="text-danger-400">CANCELLED</p>
                            @endif
                            
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <h3 class="text-xl mb-5 mt-10">Requests from Contacts</h3>
                    @foreach ($transactions as $trans)
                    @if($trans->sender_contact == $user->email && ($trans->transaction_status == "PENDING" || $trans->transaction_status == "CANCELLED"))
                    <div class="w-full flex justify-between rounded-md bg-[#232329] border-[1px] border-[#303036] p-3 mb-2">
                        <div class="">
                            <h3 class="text-lg">{{ $trans->receiver->first_name }} {{ $trans->receiver->middle_name }} {{
                                $trans->receiver->last_name }}</h3>
                            <h3>{{ $trans->recipient_contact }}</h3>
                        </div>
                        <div class="text-end">
                            @if($user->branch->currency == $trans->currency_conversion_code)
                                <h2 class="text-2xl">{{ $trans->amount_converted }} <span class="text-sm">{{ $trans->currency_conversion_code }}</span></h2>
                            @else
                                <h2 class="text-2xl">{{ $trans->amount_local_currency }} <span class="text-sm">{{ $trans->original_currency }}</span></h2>
                            @endif
                            
                            @if($trans->transaction_status == "PENDING")
                                <p class="text-warning-400">PENDING</p>
                            @elseif($trans->transaction_status == "COMPLETED")
                                <p class="text-success-400">COMPLETED</p>
                            @elseif($trans->transaction_status == "CANCELLED")
                                <p class="text-danger-400">CANCELLED</p>
                            @endif
                            
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <h3 class="text-xl mb-5 mt-10">Your Requests</h3>
                    @foreach ($transactions as $trans)
                    @if($trans->sender_contact != $user->email)
                    <div class="w-full flex justify-between rounded-md bg-[#232329] border-[1px] border-[#303036] p-3 mb-2">
                        <div class="">
                            <h3 class="text-lg">{{ $trans->sender->first_name }} {{ $trans->sender->middle_name }} {{
                                $trans->sender->last_name }}</h3>
                            <h3>{{ $trans->sender_contact }}</h3>
                        </div>
                        <div class="text-end">
                            @if($user->branch->currency == $trans->currency_conversion_code)
                            <h2 class="text-2xl">{{ $trans->amount_converted }} <span class="text-sm">{{ $trans->currency_conversion_code }}</span></h2>
                                @else
                                <h2 class="text-2xl">{{ $trans->amount_local_currency }} <span class="text-sm">{{ $trans->original_currency }}</span></h2>
                                @endif
                            
                            
                            @if($trans->transaction_status == "PENDING")
                                <p class="text-warning-400">PENDING</p>
                            @elseif($trans->transaction_status == "COMPLETED")
                                <p class="text-success-400">COMPLETED</p>
                            @elseif($trans->transaction_status == "CANCELLED")
                                <p class="text-danger-400">CANCELLED</p>
                            @endif
                            
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <!-- <h3 class="text-5xl mb-2"><span id="currency"></span> {{$user->balance}}.00 <span></span></h3> -->
                    <!-- <h3 class="text-md mb-3.5">Available</h3> -->
                </div>
            </div>
        </div>



    </main>
    <script>
        window.userCountry = "{{$user->branch->country_iso_code}}";
    </script>
</body>

</html>