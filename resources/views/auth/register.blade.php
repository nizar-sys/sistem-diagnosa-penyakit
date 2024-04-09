<x-guest-layout>
    <x-slot name="title">
        Register
    </x-slot>

    <x-auth-card>
    
        {{-- show alert if there is errors --}}
        <x-alert-error/>

        <x-slot name="title">
            Register
        </x-slot>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <!-- Name field -->
            <x-input type="text" text="Nama" name="name" />

            <!-- Email field -->
            <x-input type="text" text="Username" name="username" />

            <!-- Password field -->
            <x-input type="password" text="Password" name="password" />

            <!-- Password confirmation field -->
            <x-input type="password" text="Password Confirmation" name="password_confirmation" />
            
            
            {{-- input baru --}}
            <!-- umur field -->
            <x-input type="umur" text="Umur" name="umur" />
            <!-- no_hp field -->
            <x-input type="no_hp" text="Nomor Handphone" name="no_hp" />
            <!-- alamat field -->
            <x-input type="alamat" text="Alamat" name="alamat" />
            <!-- jenis_kelamin field -->
            <x-input type="jenis_kelamin" text="Jenis Kelamin" name="jenis_kelamin" />
            <x-button type="primary btn-block" text="Register" for="submit" />
        </form>
        <div class="text-center mt-4">
            <hr>
            <a class="font-weight-bold small" href="{{ route('login') }}">Sudah Punya Akun?</a>
        </div>
    </x-auth-card>
</x-guest-layout>
