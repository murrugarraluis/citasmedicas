<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

	<!-- Styles -->
	<link rel="stylesheet" href="{{ mix('css/app.css') }}">

	@livewireStyles

	<!-- Scripts -->
	<script src="{{ mix('js/app.js') }}" defer></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body class="font-sans antialiased">
	<x-jet-banner />

	<div class="min-h-screen bg-gray-100">
		@livewire('navigation-menu')

		<!-- Page Heading -->
		@if (isset($header))
		<header class="bg-white shadow">
			<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
				{{ $header }}
			</div>
		</header>
		@endif

		<!-- Page Content -->
		<main>
			{{ $slot }}
		</main>
	</div>

	@stack('modals')

	@livewireScripts
	<script>
		Livewire.on('alert', function(message) {
								Swal.fire({
										// position: 'top-end',
										icon: 'success',
										title:message,
										showConfirmButton: false,
										timer: 1200
								})
						});

						Livewire.on('info', function(message) {
								Swal.fire(
										'Atencion!',
										message,
										'warning'
								)
						});
						Livewire.on('error', function(message) {
								Swal.fire({
										icon: 'error',
										title: 'Oops...',
										text: message,
								})
						});

						Livewire.on('delete', function(message, id) {
								Swal.fire({
										title: '¿Desea Eliminarlo?',
										text: message,
										icon: 'warning',
										showCancelButton: true,
										confirmButtonColor: '#3085d6',
										cancelButtonColor: '#d33',
										confirmButtonText: 'Si, Eliminar',
										cancelButtonText: 'No, Cancelar',
								}).then((result) => {
										if (result.isConfirmed) {
												Livewire.emit('destroy', id);
										}
								})
						});
						Livewire.on('renovate', function(message, id) {
								Swal.fire({
										title: '¿Desea Restaurarlo?',
										text: message,
										icon: 'warning',
										showCancelButton: true,
										confirmButtonColor: '#3085d6',
										cancelButtonColor: '#d33',
										confirmButtonText: 'Si, Restaurar',
										cancelButtonText: 'No, Cancelar',
								}).then((result) => {
										if (result.isConfirmed) {
												Livewire.emit('restore', id);
										}
								})
						});

	</script>
</body>

</html>
