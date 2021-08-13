<?php

namespace App\Http\Livewire;

use App\Models\CovidTeam;
use App\Models\Doctor;
use App\Models\User;
use Exception;
use Livewire\Component;
use PhpParser\Comment\Doc;


use Livewire\WithPagination;
class AddDoctor extends Component
{
    use WithPagination;
    public $status = 'Activos';
	public $show = 5;
	public $sort = 'doctors.id';
	public $direction = 'desc';
	public $search;
	public $user, $DNI, $name, $lastname, $speciality;
	protected $listeners = ['restore', 'render'];
    public $open = false;
	
	public $team;
    
	protected $rules = [
		'DNI' => 'required',
		'name' => 'required',
		'lastname' => 'required',
		'speciality' => 'required',
	];
   
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
    public function search(){
        try {
			$this->reset(['user','name', 'lastname', 'speciality']);
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


	public function clear()
	{
		$this->reset(['user', 'DNI', 'name', 'lastname', 'speciality']);
	}

    public function suprim($id)
	{
		try {
			$user = Doctor::find($id);
			$user->covidteams()->detach($this->team->id);
			$user->touch();
			$this->emit('alert', 'Doctor Eliminado');
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


    public function mount($team)
	{
		$this->team = $team;
	}
    public function render()
	{
		try {
			if ($this->status == 'Activos') {
				$doctors = Doctor::join('assignables', 'assignables.doctor_id', '=', 'doctors.id')
					->join('users', 'users.id', '=', 'doctors.user_id')
					->where('assignables.assignable_type', '=', 'App\Models\CovidTeam')
					->where('assignables.assignable_id', '=', $this->team->id)
					->select('doctors.*')
					->where(function ($query) {
						$query->where('users.DNI', 'like', '%' . $this->search . '%')
							->orwhere('users.name', 'like', '%' . $this->search . '%')
							->orwhere('users.lastname', 'like', '%' . $this->search . '%')
							->orwhere('doctors.speciality', 'like', '%' . $this->search . '%')
							->orwhere('users.gender', 'like', '%' . $this->search . '%')
							->orwhere('users.email', 'like', '%' . $this->search . '%')
							->orwhere('doctors.phone', 'like', '%' . $this->search . '%');
					})
					->orderBy($this->sort, $this->direction)->paginate($this->show);
			} else {
				// Vacio porque no hay opcion VER INACTIVOS
			}
			$this->resetPage();
			return view('livewire.add-doctor', compact('doctors'));
		} catch (Exception $e) {
			$this->emit('error', $e->getMessage());
		}
	}

    public function assign()
	{
		try {
			if ($this->DNI && $this->name) {
				$user = $this->user;
				$hospital = auth()->user()->hospital;
				if (!$this->searchMatches($user, $hospital)) {
                    $user->doctor->covidteams()->attach($this->team->id);
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
		$hospitales = $user->doctor->covidteams;
		$search = $hospital->id;
		foreach ($hospitales as $item) {
			if ($item->id == $search) {
				return true;
			}
		}
		return false;
	}
  

}
