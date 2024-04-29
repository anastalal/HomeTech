<?php

namespace App\Livewire\Room;

// use Livewire\Component;

use App\Models\Plan;
use App\Models\Room;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class CreateRoom extends ModalComponent
{
    public $type = '';
    public $height = '';
    public $width = '';
    public $devices = [];
    public $plan;
    public $count = 0;
    public function render()
    {
        return view('livewire.room.create-room');
    }
    public function mount($plan){
        $plan = Plan::find($plan);
        $this->count = $plan->rooms->count() + 1;
    }
    public function rules()
    {
        return [
            'type' =>  'required|min:5',
            'height' => 'required|integer|max:10,min:2',
            'width' => 'required|integer|max:10,min:2',
            // 'max_budget' => 'required|integer',
        ];
    }
   
    public function saveRoom()
    {
        // dd($this->plan);
        $validated = $this->validate();
        $devices = json_decode($this->devices, true);
        $room =  Room::create(array_merge($validated, ['devices' => $devices , 'plan_id' =>$this->plan]));
        // $this->profile->update(array_merge($validated, ['job_title' => $jobTitles]));
        $this->closeModal();
        $this->dispatch('update-plan', plan: $this->plan); 
       

    }
    
}
