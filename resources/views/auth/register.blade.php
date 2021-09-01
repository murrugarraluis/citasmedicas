<x-guest-layout>
	<x-jet-authentication-card>
		<x-slot name="logo">
			<x-jet-authentication-card-logo/>
		</x-slot>

		<x-jet-validation-errors class="mb-4"/>

		<form method="POST" action="{{ route('register') }}">
			@csrf
			<div class="mt-3">
				<x-jet-label for="DNI" value="{{ __('Documento') }}"/>
				<x-jet-input id="DNI" class="block mt-1 w-full" type="text" name="DNI" :value="old('DNI')" required autofocus
										 autocomplete="DNI"/>
			</div>
			<div class="mt-3">
				<x-jet-label for="name" value="{{ __('Nombre') }}"/>
				<x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus
										 autocomplete="name"/>
			</div>
			<div class="mt-3">
				<x-jet-label for="lastname" value="{{ __('Apellido') }}"/>
				<x-jet-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')"
										 required autofocus
										 autocomplete="lastname"/>
			</div>
			<div class="mt-3">
				<x-jet-label for="gender" value="{{ __('Sexo') }}"/>
				<select id="gender" type="text" name="gender" :value="old('gender')" required autofocus
								autocomplete="gender"
								class=" block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'">
					<option value="" hidden>Seleccione</option>
					<option value="Masculino">Masculino</option>
					<option value="Femenino">Femenino</option>
				</select>
			</div>
			<div class="mt-3">
				<x-jet-label for="email" value="{{ __('Email') }}"/>
				<x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
			</div>

			<div class="mt-3">
				<x-jet-label for="password" value="{{ __('Contraseña') }}"/>
				<x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
										 autocomplete="new-password"/>
			</div>

			<div class="mt-3">
				<x-jet-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}"/>
				<x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
										 required autocomplete="new-password"/>
			</div>

			@if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
				<div class="mt-4">
					<x-jet-label for="terms">
						<div class="flex items-center">
							<x-jet-checkbox name="terms" id="terms"/>

							<div class="ml-2">
								{!! __('I agree to the :terms_of_service and :privacy_policy', [
												'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
												'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
								]) !!}
							</div>
						</div>
					</x-jet-label>
				</div>
			@endif

			<div class="flex items-center justify-end mt-4">
				<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
					{{ __('¿Ya está registrado?') }}
				</a>

				<x-jet-button class="ml-4">
					{{ __('Registrar') }}
				</x-jet-button>
			</div>
		</form>
	</x-jet-authentication-card>
</x-guest-layout>
