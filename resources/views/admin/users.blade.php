<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-[#161513] text-white">
<main>
    <div class="border-b-2 border-[#292929] px-10 flex flex-row items-center justify-between">    
        <div class="py-3 flex items-center">
            <img src="/image/coinflux.png" width="43" class="mr-3.5"/>
            <p class="text-3xl font-bold">Coinflux</p>
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
    
    <div class="flex flex-row justify-start">
        <div class="w-64 h-screen border-solid border-r-2 border-[#292929]">
            <ul>
                <li class="px-10 py-3.5 hover:bg-[#292929] transition ease-in-out duration-150 border-b-2 border-[#292929] flex flex-row items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M156.6 384.9L125.7 354c-8.5-8.5-11.5-20.8-7.7-32.2c3-8.9 7-20.5 11.8-33.8L24 288c-8.6 0-16.6-4.6-20.9-12.1s-4.2-16.7 .2-24.1l52.5-88.5c13-21.9 36.5-35.3 61.9-35.3l82.3 0c2.4-4 4.8-7.7 7.2-11.3C289.1-4.1 411.1-8.1 483.9 5.3c11.6 2.1 20.6 11.2 22.8 22.8c13.4 72.9 9.3 194.8-111.4 276.7c-3.5 2.4-7.3 4.8-11.3 7.2v82.3c0 25.4-13.4 49-35.3 61.9l-88.5 52.5c-7.4 4.4-16.6 4.5-24.1 .2s-12.1-12.2-12.1-20.9V380.8c-14.1 4.9-26.4 8.9-35.7 11.9c-11.2 3.6-23.4 .5-31.8-7.8zM384 168a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"/></svg>
                    <a href="/admin" class="ml-3.5">Dashboard</a>
                </li>
                <li class="px-6 py-3.5 duration-150 font-bold">Management</li>

                <li class="px-10 py-3.5 bg-[#292929] transition ease-in-out duration-150 flex flex-row items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-5"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                    <a href="/admin-users" class="ml-5">Users</a>
                </li>

                <li class="px-10 py-3.5 hover:bg-[#292929] transition ease-in-out duration-150 flex flex-row items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-5"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M80 104a24 24 0 1 0 0-48 24 24 0 1 0 0 48zm80-24c0 32.8-19.7 61-48 73.3v87.8c18.8-10.9 40.7-17.1 64-17.1h96c35.3 0 64-28.7 64-64v-6.7C307.7 141 288 112.8 288 80c0-44.2 35.8-80 80-80s80 35.8 80 80c0 32.8-19.7 61-48 73.3V160c0 70.7-57.3 128-128 128H176c-35.3 0-64 28.7-64 64v6.7c28.3 12.3 48 40.5 48 73.3c0 44.2-35.8 80-80 80s-80-35.8-80-80c0-32.8 19.7-61 48-73.3V352 153.3C19.7 141 0 112.8 0 80C0 35.8 35.8 0 80 0s80 35.8 80 80zm232 0a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zM80 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>
                    <a href="/admin-branches" class="ml-5">Branches</a>
                </li>

                <li class="px-10 py-3.5 hover:bg-[#292929] transition ease-in-out duration-150 flex flex-row items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/></svg>
                    <a href="/admin-transactions" class="ml-5">Transactions</a>
                </li>

                <li class="px-10 py-3.5 hover:bg-[#292929] transition ease-in-out duration-150 flex flex-row items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-6"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M64 64C28.7 64 0 92.7 0 128V384c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H64zM272 192H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H272c-8.8 0-16-7.2-16-16s7.2-16 16-16zM256 304c0-8.8 7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H272c-8.8 0-16-7.2-16-16zM164 152v13.9c7.5 1.2 14.6 2.9 21.1 4.7c10.7 2.8 17 13.8 14.2 24.5s-13.8 17-24.5 14.2c-11-2.9-21.6-5-31.2-5.2c-7.9-.1-16 1.8-21.5 5c-4.8 2.8-6.2 5.6-6.2 9.3c0 1.8 .1 3.5 5.3 6.7c6.3 3.8 15.5 6.7 28.3 10.5l.7 .2c11.2 3.4 25.6 7.7 37.1 15c12.9 8.1 24.3 21.3 24.6 41.6c.3 20.9-10.5 36.1-24.8 45c-7.2 4.5-15.2 7.3-23.2 9V360c0 11-9 20-20 20s-20-9-20-20V345.4c-10.3-2.2-20-5.5-28.2-8.4l0 0 0 0c-2.1-.7-4.1-1.4-6.1-2.1c-10.5-3.5-16.1-14.8-12.6-25.3s14.8-16.1 25.3-12.6c2.5 .8 4.9 1.7 7.2 2.4c13.6 4.6 24 8.1 35.1 8.5c8.6 .3 16.5-1.6 21.4-4.7c4.1-2.5 6-5.5 5.9-10.5c0-2.9-.8-5-5.9-8.2c-6.3-4-15.4-6.9-28-10.7l-1.7-.5c-10.9-3.3-24.6-7.4-35.6-14c-12.7-7.7-24.6-20.5-24.7-40.7c-.1-21.1 11.8-35.7 25.8-43.9c6.9-4.1 14.5-6.8 22.2-8.5V152c0-11 9-20 20-20s20 9 20 20z"/></svg>
                    <a href="/admin-fees" class="ml-5">Transactions Fees</a>
                </li>
            </ul>
        </div>
        <div class="w-full h-screen bg-[#161513]">
        <div class="m-7">
            <h2 class="text-3xl font-bold mb-7">Welcome Admin!</h2>
            <div class="w-full flex justify-end">
                <a href="/admin-adduser" class="bg-[#7bafed] hover:bg-[#8ebbed] transition ease-in-out duration-150 p-2 rounded-md mb-7 text-white"><strong>+</strong> Add New User</a>
            </div>
            <div class="border border-neutral-600 p-10 rounded-md bg-[#1C1C22]">
            <table
                class="min-w-full text-sm font-light dark:border-neutral-500">
                    <thead class="border-b-2 font-medium dark:border-neutral-500">
                        <tr>
                            <th
                                scope="col"
                                class=" text-left dark:border-neutral-500 pb-3.5 pl-4">
                                NAME
                            </th>
                            <th
                                scope="col"
                                class=" text-left dark:border-neutral-500 pb-3.5">
                                ROLE
                            </th>
                            <th scope="col" class="text-left dark:border-neutral-500 pb-3.5">BRANCH</th>
                            <th scope="col" class="text-left dark:border-neutral-500 pb-3.5">ADDRESS</th>
                            <th scope="col" class="text-left dark:border-neutral-500 pb-3.5" colspan="2">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $cont)
                            <tr class="border-b border-neutral-600 ease-in-out hover:bg-[#191919]">
                                <td class="flex flex-col whitespace-nowrap px-4 py-4 dark:border-neutral-500">
                                    <div class="mb-0.5">
                                        {{ $cont->first_name }} {{ $cont->middle_name}} {{$cont->last_name}}
                                    </div>
                                    <div class="font-bold text-blue-400">
                                        {{ $cont->email }}
                                    </div>
                                
                                </td>
                                <td class="whitespace-nowrap py-4 dark:border-neutral-500 capitalize">
                                {{ $cont->userType->user_type ?? '' }}
                                </td>
                                <td class="whitespace-nowrap py-4 dark:border-neutral-500">{{ $cont->branch->branch_name ?? '' }}</td>
                                <td class="whitespace-nowrap py-4 dark:border-neutral-500">{{ $cont->full_address }}</td>
                                <td
                                    class="whitespace-nowrap py-4 dark:border-neutral-500 ">
                                    <a href="{{ route('admin.edituser', ['id' => $cont->id] ) }}"
                                        class="text-indigo-600 hover:text-indigo-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                </td>
                                
                                <td
                                    class="whitespace-nowrap px-6 py-4 dark:border-neutral-500 ">
                                    @if($cont->id != $user->id)
                                    <form action="{{ route('admin.deleteuser',$cont->id) }}" method="GET" onsubmit="return confirm('{{ trans('Are you sure you want to delete this ? ') }}');">
                                        @csrf
                                        <button type="submit" class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-6 h-6 text-red-600 hover:text-red-800 cursor-pointer" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                    </form>
                                    @endif
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                
        </div>
        

        </div>
        
    </div>
</main>
</body>
</html>
