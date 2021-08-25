<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAppointment extends Component
{
	use WithPagination;

	public $show = 5;
	public $sort = 'appointments.id';
	public $direction = 'desc';
	public $status01 = 'Atendido';
	public $status02 = 'Atendido';
	public $search;
	public $date_start, $date_end;
	public $status;
	protected $listeners = ['restore', 'destroy', 'render'];
	protected $rules = [
		'date_start' => 'required',
		'date_end' => 'required',
	];

	public function render()
	{
//		$appointments = Appointment::where('user_id', '=', auth()->user()->id)
//			->whereBetween('date', [$this->date_start, $this->date_end])
//			->orderBy($this->sort, $this->direction)->paginate($this->show);
//		dd($appointments);
  if(auth()->user()->role('Paciente')){
		$appointments = Appointment::join('hospitals', 'hospitals.id', '=', 'appointments.hospital_id')
			->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
			->join('users', 'users.id', '=', 'doctors.user_id')
			->where('appointments.user_id', '=', auth()->user()->id)
			->where('appointments.status', '!=', $this->status01)
			->where('appointments.status', '!=', $this->status02)
			->select('appointments.*')
			->where(function ($query) {
				$query->where('hospitals.name', 'like', '%' . $this->search . '%')
					->orwhere('users.name', 'like', '%' . $this->search . '%')
					->orwhere('users.lastname', 'like', '%' . $this->search . '%');
			})
			->orderBy($this->sort, $this->direction)->paginate($this->show);
	}
  if (auth()->user()->role('Doctor')){
		$appointments = Appointment::join('hospitals', 'hospitals.id', '=', 'appointments.hospital_id')
//			->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
			->join('users', 'users.id', '=', 'appointments.user_id')
			->where('appointments.doctor_id', '=', auth()->user()->doctor->id)
			->where('appointments.status', '!=', $this->status01)
			->where('appointments.status', '!=', $this->status02)
			->select('appointments.*')
			->where(function ($query) {
				$query->where('hospitals.name', 'like', '%' . $this->search . '%')
					->orwhere('users.name', 'like', '%' . $this->search . '%')
					->orwhere('users.lastname', 'like', '%' . $this->search . '%');
			})
			->orderBy($this->sort, $this->direction)->paginate($this->show);
	}
		return view('livewire.show-appointment', compact('appointments'));
	}

	public function order($sort)
	{
		if ($this->direction == 'desc') {
			$this->direction = 'asc';
		} else {
			$this->direction = 'desc';
		}
		$this->sort = $sort;
	}

//	public function search()
//	{
//		if ($this->date_start == null || $this->date_end == null) {
//			$this->emit('info', 'Complete los campos');
//		} else {
//			$date_start = date("d/m/Y", strtotime($this->date_start));
//			$date_end = date("d/m/Y", strtotime($this->date_end));
//
//			$this->date_start = $date_start;
//			$this->date_end = $date_end;
//		}
//	}

	public function updatedStatus()
	{
		if ($this->status == 'Atendidos') {
			$this->status01 = 'Pendiente';
			$this->status02 = 'Retrasado';
		} else {
			$this->status01 = 'Atendido';
			$this->status02 = 'Atendido';
		}
	}

}
