<x-app-layout>
    <form class="mx-10 pb-2" method="POST" action="/profile/{{ $user->username }}/update" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Profile</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md px-2">
                                <input value="{{ $user->username }}" type="text" name="username" id="username"
                                    autocomplete="username"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                                @error('username')
                                    <div class="mt-2 text-sm-text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="bio" class="block text-sm font-medium leading-6 text-gray-900">Bio</label>
                        <div class="mt-2">
                            <textarea id="bio" name="bio" rows="3"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $user->bio }}</textarea>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about yourself.</p>
                    </div>

                    <div class="col-span-full">
                        <label for="image" class="block text-sm font-medium leading-6 text-gray-900">image</label>
                        <div class="mt-2 flex items-center gap-x-3">
                            @if (filter_var($user->image, FILTER_VALIDATE_URL))
                                <img src="{{ $user->image }}" alt="{{ $user->username }} Profile Image"
                                    class="rounded-full w-20 md:w-40 border border-neutral-300">
                            @else
                                <img src="{{ asset('storage/' . $user->image) }}"
                                    alt="{{ $user->username }} Profile Image"
                                    class="rounded-full w-20 md:w-40 border border-neutral-300">
                            @endif


                            <input class="w-full border border-gray-200 bg-gray-50 block focus:outline-none rounded-xl"
                                name="image" id="file_input" type="file">
                            @error('image')
                                <div class="mt-2 text-sm-text-red-600">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input {{ $user->private_account ? 'checked' : '' }} id="private_account"
                                name="private_account" type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="text-sm leading-6">
                            <label for="private_account" class="font-medium text-gray-900">Private Account</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
                <form class="mx-10 pb-10" action="" method="POST">

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">
                                Name</label>
                            <div class="mt-2">
                                <input value="{{ $user->name }}" type="text" name="name" id="name"
                                    autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @error('name')
                                    <div class="mt-2 text-sm-text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                                Email</label>
                            <div class="mt-2">
                                <input value="{{ $user->email }}" type="text" name="email" id="email"
                                    autocomplete="family-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @error('email')
                                    <div class="mt-2 text-sm-text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                                Password</label>
                            <div class="mt-2">
                                <input type="password" name="password" id="password" autocomplete="family-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @error('password')
                                    <div class="mt-2 text-sm-text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <label for="password_confirmation"
                                class="block text-sm font-medium leading-6 text-gray-900">
                                password confirmation</label>
                            <div class="mt-2">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    autocomplete="family-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                @error('password_confirmation')
                                    <div class="mt-2 text-sm-text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
            </div>
    </form>
</x-app-layout>
