<?php

namespace App\Http\Livewire;

use App\Models\CovidTeam;
use App\Models\Hospital;
use Exception;
use Livewire\Component;

class CreateCovidTeam extends Component
{

	public $open = false;
	public $name;
	protected $rules = [
		'name' => 'required',
	];
	public function render()
	{
		return view('livewire.create-covid-team');
	}
	public function store()
	{
		$this->validate();
		try {
			if (CovidTeam::where('name', $this->name)->count()) {
				$this->emit('info', 'Equipo Covid Ya Registrado');
			} else {
				if (CovidTeam::withTrashed()->where('name', $this->name)->count()) {
					// Llamar a methodo de confirmarcion de componente show-categories
					$objetos = CovidTeam::withTrashed()->where('name', $this->name)->get();
					// recorrer la colletion y extraer el IDs
					foreach ($objetos as $objeto) {
						$id = $objeto->id;
					}
					$this->emit('renovate', 'Este Equipo Covid a sido Eliminada Anteriormente', $id);
					$this->default();
				} else {
					$hospital = Hospital::find(auth()->user()->hospital->id);
					$hospital->covidteams()->create(['name' => trim(ucfirst($this->name))]);
					$this->default();
					$this->emitTo('show-covid-team', 'render');
					$this->emit('alert', 'Hospital Agregado');
				}
			}
		} catch (Exception $e) {
			$this->emit('error', $e->getMessage());
		}
	}
	public function open()
	{
		$this->default();
		$this->open = true;
	}
	public function default()
	{
		$this->reset(['open']);
		$this->resetErrorBag();
		$this->resetValidation();
	}
}
