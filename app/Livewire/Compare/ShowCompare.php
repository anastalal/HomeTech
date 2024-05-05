<?php

namespace App\Livewire\Compare;

use Exception;
use App\Models\Compare;
use Livewire\Component;
use Livewire\Attributes\On;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Auth;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;

class ShowCompare extends Component
{
    public $device1;
    public $device2;
    public $suggestions;
    public $error;
    public  $compars;
    public function render()
    {
        return view('livewire.compare.show-compare');
    }
    public function mount()
    {
        $this->device1='';
        $this->device2='';
       $this->compars = Auth::user()->compars->sortByDesc('created_at');
       
    }
    #[On('update-compare')] 
    public function update_compare(){
        $this->compars = Auth::user()->compars->sortByDesc('created_at');

    }
    #[On('create-compare')] 
    public function getSuggestions($id,$type)
    {
        
        $compare = Compare::find($id);
        $this->suggestions = '';
        // dd($compare);
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
    private function createAndRunThread(): ThreadRunResponse
    {
        return OpenAI::threads()->createAndRun([
            'assistant_id' => 'asst_WasD1pfAQlmy88GZQdvbS0eC',
            'thread' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $this->generatePrompt(),
                    ],
                ],
            ],
        ]);
    }
    private function loadAnswer(ThreadRunResponse $threadRun )
    {
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
        // $room = Room::find($room);
        // $counter = $room->generated + 1;
        // $room->update([
        //     'content' => $this->suggestions,
        //     'generated' => $counter,
        // ]);
        // $room->save();

    }
    private function generatePrompt()
    {
        // $deviceNames = array_column($room->devices, 'value');
        // $deviceList = implode(", ", $deviceNames);
        return "compare between  {$this->device1} and {$this->device2}";
    }
}
