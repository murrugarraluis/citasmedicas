<?php

namespace App\Http\Livewire;

use App\Models\Hospital;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class ShowHospital extends Component
{
	use WithPagination;
	public $status = 'Activos';
	public $show = 5;
	public $sort = 'hospitals.id';
	public $direction = 'desc';
	public $search;
	protected $listeners = ['restore', 'destroy', 'render'];

	public function render()
	{
		try {
			if ($this->status == 'Activos') {
				$hospitals = Hospital::join('distritics', 'distritics.id', '=', 'hospitals.distritic_id')
				->join('provincies', 'provincies.id', '=', 'distritics.provincie_id')
				->join('departaments', 'departaments.id', '=', 'provincies.departament_id')
				->join('users', 'users.id', '=', 'hospitals.user_id')
				->select('hospitals.*')
				->where(function ($query) {
					$query->where('hospitals.name', 'like', '%' . $this->search . '%')
					->orwhere('distritics.name', 'like', '%' . $this->search . '%')
					->orwhere('users.name', 'like', '%' . $this->search . '%')
					->orwhere('users.lastname', 'like', '%' . $this->search . '%')
					->orwhere('provincies.name', 'like', '%' . $this->search . '%')
					->orwhere('departaments.name', 'like', '%' . $this->search . '%');
				})
				->orderBy($this->sort, $this->direction)->paginate($this->show);;
			} else {
				$hospitals = Hospital::onlyTrashed()
					->where(function ($query) {
						$query->where('name', 'like', '%' . $this->search . '%');
					})
					->orderBy($this->sort, $this->direction)->paginate($this->show);
			}
			$this->resetPage();
			return view('livewire.show-hospital', compact('hospitals'));
		} catch (Exception $e) {
			$this->emit('error', $e->getMessage());
		}
	}

	public function delete($id)
	{
		$this->emit('delete', 'Está Apunto de Eliminar el Hospital', $id);
	}
	public function destroy($id)
	{
		try {
			$user_hospital = Hospital::find($id)->user;
			$user_hospital->roles()->detach([2, 4]);
			Hospital::destroy($id);
			$this->emit('alert', 'Hospital Eliminado');
		} catch (Exception $e) {
			$this->emit('error', $e->getMessage());
		}
	}
	public function renovate($id)
	{
		$this->emit('renovate', 'Este Hospital a sido Eliminada Anteriormente', $id);
	}
	public function restore($id)
	{
		try {
			$objeto = Hospital::withTrashed()->where('id', $id);
			$objeto->restore();
			$user_hospital = Hospital::find($id)->user;
			$user_hospital->roles()->attach([2, 4]);
			$this->emit('alert', 'Hospital Restaurado');
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
