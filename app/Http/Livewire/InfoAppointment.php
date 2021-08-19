<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InfoAppointment extends Component
{
	public $open = false;
	public $appointment ;
	public function render()
	{
		return view('livewire.info-appointment',compact($this->appointment));
	}
	public function mount($appointment)
	{
		$this->appointment = $appointment;
	}

	public function open()
	{
		$this->open = true;
	}

	public function default()
	{
		$this->reset(['open']);
		$this->resetErrorBag();
		$this->resetValidation();
	}
}
