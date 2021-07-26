<?php

namespace App\Http\Livewire;

use App\Models\CovidTeam;
use Exception;
use Livewire\Component;

class EditCovidTeam extends Component
{
	public $open = false;
	public $name;
	public $team;
	protected $rules = [
		'name' => 'required',
	];
	public function render()
	{
		return view('livewire.edit-covid-team');
	}
	public function mount($team)
	{
		$this->team = $team;
		$this->name = $team->name;
	}
	public function update(){
		$this->validate();
		try {
			$team = CovidTeam::find($this->team->id);
			$team->update([
				'name' => trim(ucfirst($this->name)),
			]);
			$this->default();
			$this->emitTo('show-covid-team','render');
			$this->emit('alert','Equipo Covid Editado');

		} catch (Exception $e) {
			$this->emit('error',$e->getMessage());
		}
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
