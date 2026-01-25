<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class PostularVacante extends Component
{
    use WithFileUploads;

    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required',
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme(){

        //$datos = $this->validate();
        $datos = $this->validate([
            'cv' => 'required',
        ]);
        //Almacernar cv en el disco duro
        $cv = $this->cv->store('public/cv');
        $datos['cv'] = str_replace('public/cv/','',$cv);


        //Crear el cadidato a la vacante

        $this->vacante->candidatos()->create([
            'user_id' => Auth::user()->id,
            'cv' => $datos['cv'],
        ]);
        //Crear notificacion y enviar el email


        //Mostrar el usuario un mensaje de ok
        session()->flash('mensaje','Se envió correctamente tu información, mucha suerte');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
