<div>
	<div class="container mx-auto px-4 sm:px-8">
		<div class="py-8">
			<div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-8">
				<div class="grid grid-cols-1 my-2 md:grid-cols-3 md:gap-4 lg:grid-cols-1 lg:col-span-1 lg:gap-1">
					<div>
						<x-jet-label value="Departamento" class="mb-2"></x-jet-label>
						<select wire:model="departament"
										class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'">
							<option hidden>Seleccione</option>
							@foreach ($departaments as $departament )
								<option value="{{$departament->code}}">
									{{ $departament->name }}</option>
							@endforeach
						</select>
						@error('departament')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
					<div>
						<x-jet-label value="Provincia" class="mb-2"></x-jet-label>
						<select wire:model="provincie"
										class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'">
							<option hidden>Seleccione</option>
							@if (!is_null($provincies))
								@foreach ($provincies as $provincie )
									<option value="{{$provincie->code}}">
										{{ $provincie->name }}</option>
								@endforeach
							@endif
						</select>
						@error('provincie')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
					<div>
						<x-jet-label value="Distrito" class="mb-2"></x-jet-label>
						<select wire:model="distritic"
										class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'">
							<option hidden>Seleccione</option>
							@if (!is_null($distritics))
								@foreach ($distritics as $distritic )
									<option value="{{$distritic->code}}">
										{{ $distritic->name }} </option>
								@endforeach
							@endif
						</select>
						@error('distritic')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
					<div>
						<x-jet-label value="Hospital" class="mb-2"></x-jet-label>
						<select wire:model="hospital"
										class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'">
							<option hidden>Seleccione</option>
							@if (!is_null($hospitals))
								@foreach ($hospitals as $hospital )
									<option value="{{$hospital->id}}">
										{{ $hospital->name }} </option>
								@endforeach
							@endif
						</select>
						@error('hospital')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
					<div>
						<x-jet-label value="Doctor" class="mb-2"></x-jet-label>
						<select wire:model="doctor"
										class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'">
							<option hidden>Seleccione</option>
							@if (!is_null($doctors))
								@foreach ($doctors as $doctor )
									<option value="{{$doctor->id}}">
										{{ $doctor->user->name ." ".$doctor->user->lastname }} </option>
								@endforeach
							@endif
						</select>
						@error('doctor')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
					<div>
						<x-jet-label value="Fecha y Hora" class="mb-2"></x-jet-label>
						<input id="date" type="datetime-local" wire:model="date" disabled>
						@error('date')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="py-4 lg:col-span-2">
					<div id='calendar'></div>
					<div class="flex justify-center md:justify-end mt-4">
						<x-jet-button wire:click="store()" wire:loading.attr='disabled' wire:target="store">Guardar</x-jet-button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		window.addEventListener('DOMContentLoaded', event => {
			var myDate = @this.date;
			var f = new Date();
			var m = (f.getMonth() + 1).toString().length < 2 ? '0' + (f.getMonth() + 1) : (f.getMonth() + 1);
			var h = f.getHours().toString().length < 2 ? '0' + (f.getHours()+1) + ':00' : (f.getHours()+1) + ':00';
			var fecha = f.getFullYear() + "-" + m + "-" + f.getDate();
			var fechaGlobal = f.getFullYear() + "-" + m + "-" + f.getDate() + 'T' + h;
			console.log(fechaGlobal);
			var calendarEl = document.getElementById('calendar');
			var calendar = new FullCalendar.Calendar(calendarEl, {
					locale: 'es',
					initialDate: fecha,
					initialView: 'timeGridWeek',
					nowIndicator: true,
					headerToolbar: {
						left: 'prev,next today',
						center: 'title',
						right: ''
					},
					navLinks: false, // can click day/week names to navigate views
					editable: false,
					selectable: false,
					selectMirror: true,
					dayMaxEvents: true, // allow "more" link when too many events
					height: 550,
					expandRows: true,
					slotDuration: '01:00',
					allDaySlot: false,
					slotMinTime: "08:00:00",
					slotMaxTime: "19:00:00",
					windowResize: function (arg) {
					},
					slotLabelFormat: {
						hour: '2-digit',
						minute: '2-digit',
						omitZeroMinute: true,
						meridiem: 'short',
						hour12: true
					},
					eventTimeFormat: {
						hour: '2-digit',
						minute: '2-digit',
						hour12: true
					},
					dateClick: function (info) {
						var inputF = document.getElementById("date");
						var dateF = new Date(info.dateStr);
						var m = (dateF.getMonth() + 1).toString().length < 2 ? '0' + (dateF.getMonth() + 1) : (dateF.getMonth() + 1);
						var h = dateF.getHours().toString().length < 2 ? '0' + (dateF.getHours()) + ':00' : (dateF.getHours()) + ':00';
						var fechaM = dateF.getFullYear() + "-" + m + "-" + dateF.getDate() + 'T' + h;
						if (fechaM < fechaGlobal){
							Livewire.emit('info','no se puede realizar la cita en esta fecha')
						}
						else{
							inputF.value = fechaM;
							@this.date= fechaM;
							fechaM = null;
						}
					},
					events: [
						{
							groupId: 999,
							title: 'Mi Cita',
							start: myDate
						},
						{
							groupId: 999,
							title: 'Ocupado',
							start: '2021-08-20T13:00',
							color: 'red',
						},
						{
							groupId: 'testGroupId',
							start: fechaGlobal,
							end: '4021-08-18T16:00',
							display: 'inverse-background',
							color: 'red',
						}
					]
				})
			;
			calendar.render();
		});
	</script>
</div>
