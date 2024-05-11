<?php

namespace App\Livewire\Plan;

use App\Models\Plan;
use App\Models\Room;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\Http;
use LivewireUI\Modal\ModalComponent;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;

class Show extends ModalComponent{
    // Class attributes
    public  $plan;
    public $suggestions;
    public $error;
    
    // This method defines the main render method that will be called to display the view associated with this component
    public function render(){
        return view('livewire.plan.show');
    }

    public function mount( $plan){
        $this->plan =Plan::find($plan);
    }

    // This method deletes a plan based on its ID and redirects the user to the home page
    public function deletePlan(){
       $plan = Plan::find($this->plan->id)->delete();
       return $this->redirect('/home');
    }

    // This method deletes a specified Room and updates the associated Plan.
    public function deleteRoom($room, $plan){
        $room = Room::find($room)->delete();
        $this->update($plan);
    }

    // Event listener method to update the current plan in the component
    #[On('update-plan')] 
    public function update($plan){
        $this->plan =Plan::find($plan);
    }

    // Retrieves or generates device suggestions for a given room
    public function getDeviceSuggestions($room,$type){
        $room = Room::find($room); // Finds the room 
        if($type == 'show'){
            // If the type is 'show', and the room already has generated content 
            if($room->generated>0){
                // Sets the suggestions to the content of the room
                $this->suggestions = $room->content;
                $this->plan = Plan::find($room->plan->id);// Update
            }   
        }
        else{ // New device suggestions for the room
            // Calls createAndRunThread 
            $threadRun = $this->createAndRunThread($room);
            $this->loadAnswer($threadRun,$room); // Calls loadAnswer
            $this->plan = Plan::find($room->plan->id);// Update
        } 
    } 

    // Create and run a thread using OpenAI's API
    private function createAndRunThread($room): ThreadRunResponse{
        return OpenAI::threads()->createAndRun([
            'assistant_id' => 'asst_FGqQ030ateyk9sj87K2IoBG9', //This line specifies the ID of the assistant used for this thread
            'thread' => [
                'messages' => [
                    [
                        'role' => 'user', // Authentacted
                        'content' => $this->generatePrompt($room),
                    ],
                ],
            ],
        ]);
    }

    // This method processes the response from OpenAI's API
    private function loadAnswer(ThreadRunResponse $threadRun ,$room){
        // Loop to check the thread's status until it is no longer 'queued' or 'in_progress'
        while(in_array($threadRun->status, ['queued', 'in_progress'])) {
            $threadRun = OpenAI::threads()->runs()->retrieve(
                threadId: $threadRun->threadId,
                runId: $threadRun->id,
            );
        }
        
        // Check if the thread's status to handle failure cases
        if ($threadRun->status !== 'completed') {
            $this->error = 'Request failed, please try again';
        }

        // Retrieve the list of messages
        $messageList = OpenAI::threads()->messages()->list(
            threadId: $threadRun->threadId,
        );
        $this->suggestions = $messageList->data[0]->content[0]->text->value;
        $counter = $room->generated + 1; // Increment the 'generated' counter for the room
        
        // Update the room with the new suggestions and counter
        $room->update([
            'content' => $this->suggestions,
            'generated' => $counter,
        ]);
        $room->save(); // Save to the database
    }

    // Generate a prompt for the thread
    private function generatePrompt($room){
        $deviceNames = array_column($room->devices, 'value');
        $deviceList = implode(", ", $deviceNames);
        return "smart devices for a {$room->type} room measuring {$room->height} by {$room->width} meters. devices like {$deviceList}, ";
    }
}