<?php

namespace App\Livewire\Compare;

use App\Models\Compare;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use LivewireUI\Modal\ModalComponent;
class CreateCompare extends ModalComponent
{
    public $device1,$device2,$suggestions,$error;
    public function render()
    {
        return view('livewire.compare.create-compare');
    }
    public function save(){
        $this->validate();
      $co =   Compare::create([
            'device1' =>$this->device1,
            'device2' =>$this->device2,
            'user_id' =>Auth::user()->id
        ]);
        $this->closeModal();
        $this->dispatch('update-compare'); 
        // $this->dispatch('create-compare',$co->id,'gen'); 
        // $this->dispatch('create-compare',7,'show'); 

    }
  public function rules() : array
  {     
    return [
        'device1' =>  'required|min:10',
        'device2' => 'required|min:10',
       
    ];
  }
}
