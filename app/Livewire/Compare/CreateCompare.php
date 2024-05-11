<?php

namespace App\Livewire\Compare;

use App\Models\Compare;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use LivewireUI\Modal\ModalComponent;

class CreateCompare extends ModalComponent{
    public $device1,$device2,$suggestions,$error;

    // Render function to return the associated view
    public function render(){
        return view('livewire.compare.create-compare');
    }

    // Function to handle the save operation
    public function save(){
        $this->validate(); // Validate input data based on rules specifie
      $co =   Compare::create([
            'device1' =>$this->device1,
            'device2' =>$this->device2,
            'user_id' =>Auth::user()->id
        ]);
        $this->closeModal();
        $this->dispatch('update-compare'); // Dispatch an event to update comparisons
    }
    
    // Define validation rules for input
    public function rules() : array{     
    return [
        'device1' =>  'required|min:10',
        'device2' => 'required|min:10',   
    ];
  }
}