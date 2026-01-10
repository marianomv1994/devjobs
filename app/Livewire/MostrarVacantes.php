<?php

namespace App\Livewire;


use App\Models\Vacante;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class MostrarVacantes extends Component
{
    public function render()
    {
        $vacantes = Vacante::where('user_id', Auth::user()->id)->paginate(10);

        return view('livewire.mostrar-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}
