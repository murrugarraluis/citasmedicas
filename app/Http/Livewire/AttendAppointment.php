<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AttendAppointment extends Component
{
	public $open = false;
	public $diagnostic;
	public $appointment;

	protected $rules = [
		'diagnostic' => 'required'
	];

	public function render()
	{
		return view('livewire.attend-appointment', compact($this->appointment));
	}

	public function mount($appointment)
	{
		$this->appointment = $appointment;
	}

	public function open()
	{
		$this->open = true;
	}

	public function store()
	{
		$this->validate();
		try {
			// Atender Cita
			$this->appointment->attentionsheet()->create([
				'description' => $this->diagnostic
			]);
//			Cambiar Estado de Cita
			$this->appointment->update([
				'status' =>'Atendido'
			]);
			$this->default();
			$this->emitTo('show-appointment', 'render');
			$this->emit('alert', 'Cita Atendida');
		} catch (\Exception $e) {
			$this->emit('error', $e->getMessage());
		}
	}

	public function default()
	{
		$this->reset(['open','diagnostic']);
		$this->resetErrorBag();
		$this->resetValidation();
	}
}
