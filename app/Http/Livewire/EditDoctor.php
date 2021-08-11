<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use Livewire\Component;
use Exception;

class EditDoctor extends Component
{
	public $open = false;
	public $doctor;
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
		return view('livewire.edit-doctor');
	}

	public function mount($doctor)
	{
		$this->doctor = $doctor;
		$this->DNI = $doctor->user->DNI;
		$this->name = $doctor->user->name;
		$this->lastname = $doctor->user->lastname;
		$this->specialty = $doctor->speciality;
		$this->gender = $doctor->user->gender;
		$this->email = $doctor->user->email;
		$this->phone = $doctor->phone;
	}

	public function update()
	{
		$this->validate();
		try {
			$doctor = Doctor::find($this->doctor->id);
			$doctor->update([
				'specialty' => trim(ucfirst($this->specialty)),
				'phone' => trim(ucfirst($this->phone)),
			]);
			$doctor->user->update([
				'DNI' => trim($this->DNI),
				'name' => trim(ucfirst($this->name)),
				'lastname' => trim(ucfirst($this->lastname)),
				'gender' => trim(ucfirst($this->gender)),
				'email' => trim($this->email),
			]);
			$this->default();
			$this->emitTo('show-doctor', 'render');
			$this->emit('alert', 'Doctor Editado');

		} catch (Exception $e) {
			$this->emit('error', $e->getMessage());
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
