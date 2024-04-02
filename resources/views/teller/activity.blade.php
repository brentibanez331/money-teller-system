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
                <img src='/image/coinflux.png' class="size-10 mr-24" />
                <div class="flex flex-row">
                    <a href="/teller"
                        class="text-xl px-5 py-2 rounded-full mr-5 border-transparent hover:border-[#292929] border-2 transition ease-in-out duration-300">Home</a>
                    <a href="/teller-contacts"
                        class="text-xl px-5 py-2 rounded-full mr-5 border-transparent hover:border-[#292929] border-2 transition ease-in-out duration-300">Send
                        and Request</a>
                    <a href="/teller-activity" class="text-xl px-5 py-2 rounded-full mr-5 bg-[#292929]">Activity</a>
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

        <div class="w-7/12 mx-52 my-7">
            <p class="mb-7">Your Location: {{ $user->branch->country_iso_code }}</p>
            <h2 class="text-2xl mb-3.5">Send History</h2>

            @if($transactions->isEmpty())
                <p>You haven't done any transactions... :(</p>
            @else
            <table class="min-w-full text-sm font-light dark:border-neutral-500">
                <thead class="font-medium dark:border-neutral-500">
                    <tr>
                        <th scope="col" class=" text-left dark:border-neutral-500 pb-3.5 pl-4">
                            RECIPIENT
                        </th>
                        <th scope="col" class=" text-left dark:border-neutral-500 pb-3.5">
                            AMOUNT
                        </th>
                        <th scope="col" class=" text-left dark:border-neutral-500 pb-3.5">
                            STATUS
                        </th>
                        <th scope="col" class=" text-left dark:border-neutral-500 pb-3.5">
                            DATE TIME (UTC)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $cont)
                    @if($cont->sender_contact == $user->email && $cont->transaction_status == "COMPLETED")
                    <tr class="border-t border-b border-neutral-300 ease-in-out hover:bg-[#1a1a1a]">
                        <td class="flex flex-col whitespace-nowrap px-4 py-4 dark:border-neutral-500">
                            <a href="">
                                <div class="mb-0.5 text-xl">
                                    {{ $cont->receiver->first_name }} {{ $cont->receiver->middle_name}}
                                    {{$cont->receiver->last_name}}
                                </div>
                                <div class="font-bold text-blue-200">
                                    {{ $cont->recipient_contact }}
                                </div>
                            </a>
                        </td>
                        <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                            <p>
                                @if($user->branch->currency == $cont->currency_conversion_code)
                                {{ $cont->amount_converted }} <span class="text-xs"> {{ $cont->currency_conversion_code
                                    }}</span>
                                @else
                                {{ $cont->amount_local_currency }} <span class="text-xs"> {{ $cont->original_currency
                                    }}</span>
                                @endif
                            </p>
                        </td>

                        <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                            @if($cont->transaction_status == "PENDING")
                            <p class="text-warning-400">PENDING</p>
                            @elseif($cont->transaction_status == "COMPLETED")
                            <p class="text-success-400">COMPLETED</p>
                            @elseif($cont->transaction_status == "CANCELLED")
                            <p class="text-danger-400">CANCELLED</p>
                            @endif
                        </td>
                        <td class="whitespace-nowrap py-4 dark:border-neutral-500 pr-14">{{ $cont->datetime_transaction
                            }}</td>
                        <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                            <form action="{{ route('teller.deletetransaction',$cont->id) }}" method="GET"
                                onsubmit="return confirm('{{ trans('Are you sure you want to delete this ? ') }}');">
                                @csrf
                                <button type="submit" class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 text-danger-600 hover:text-danger-800 cursor-pointer" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @endif

            <h2 class="text-2xl mb-3.5 mt-20">Requests from Contacts</h2>
            @if($transactions->isEmpty())
                <p>You haven't done any transactions... :(</p>
            @else
            <table class="min-w-full text-sm font-light dark:border-neutral-500">
                <thead class="font-medium dark:border-neutral-500">
                    <tr>
                        <th scope="col" class=" text-left dark:border-neutral-500 pb-3.5 pl-4">
                            REQUESTOR
                        </th>
                        <th scope="col" class=" text-left dark:border-neutral-500 pb-3.5">
                            AMOUNT
                        </th>
                        <th scope="col" class=" text-left dark:border-neutral-500 pb-3.5">
                            STATUS
                        </th>
                        <th scope="col" class=" text-left dark:border-neutral-500 pb-3.5">
                            DATE TIME (UTC)
                        </th>
                        
                        <th scope="col" class="text-left dark:border-neutral-500 pb-3.5" colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $cont)
                    @if($cont->sender_contact == $user->email && ($cont->transaction_status == "PENDING" || $cont->transaction_status == "CANCELLED"))
                    <tr class="border-t border-b border-neutral-300 ease-in-out hover:bg-[#1a1a1a]">
                        <td class="flex flex-col whitespace-nowrap px-4 py-4 dark:border-neutral-500">
                            <a href="">
                                <div class="mb-0.5 text-xl">
                                    {{ $cont->receiver->first_name }} {{ $cont->receiver->middle_name}}
                                    {{$cont->receiver->last_name}}
                                </div>
                                <div class="font-bold text-blue-200">
                                    {{ $cont->recipient_contact }}
                                </div>
                            </a>
                        </td>
                        <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                            <p>
                                {{ $cont->amount_converted}} <span class="text-xs"> {{ $cont->currency_conversion_code
                                    }}</span>
                            </p>
                        </td>

                        <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                            @if($cont->transaction_status == "PENDING")
                            <p class="text-warning-400">PENDING</p>
                            @elseif($cont->transaction_status == "COMPLETED")
                            <p class="text-success-400">COMPLETED</p>
                            @elseif($cont->transaction_status == "CANCELLED")
                            <p class="text-danger-400">CANCELLED</p>
                            @endif
                        </td>
                        <td class="whitespace-nowrap py-4 dark:border-neutral-500 pr-14">{{ $cont->datetime_transaction
                            }}</td>
                        @if($cont->transaction_status == "CANCELLED")
                        <td class="whitespace-nowrap py-4 dark:border-neutral-500"></td>
                        <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                            <form action="{{ route('teller.deletetransaction',$cont->id) }}" method="GET"
                                onsubmit="return confirm('{{ trans('Are you sure you want to delete this ? ') }}');">
                                @csrf
                                <button type="submit" class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 text-danger-600 hover:text-danger-800 cursor-pointer" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </td>

                        @else
                        <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                            <form action="{{ route('teller.updatetransaction', $cont->receiver->id) }}" method="GET">
                                @csrf
                                <input type="hidden" name="status" value="COMPLETED">
                                <input type="hidden" name="receiver" value="{{$cont->recepient_contact}}">
                                <input type="hidden" name="sender" value="{{$cont->sender_contact}}">
                                <input type="hidden" name="senderAmount" value="{{$cont->amount_local_currency}}">
                                <input type="hidden" name="receiverAmount" value="{{$cont->amount_converted}}">
                                <input type="hidden" name="transID" value="{{$cont->id}}">
                                <button type="submit" class="flex items-center">
                                    <p class="text-success text-xl rounded-full border-[1px] border-success px-1.5 hover:bg-success-600 hover:text-white transition ease-in-out duration-150">&#10004;</p>
                                    
                                </button>
                            </form>
                        </td>
                        <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                            <form action="{{ route('teller.updatetransaction', $cont->receiver->id) }}" method="GET">
                                @csrf
                                <input type="hidden" name="status" value="CANCELLED">
                                <input type="hidden" name="transID" value="{{$cont->id}}">
                                <button type="submit" class="flex items-center">
                                    <p class="text-danger text-xl rounded-full border-[1px] border-danger px-1.5 hover:bg-danger-600 hover:text-white transition ease-in-out duration-150">&#10006;</p>
                                    
                                </button>
                            </form>
                        </td>
                        @endif
                        
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @endif

            <h2 class="text-2xl mb-3.5 mt-20">Money Received and Requests</h2>
            @if($transactions->isEmpty())
                <p>You haven't done any transactions... :(</p>
            @else
            <table class="min-w-full text-sm font-light dark:border-neutral-500">
                <thead class="font-medium dark:border-neutral-500">
                    <tr>
                        <th scope="col" class=" text-left dark:border-neutral-500 pb-3.5 pl-4">
                            SENDER
                        </th>
                        <th scope="col" class=" text-left dark:border-neutral-500 pb-3.5">
                            AMOUNT
                        </th>
                        <th scope="col" class=" text-left dark:border-neutral-500 pb-3.5">
                            STATUS
                        </th>
                        <th scope="col" class=" text-left dark:border-neutral-500 pb-3.5">
                            DATE TIME (UTC)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $cont)
                    @if($cont->sender_contact != $user->email)
                    <tr class="border-t border-b border-neutral-300 ease-in-out hover:bg-[#1a1a1a]">
                        <td class="flex flex-col whitespace-nowrap px-4 py-4 dark:border-neutral-500">
                            <a href="">
                                <div class="mb-0.5 text-xl">
                                    {{ $cont->sender->first_name }} {{ $cont->sender->middle_name}}
                                    {{$cont->sender->last_name}}
                                </div>
                                <div class="font-bold text-blue-200">
                                    {{ $cont->sender_contact }}
                                </div>
                            </a>
                        </td>
                        <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                            <p>
                                @if($user->branch->currency == $cont->currency_conversion_code)
                                {{ $cont->amount_converted }} <span class="text-xs"> {{ $cont->currency_conversion_code
                                    }}</span>
                                @else
                                {{ $cont->amount_local_currency }} <span class="text-xs"> {{ $cont->original_currency
                                    }}</span>
                                @endif
                                
                            </p>
                        </td>

                        <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                            @if($cont->transaction_status == "PENDING")
                            <p class="text-warning-400">PENDING</p>
                            @elseif($cont->transaction_status == "COMPLETED")
                            <p class="text-success-400">COMPLETED</p>
                            @elseif($cont->transaction_status == "CANCELLED")
                            <p class="text-danger-400">CANCELLED</p>
                            @endif
                        </td>
                        <td class="whitespace-nowrap py-4 dark:border-neutral-500 pr-14">{{ $cont->datetime_transaction
                            }}</td>
                        <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                            <form action="{{ route('teller.deletetransaction',$cont->id) }}" method="GET"
                                onsubmit="return confirm('{{ trans('Are you sure you want to delete this ? ') }}');">
                                @csrf
                                <button type="submit" class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 text-danger-600 hover:text-danger-800 cursor-pointer" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @endif

        </div>



    </main>
</body>

</html>