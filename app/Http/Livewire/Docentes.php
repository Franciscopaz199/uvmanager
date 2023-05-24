<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Docente;

class Docentes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $especialidad, $telefono, $email;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.docentes.view', [
            'docentes' => Docente::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('especialidad', 'LIKE', $keyWord)
						->orWhere('telefono', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->nombre = null;
		$this->especialidad = null;
		$this->telefono = null;
		$this->email = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'especialidad' => 'required',
		'telefono' => 'required',
		'email' => 'required',
        ]);

        Docente::create([ 
			'nombre' => $this-> nombre,
			'especialidad' => $this-> especialidad,
			'telefono' => $this-> telefono,
			'email' => $this-> email
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Docente Successfully created.');
    }

    public function edit($id)
    {
        $record = Docente::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->especialidad = $record-> especialidad;
		$this->telefono = $record-> telefono;
		$this->email = $record-> email;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'especialidad' => 'required',
		'telefono' => 'required',
		'email' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Docente::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'especialidad' => $this-> especialidad,
			'telefono' => $this-> telefono,
			'email' => $this-> email
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Docente Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Docente::where('id', $id)->delete();
        }
    }
}