<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nama -->
        <div>
            <x-input-label for="pemilik_nama" :value="__('Nama')" class="mt-2"/>
            <x-text-input id="pemilik_nama" class="block mt-1 w-full" type="text" name="pemilik_nama" :value="old('pemilik_nama')" required autofocus autocomplete="pemilik_nama" />
            <x-input-error :messages="$errors->get('pemilik_nama')" class="mt-2" />
        </div>
    
        <!-- Tanggal Lahir -->
        <div>
            <x-input-label for="pemilik_tanggal_lahir" :value="__('Tanggal Lahir')" class="mt-4"/>
            <x-text-input id="pemilik_tanggal_lahir" class="block mt-1 w-full" type="date" name="pemilik_tanggal_lahir" :value="old('pemilik_tanggal_lahir')" required autofocus autocomplete="pemilik_tanggal_lahir" placeholder=" "/>
            <x-input-error :messages="$errors->get('pemilik_tanggal_lahir')" class="mt-2" />
        </div>
        
        <!-- Kontak -->
        <div>
            <x-input-label for="pemilik_kontak" :value="__('Nomer HP')" class="mt-4"/>
            <x-text-input id="pemilik_kontak" class="block mt-1 w-full" type="number" name="pemilik_kontak" :value="old('pemilik_kontak')" required autofocus autocomplete="pemilik_kontak" />
            <x-input-error :messages="$errors->get('pemilik_kontak')" class="mt-2" />
        </div>

        <!-- Pendidikan -->
        <div>
            <x-input-label for="pemilik_pendidikan" :value="__('Pendidikan')" class="mt-4"/>
            <div class="">
                <select id="pemilik_pendidikan" name="pemilik_pendidikan" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                    <option value="" disabled selected>--- pilih jenjang pendidikan ---</option>
                    <option value="TK">TK</option>
                    <option value="SD">SD</option>
                    <option value="SMP/sederajat">SMP/sederajat</option>
                    <option value="SMA/sederajat">SMA/sederajat</option>
                    <option value="S1/sederajat">S1/sederajat</option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('pemilik_pendidikan')" class="mt-2" />
        </div>
       
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Sudah mendaftar? Login') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
