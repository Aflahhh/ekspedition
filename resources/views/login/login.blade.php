<style>
    select,
    {
    color: #aaa;
    font-weight: bold;
    outline: none;
    }
</style>
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form id="loginForm" method="POST" action="{{ route('login') }}" class="sign-in-form">
                    @csrf
                    <h2 class="title">Sign In</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" id="driver" class="block mt-1 w-full" name="driver"
                            :value="old('driver')" required autofocus autocomplete="username" placeholder="Nama" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" id="password" class="block mt-1 w-full"
                            name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <button id="login" type="submit" class="btn solid">{{ __('Login') }}</button>
                </form>

                {{-- REGISTRASI --}}
                <form method="POST" action="{{ route('register') }}" class="sign-up-form">
                    @csrf
                    <h2 class="title">Sign Up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" id="driver" class="block mt-1 w-full" name="driver"
                            :value="old('driver')" required autofocus autocomplete="username" placeholder="Nama" />
                        <x-input-error :messages="$errors->get('driver')" class="mt-2" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" class="block mt-1 w-full" name="email"
                            :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="input-field flex items-center">
                        <i class="fa fa-truck mr-2"></i>
                        <select id="nomor_polisi" class="block w-full" name="nomor_polisi" style="margin-top: -1px;"
                            required placeholder="Nomor Polisi Armada">
                            <option value="">Pilih Nomor Polisi</option>
                            @foreach ($armada as $nopol)
                                <option value="{{ $nopol->nomor_polisi }}">{{ $nopol->nomor_polisi }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('nomor_polisi')" class="mt-2" />
                    </div>


                    <div class="input-field">
                        <i class="fa fa-info-circle"></i>
                        <input type="text" id="jenis_armada" class="block mt-1 w-full" name="jenis_armada" readonly
                            placeholder="Jenis Armada" />
                        <x-input-error :messages="$errors->get('jenis_armada')" class="mt-2" />
                    </div>
                    <input type="hidden" id="id_armada" name="id_armada" />
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" id="password" class="block mt-1 w-full"
                            name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-check"></i>
                        <input type="password" placeholder="Confirm Password" id="password_confirmation"
                            class="block mt-1 w-full" name="password_confirmation" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <button type="submit" class="btn solid">{{ __('Register') }}</button>
                </form>

            </div>
        </div>


        {{-- END REGISTRASI --}}

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Belum Punya Akun?</h3>
                    <p>Daftarkan Dirimu Dengan Klik Tombol Dibawah</p>
                    <button class="btn transparent" id="sign-up-btn">Sign Up</button>
                </div>
                <img src="{{ URL('images/paket.png') }}" class="image">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>Sudah Punya Akun?</h3>
                    <p>Login Dengan Tombol Dibawah</p>
                    <button class="btn transparent" id="sign-in-btn">Sign In</button>
                </div>
                <img src="{{ URL('images/team.png') }}" class="image">
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#nomor_polisi').on('change', function() {
                var nomorPolisi = $(this).val();
                if (nomorPolisi) {
                    $.ajax({
                        url: '{{ route('getArmadaDetails') }}',
                        type: 'GET',
                        data: {
                            nomor_polisi: nomorPolisi
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data) {
                                $('#jenis_armada').val(data.jenis_armada);
                                $('#id_armada').val(data.id_armada);
                            } else {
                                $('#jenis_armada').val('');
                                $('#id_armada').val('');
                            }
                        }
                    });
                } else {
                    $('#jenis_armada').val('');
                    $('#id_armada').val('');
                }
            });
        });
    </script>

</x-guest-layout>







{{-- <form method="POST" action="{{ route('login') }}">
        @csrf --}}

{{-- <!-- Email Address -->
        <div>
            <x-input-label for="driver" :value="__('Nama')" />
            <x-text-input id="driver" class="block mt-1 w-full" type="text" name="driver" :value="old('driver')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('driver')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}
