<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ciudade;

class Ciudades extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $codigo_postal;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.ciudades.view', [
            'ciudades' => Ciudade::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('codigo_postal', 'LIKE', $keyWord)
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
		$this->codigo_postal = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'codigo_postal' => 'required',
        ]);

        Ciudade::create([ 
			'nombre' => $this-> nombre,
			'codigo_postal' => $this-> codigo_postal
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Ciudade Successfully created.');
    }

    public function edit($id)
    {
        $record = Ciudade::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->codigo_postal = $record-> codigo_postal;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'codigo_postal' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Ciudade::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'codigo_postal' => $this-> codigo_postal
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Ciudade Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Ciudade::where('id', $id)->delete();
        }
    }
}