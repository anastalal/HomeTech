<?php

namespace App\Livewire\Compare;

use Exception;
use App\Models\Compare;
use Livewire\Component;
use Livewire\Attributes\On;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Auth;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;

// Defines a Livewire component for showing device comparisons
class ShowCompare extends Component{
    // Class attributes
    public $device1;
    public $device2;
    public $suggestions;
    public $error;
    public  $compars;
    
    // This method defines the main render method that will be called to display the view associated with this component
    public function render(){
        return view('livewire.compare.show-compare');
    }

    public function mount(){
        $this->device1='';
        $this->device2='';
       $this->compars = Auth::user()->compars->sortByDesc('created_at'); 
    }

    #[On('update-compare')] 
    // Event listener for updating comparison list
    public function update_compare(){
        $this->compars = Auth::user()->compars->sortByDesc('created_at');
    }

    // Delete a specific comparison by ID
    public function deleteCompare($id){
        Compare::findOrFail($id)->delete();
        $this->update_compare();
    }

    #[On('create-compare')] 
    // Event listener for creating suggestions for comparison
    public function getSuggestions($id,$type){ 
        $compare = Compare::find($id);
        $this->suggestions = '';
        if($type == 'show' && $compare->generated >0){
            if($compare){
                $this->device1 =  $compare->device1;
                $this->device2 =  $compare->device2;
                $this->suggestions  = $compare->content;
            }
        }else{
            $this->device1 =  $compare->device1;
            $this->device2 =  $compare->device2;
            try{
                $threadRun = $this->createAndRunThread();
                $this->loadAnswer($threadRun);
                $compare ->content = $this->suggestions;
                $compare->generated =  $compare->generated + 1;
                $compare->save();
                $this->update_compare();  
            }catch(Exception $e){
                $this->error = 'Request failed, please try again';
            }
        } 
    } 
    
    // Create and run a thread using OpenAI's API
    private function createAndRunThread(): ThreadRunResponse{
        return OpenAI::threads()->createAndRun([
            'assistant_id' => 'asst_WasD1pfAQlmy88GZQdvbS0eC', //This line specifies the ID of the assistant used for this thread
            'thread' => [
                'messages' => [ //Inside the thread, a list of messages that will be part of the thread is defined
                    [
                        'role' => 'user', // Authentacted
                        'content' => $this->generatePrompt(),
                    ],
                ],
            ],
        ]);
    }

    // Load the answer from OpenAI's thread run
    private function loadAnswer(ThreadRunResponse $threadRun ){
        while(in_array($threadRun->status, ['queued', 'in_progress'])) {
            $threadRun = OpenAI::threads()->runs()->retrieve(
                threadId: $threadRun->threadId,
                runId: $threadRun->id,
            );
        }

        if ($threadRun->status !== 'completed') {
            $this->error = 'Request failed, please try again';
        }

        $messageList = OpenAI::threads()->messages()->list(
            threadId: $threadRun->threadId,
        );

        $this->suggestions = $messageList->data[0]->content[0]->text->value;
    }

    // Generate a prompt for the thread
    private function generatePrompt(){
        return "compare between  {$this->device1} and {$this->device2}";
    }
}