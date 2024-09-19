<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @method('PUT')
                        @csrf
                
                        <!-- First Name -->
                        <div  class="mt-4">
                            <x-input-label for="name" :value="__('First Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                                <!-- Last Name -->
                                <div  class="mt-4">
                                    <x-input-label for="name" :value="__('Last Name')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name" />
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>
                
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                
                        <div class="flex items-center justify-end mt-4">

                            <x-primary-button class="ms-4">
                                {{ __('Update User') }}
                            </x-primary-button>
                        </div>
                    </form>
</div>
            </div>
        </div>
    </div>
</x-app-layout>
