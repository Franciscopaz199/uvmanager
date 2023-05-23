<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Car;

class Cars extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $model;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.cars.view', [
            'cars' => Car::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('model', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->name = null;
		$this->model = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		'model' => 'required',
        ]);

        Car::create([ 
			'name' => $this-> name,
			'model' => $this-> model
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Car Successfully created.');
    }

    public function edit($id)
    {
        $record = Car::findOrFail($id);
        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->model = $record-> model;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'model' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Car::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'model' => $this-> model
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Car Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Car::where('id', $id)->delete();
        }
    }
}