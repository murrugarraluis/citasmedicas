<?php

namespace App\Http\Livewire;

use App\Models\Departament;
use App\Models\Hospital;
use App\Models\Provincie;
use App\Models\User;
use Exception;
use Livewire\Component;

class CreateHospital extends Component
{
	public $open = false;
	public $departament = null, $provincie = null, $distritic = null;

	public $provincies = null, $distritics = null;
	public $name, $DNI, $firstname, $lastname, $email, $gender;
	protected $rules = [
		'departament' => 'required',
		'provincie' => 'required',
		'distritic' => 'required',
		'name' => 'required',
		'DNI' => 'required',
		'firstname' => 'required',
		'lastname' => 'required',
		'gender' => 'required',
		'email' => 'required',
	];
	public function render()
	{
		$departaments = Departament::all();
		return view('livewire.create-hospital', compact('departaments'));
	}
	public function store()
	{
		$this->validate();
		try {
			if (Hospital::where('name', $this->name, 'distritic_id',$this->distritic)->count()) {
				$this->emit('info', 'Hospital Ya Registrado');
			} else {
				if (Hospital::withTrashed()->where('name', $this->name,'distritic_id',$this->distritic)->count()) {
					// Llamar a methodo de confirmarcion de componente show-categories
					$objetos = Hospital::withTrashed()->where('name', $this->name,'distritic_id',$this->distritic)->get();
					// recorrer la colletion y extraer el IDs
					foreach ($objetos as $objeto) {
						$id = $objeto->id;
					}
					$this->emit('renovate', 'Este Hospital a sido Eliminada Anteriormente', $id);
					$this->default();
				} else {
					if (User::where('id',$this->DNI)->count()){
						$this->emit('info', 'Esta Persona ya tiene un hospital a cargo');
					}
					else{
						$user = User::create([
							'DNI' => trim($this->DNI),
							'name' => trim(ucfirst($this->firstname)),
							'lastname' => trim(ucfirst($this->lastname)),
							'gender' => trim(ucfirst($this->gender)),
							'email' => trim($this->email),
							'password' => bcrypt(trim($this->DNI)),
						]);
						$user->roles()->attach([2,4]);
						$hospital = $user->hospital()->create(['name' => trim(ucfirst($this->name))]);
						$hospital->distritic()->associate($this->distritic)->save();

						$this->default();
						$this->emitTo('show-hospital', 'render');
						$this->emit('alert', 'Hospital Agregado');
					}
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
		$this->reset(['open', 'name','departament','provincie','distritic','DNI','firstname','lastname','gender','email']);
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
