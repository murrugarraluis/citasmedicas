<?php

namespace App\Http\Livewire;

use App\Models\CovidTeam;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCovidTeam extends Component
{
	use WithPagination;
	public $status = 'Activos';
	public $show = 5;
	public $sort = 'id';
	public $direction = 'desc';
	public $search;
	protected $listeners = ['restore', 'destroy', 'render'];
	public function render()
	{
		try {
			if ($this->status == 'Activos') {
				$teams = CovidTeam::where('hospital_id', '=', auth()->user()->hospital->id)
					->where(function ($query) {
						$query->where('name', 'like', '%' . $this->search . '%');
					})
					->orderBy($this->sort, $this->direction)->paginate($this->show);
			} else {
				$teams = CovidTeam::onlyTrashed()
					->where('hospital_id', auth()->user()->hospital->id)
					->where(function ($query) {
						$query->where('name', 'like', '%' . $this->search . '%');
					})
					->orderBy($this->sort, $this->direction)->paginate($this->show);
			}
			$this->resetPage();
			return view('livewire.show-covid-team', compact('teams'));
		} catch (Exception $e) {
			$this->emit('error', $e->getMessage());
		}
	}
	public function delete($id)
	{
		$this->emit('delete', 'Está Apunto de Eliminar el Equipo Covid', $id);
	}
	public function destroy($id)
	{
		try {
			// $user_hospital = Hospital::find($id)->user;
			// $user_hospital->roles()->detach([2,4]);
			CovidTeam::destroy($id);
			$this->emit('alert', 'Equipo Covid Eliminado');
		} catch (Exception $e) {
			$this->emit('error', $e->getMessage());
		}
	}
	public function renovate($id)
	{
		$this->emit('renovate', 'Este Equipo Covid a sido Eliminada Anteriormente', $id);
	}
	public function restore($id)
	{
		try {
			$objeto = CovidTeam::withTrashed()->where('id', $id);
			$objeto->restore();
			// $user_hospital = Hospital::find($id)->user;
			// $user_hospital->roles()->attach([2,4]);
			$this->emit('alert', 'Equipo Covid Restaurado');
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
}
