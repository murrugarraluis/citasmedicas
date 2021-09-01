<?php

namespace App\Http\Livewire;

use App\Models\Departament;
use App\Models\Provincie;
use App\Models\User;
use Exception;
use Livewire\Component;

class EditHospital extends Component
{
	public $open = false;
	public $departament = null, $provincie = null, $distritic = null;
	public $provincies = null, $distritics = null;
	public $name, $DNI, $firstname, $lastname, $email, $gender;
	public $hospital;
	protected $rules = [
		'departament' => 'required',
		'provincie' => 'required',
		'distritic' => 'required',
		'name' => 'required',
		'DNI' => 'required',
		'firstname' => 'required',
		'lastname' => 'required',
		'gender' => 'required',
		'email' => 'required|email',
	];
	public function render()
	{
		$departaments = Departament::all();

		$provincies = Departament::find($this->departament)->provincies;
		$this->provincies = $provincies;

		$distritics = Provincie::find($this->provincie)->distritics;
		$this->distritics = $distritics;


		return view('livewire.edit-hospital', compact('departaments'));
	}
	public function mount($hospital)
	{
		$this->hospital = $hospital;
		$this->departament = $hospital->distritic->provincie->departament->code;
		$this->provincie = $hospital->distritic->provincie->code;
		$this->distritic = $hospital->distritic->code;
		$this->name = $hospital->name;
		$this->DNI = $hospital->user->DNI;
		$this->firstname = $hospital->user->name;
		$this->lastname = $hospital->user->lastname;
		$this->email = $hospital->user->email;
		$this->gender = $hospital->user->gender;
	}
	public function update(){
		$this->validate();
		try {
			$user = User::find($this->hospital->user->id);
			$user->update([
				'DNI' => trim($this->DNI),
				'name' => trim(ucfirst($this->firstname)),
				'lastname' => trim(ucfirst($this->lastname)),
				'gender' => trim(ucfirst($this->gender)),
				'email' => trim(ucfirst($this->email)),
			]);
			$user->hospital->update(['name' => trim(ucfirst($this->name))]);
			$user->hospital->distritic()->associate($this->distritic)->save();

			$this->default();
			$this->emitTo('show-hospital','render');
			$this->emit('alert','Hospital Editado');

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
	public function updatedDepartament($id)
	{
		$provincies = Departament::find($id)->provincies;
		$this->provincies = $provincies;
	}
	public function updatedProvincie($id)
	{
		$distritics = Provincie::find($id)->distritics;
		$this->distritics = $distritics;
	}
}
