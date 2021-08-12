<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAppointment extends Component
{
	use WithPagination;

	public $status = 'Activos';
	public $show = 5;
	public $sort = 'id';
	public $direction = 'desc';
	public $search;
	public $date_start, $date_end;
	protected $listeners = ['restore', 'destroy', 'render'];
	protected $rules = [
		'date_start' => 'required',
		'date_end' => 'required',
	];
	public function render()
	{
//		if ($this->date_start == null || $this->date_end == null){
//			$this->date_start = date('d/m/Y');
//			$this->date_end = date('d/m/Y');
//		}
		$appointments = Appointment::where('doctor_id', '=', auth()->user()->doctor->id)
			->whereBetween('date', [$this->date_start, $this->date_end])
			->orderBy($this->sort, $this->direction)->paginate($this->show);
//		dd($appointments);
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

	public function search()
	{
		if ($this->date_start == null || $this->date_end == null) {
			$this->emit('info', 'Complete los campos');
		} else {
			$date_start = date("d/m/Y", strtotime($this->date_start));
			$date_end = date("d/m/Y", strtotime($this->date_end));

			$this->date_start = $date_start;
			$this->date_end = $date_end;
		}

	}
}
