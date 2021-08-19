<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Departament;
use App\Models\Distritic;
use App\Models\Hospital;
use App\Models\Provincie;
use Livewire\Component;

class CreateAppointment extends Component
{
	public $provincies = null, $distritics = null;
	public $departament = null, $provincie = null, $distritic = null, $hospital = null, $doctor = null;
	public $hospitals, $doctors;
	public $date = null;
	public $appointments = null;
	protected $rules = [
		'departament' => 'required',
		'provincie' => 'required',
		'distritic' => 'required',
		'hospital' => 'required',
		'doctor' => 'required',
		'date' => 'required',
	];

	public function render()
	{
		$departaments = Departament::all();
		$this->dispatchBrowserEvent('DOMContentLoaded');
//		$appointments = $this->appointments;
		return view('livewire.create-appointment', compact('departaments'));
	}

	public function store()
	{
		$this->validate();
		try {
			if (Appointment::where('date', $this->date)->where('doctor_id', $this->doctor)->count()) {
				$this->emit('info', 'No se puede reservar una cita en este horario');
			} else {
				// CREACION DE CITA
				$appointment01 = auth()->user()->appointments()->create(['date' => $this->date, 'status' => 'Pendiente']);
				// ASIGNAR DOCTOR Y HOSPITAL A CITA
				$appointment01->doctor()->associate($this->doctor);
				$appointment01->hospital()->associate($this->hospital);
				$appointment01->save();
				$this->reset(['departament', 'provincie', 'distritic', 'hospital', 'doctor', 'date']);
				$this->redirect('/citas');
			}
		} catch (Exception $e) {
			$this->emit('error', $e->getMessage());
		}
	}

	public function updatedDepartament($id)
	{
		$provincies = Departament::find($id)->provincies;
		$this->provincies = $provincies;
		$this->distritics = null;
		$this->hospitals = null;
		$this->doctors = null;
		$this->reset(['provincie', 'distritic', 'hospital', 'doctor','appointments']);
	}

	public function updatedProvincie($id)
	{
		$distritics = Provincie::find($id)->distritics;
		$this->distritics = $distritics;
		$this->hospitals = null;
		$this->doctors = null;
		$this->reset(['distritic', 'hospital', 'doctor','appointments']);
	}

	public function updatedDistritic($id)
	{
		$hospitals = Distritic::find($id)->hospitals;
		$this->hospitals = $hospitals;
		$this->doctors = null;
		$this->reset(['hospital', 'doctor','appointments']);
	}

	public function updatedHospital($id)
	{
		$doctors = Hospital::find($id)->doctors;
		$this->doctors = $doctors;
		$this->reset(['doctor']);
	}
	public function updatedDoctor($id)
	{
		$appointments = Appointment::where('doctor_id',$id)->where('status','!=','Atendido')->get();
		$this->appointments = compact('appointments');
	}
}
