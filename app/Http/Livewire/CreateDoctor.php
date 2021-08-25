<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use App\Models\User;
use Exception;
use Livewire\Component;

class CreateDoctor extends Component
{
	public $open = false;
	public $DNI, $name, $lastname, $specialty, $email, $gender, $phone;
	protected $rules = [
		'DNI' => 'required',
		'name' => 'required',
		'lastname' => 'required',
		'specialty' => 'required',
		'gender' => 'required',
		'email' => 'required',
		'phone' => 'required',
	];
	public function render()
	{
		return view('livewire.create-doctor');
	}
	public function store()
	{
		$this->validate();
		try {
			if (Doctor::join('users','users.id','=','doctors.user_id')->where('users.DNI', $this->DNI)->count()) {
				$this->emit('info', 'Doctor Ya Registrado');
			} else {
				if (Doctor::join('users','users.id','=','doctors.user_id')->withTrashed()->where('DNI', $this->DNI)->count()) {
					// Llamar a methodo de confirmarcion de componente show-categories
					$objetos = Doctor::join('users','users.id','=','doctors.user_id')->withTrashed()->where('DNI', $this->DNI)->get();
					// recorrer la colletion y extraer el IDs
					foreach ($objetos as $objeto) {
						$id = $objeto->id;
					}
					$this->emit('renovate', 'Este Doctor a sido Eliminada Anteriormente', $id);
					$this->default();
				} else {
					$user = User::create([
						'DNI' => trim($this->DNI),
						'name' => trim(ucfirst($this->name)),
						'lastname' => trim(ucfirst($this->lastname)),
						'gender' => trim(ucfirst($this->gender)),
						'email' => trim($this->email),
						'password' => bcrypt(trim($this->DNI)),
					]);
					$user->doctor()->create(['speciality' => trim(ucfirst($this->specialty)), 'phone' => trim($this->phone)]);
					$user->doctor->hospitals()->attach(auth()->user()->hospital->id);
					$user->assignRole('Doctor');
					$this->default();
					$this->emitTo('show-doctor', 'render');
					$this->emit('alert', 'Doctor Agregado');
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

		$this->reset(['open','DNI', 'name','specialty','lastname', 'gender', 'email','phone']);
		$this->resetErrorBag();
		$this->resetValidation();
	}
}
