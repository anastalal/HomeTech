<?php

namespace App\Livewire\Room;

use App\Models\Plan;
use App\Models\Room;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class CreateRoom extends ModalComponent{
    // Class attributes
    public $type = '';
    public $height = '';
    public $width = '';
    public $devices = [];
    public $plan;
    public $count = 0;
    
    // This method defines the main render method that will be called to display the view associated with this component
    public function render(){
        return view('livewire.room.create-room');
    }

    public function mount($plan){
        $plan = Plan::find($plan);
        $this->count = $plan->rooms->count() + 1;
    }

    // Validation rules for the form fields
    public function rules(){
        return [
            'type' =>  'required|min:5',
            'height' => 'required|integer|max:15,min:2',
            'width' => 'required|integer|max:15,min:2',
        ];
    }
   
    // Function to save a room using validated data.
    public function saveRoom(){
        // Validate form inputs based on the rules defined in the rules() method.
        $validated = $this->validate();
        // Decode the devices JSON to array format.
        $devices = json_decode($this->devices, true);
        // Create a new room in the database with the validated data and additional information.
        $room =  Room::create(array_merge($validated, ['devices' => $devices , 'plan_id' =>$this->plan]));
        // Closes the modal component after saving the room
        $this->closeModal();
        // Dispatch an event to update the plan in the UI
        $this->dispatch('update-plan', plan: $this->plan); 
    }
}