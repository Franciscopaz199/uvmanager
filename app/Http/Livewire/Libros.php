<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Libro;

class Libros extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $titulo, $autor;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.libros.view', [
            'libros' => Libro::latest()
						->orWhere('titulo', 'LIKE', $keyWord)
						->orWhere('autor', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->titulo = null;
		$this->autor = null;
    }

    public function store()
    {
        $this->validate([
		'titulo' => 'required',
		'autor' => 'required',
        ]);

        Libro::create([ 
			'titulo' => $this-> titulo,
			'autor' => $this-> autor
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Libro Successfully created.');
    }

    public function edit($id)
    {
        $record = Libro::findOrFail($id);
        $this->selected_id = $id; 
		$this->titulo = $record-> titulo;
		$this->autor = $record-> autor;
    }

    public function update()
    {
        $this->validate([
		'titulo' => 'required',
		'autor' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Libro::find($this->selected_id);
            $record->update([ 
			'titulo' => $this-> titulo,
			'autor' => $this-> autor
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Libro Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Libro::where('id', $id)->delete();
        }
    }
}