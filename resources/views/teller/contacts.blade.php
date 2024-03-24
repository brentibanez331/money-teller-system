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

    <div class="w-7/12 mx-52">
    <h2 class="text-2xl mb-3.5">Contacts</h2>
    <p class="mb-7">Your Location: {{ $user->branch->country_iso_code }}</p>
    <table
                class="min-w-full text-sm font-light dark:border-neutral-500">
                    <thead class="font-medium dark:border-neutral-500">
                        <tr>
                            <th
                                scope="col"
                                class=" text-left dark:border-neutral-500 pb-3.5 pl-4">
                                NAME
                            </th>
                            <th
                                scope="col"
                                class=" text-left dark:border-neutral-500 pb-3.5">
                                LOCATION
                            </th>
                            <th
                                scope="col"
                                class=" text-left dark:border-neutral-500 pb-3.5">
                                BRANCH
                            </th>
                            <th
                                scope="col"
                                class=" text-left dark:border-neutral-500 pb-3.5">
                                COUNTRY
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tellers as $cont)
                        
                            <tr class="border-t border-b border-neutral-300 ease-in-out hover:bg-[#1a1a1a]">
                                <td class="flex flex-col whitespace-nowrap px-4 py-4 dark:border-neutral-500">
                                    <a href="">
                                        <div class="mb-0.5 text-xl">
                                            {{ $cont->first_name }} {{ $cont->middle_name}} {{$cont->last_name}}
                                        </div>
                                        <div class="font-bold text-blue-200">
                                            {{ $cont->email }}
                                        </div>
                                    </a>
                                </td>
                                <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                                <p class="flex items-end">
                                    @if($user->branch->country_iso_code == $cont->branch->country_iso_code) 
                                        Local
                                    @else
                                        International
                                    @endif
                                </p>
                                </td>
                                
                                <td class="whitespace-nowrap py-4 dark:border-neutral-500">{{ $cont->branch->branch_name ?? '' }}</td>
                                <td class="whitespace-nowrap py-4 dark:border-neutral-500 pr-14">{{ $cont->branch->country_iso_code ?? '' }}</td>
                                <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                                    <a href="{{route("teller.sendmoney", $cont->id)}}" class="text-success-500 text-lg hover:text-success-200 transition ease-in-out duration-150">Send &uarr;</a>
                                </td>
                                <td class="whitespace-nowrap py-4 dark:border-neutral-500">
                                    <a href="{{route("teller.requestmoney", $cont->id)}}" class="text-blue-400 text-lg hover:text-blue-200 transition ease-in-out duration-150">Request &darr;</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    </div>



</main>
</body>
</html>
