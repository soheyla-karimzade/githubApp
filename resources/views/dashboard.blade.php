<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <h1 class="p-2">{{auth()->user()->username }}</h1>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">

                </div>

                    <!-- Session Status -->
            <div  class="p-6 w-full  bg-black" >

                <div  class="p-6 w-full  bg-black" >
                    <b>Creating a personal access token in your github and insert this form </b>
                    <div class="mt-8">
                        <form method="POST" action="{{ route('github.personal.token') }}">
                        @csrf
                        <!-- Email Address -->
                            <div>
                                <x-input-label for="githubtoken" :value="__('Github Token')" />
                                <x-text-input id="githubtoken" class="block mt-1 w-full" type="text" name="githubtoken"  required autofocus />
                                <x-input-error :messages="$errors->get('githubtoken')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-start mt-4">

                                <x-primary-button class="ml-3">
                                    {{ __('insert') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>


                </div >

        </div>
    </div>
</x-app-layout>
