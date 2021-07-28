<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

use function PHPUnit\Framework\isNull;

class ShowDoctor extends Component
{
	use WithPagination;
	public $status = 'Activos';
	public $show = 5;
	public $sort = 'id';
	public $direction = 'desc';
	public $search;
	public $user, $DNI, $name, $lastname, $speciality;
	protected $listeners = ['restore', 'destroy', 'render'];
	protected $rules = [
		'DNI' => 'required',
		'name' => 'required',
		'lastname' => 'required',
		'speciality' => 'required',
	];
	public function render()
	{
		try {
			if ($this->status == 'Activos') {
				// $doctors = Doctor::join('assignables', 'assignables.doctor_id', '=', 'doctors.id')
				// 	->where('assignables.assignable_type', '=', 'App\Models\Hospital')
				// 	->where('assignables.assignable_id', '=', auth()->user()->hospital->id)
				// 	->where(function ($query) {
				// 		$query->where('doctors.id', 'like', '%' . $this->search . '%')
				// 			->orWhere('doctors.speciality', 'like', '%' . $this->search . '%');
				// 	})
				// 	->orderBy($this->sort, $this->direction)->paginate($this->show);

				$doctors = Doctor::join('assignables', function ($join) {
					$join->on('assignables.doctor_id', '=', 'doctors.id')
						->where('assignables.assignable_type', '=', 'App\Models\Hospital')
						->where('assignables.assignable_id', '=', auth()->user()->hospital->id);
				})->orderBy($this->sort, $this->direction)->paginate($this->show);
			} else {
				$doctors = Doctor::join('assignables', 'assignables.doctor_id', '=', 'doctors.id')->onlyTrashed()
					->where('assignables.assignable_type', '=', 'App\Models\Hospital')
					->where('assignables.assignable_id', '=', auth()->user()->hospital->id)
					->where(function ($query) {
						// $query->where('doctor.name', 'like', '%' . $this->search . '%');
					})
					->orderBy($this->sort, $this->direction)->paginate($this->show);
			}
			$this->resetPage();
			return view('livewire.show-doctor', compact('doctors'));
		} catch (Exception $e) {
			$this->emit('error', $e->getMessage());
		}
	}
	public function delete($id)
	{
		$this->emit('delete', 'Está Apunto de Eliminar el Doctor', $id);
	}
	public function destroy($id)
	{
		try {
			$user = Doctor::find($id);
			$user->hospitals()->detach(auth()->user()->hospital->id);
			$user->touch();
			$this->emit('alert', 'Doctor Eliminado');
		} catch (Exception $e) {
			$this->emit('error', $e->getMessage());
		}
	}
	public function renovate($id)
	{
		$this->emit('renovate', 'Este Doctor a sido Eliminada Anteriormente', $id);
	}
	public function restore($id)
	{
		try {
			$user = Doctor::find('id', $id);
			$user->hospitals()->attach(auth()->user()->hospital->id);
			$this->emit('alert', 'Doctor Restaurado');
		} catch (Exception $e) {
			$this->emit('error', $e->getMessage());
		}
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
	public function assign()
	{
		try {
			if ($this->DNI && $this->name) {
				$user = $this->user;
				$hospital = auth()->user()->hospital;
				if (!$this->searchMatches($user, $hospital)) {
					$user->doctor->hospitals()->attach($hospital->id);
					$this->reset(['user', 'DNI', 'name', 'lastname', 'speciality']);
					$this->emit('alert', 'Doctor Asignado');
				} else {
					$this->emit('info', 'Este doctor ya fue asigando');
					$this->reset(['user', 'DNI', 'name', 'lastname', 'speciality']);
				}
			} else {
				$this->emit('info', 'No se puede Asignar este doctor');
				$this->reset(['user', 'DNI', 'name', 'lastname', 'speciality']);
			}
		} catch (Exception $e) {
			$this->emit('error', $e->getMessage());
		}
	}
	public function searchMatches($user, $hospital)
	{
		$hospitales = $user->doctor->hospitals;
		$search = $hospital->id;
		foreach ($hospitales as $item) {
			if ($item->id == $search) {
				return true;
			}
		}
		return false;
	}
	public function search()
	{
		try {
			if ($this->DNI) {
				$user = User::where('DNI', '=', $this->DNI);
				if ($user->count()) {
					$user = User::where('DNI', '=', $this->DNI)->first();
					$doctor = Doctor::where('user_id', '=', $user->id);
					if ($doctor->count()) {
						// Mostrar Datos
						$doctor = Doctor::where('user_id', '=', $user->id)->first();
						$this->user = $user;
						$this->name = $user->name;
						$this->lastname = $user->lastname;
						$this->speciality = $doctor->speciality;
					} else {
						$this->emit('info', 'Doctor No Registrado');
					}
				} else {
					$this->emit('info', 'Doctor No Registrado');
				}
			}
		} catch (Exception $e) {
			$this->emit('error', $e->getMessage());
		}
	}
}
