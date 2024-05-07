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
class Show extends ModalComponent
{
    // #[Reactive]
     public  $plan;
     public $suggestions;
     public $error;
    public function render()
    {
        return view('livewire.plan.show');
    }
    public function mount( $plan){
        $this->plan =Plan::find($plan);
    }
    public function deletePlan(){
       $plan = Plan::find($this->plan->id)->delete();
       return $this->redirect('/home');
    }
    public function deleteRoom($room, $plan){
        $room = Room::find($room)->delete();
        $this->update($plan);
        // return $this->redirect('/home');
     }
    #[On('update-plan')] 
    public function update($plan){
        $this->plan =Plan::find($plan);
    }
    public function getDeviceSuggestions($room,$type)
    {
        $room = Room::find($room);
        if($type == 'show'){
            if($room->generated>0){
                $this->suggestions = $room->content;
                $this->plan = Plan::find($room->plan->id);
            }
            // else{
            //     $threadRun = $this->createAndRunThread($room);
            //     $this->loadAnswer($threadRun,$room);
            //     $this->plan = Plan::find($room->plan->id);
            // }
        }
        else{
               $threadRun = $this->createAndRunThread($room);
                $this->loadAnswer($threadRun,$room);
                $this->plan = Plan::find($room->plan->id);
        }
       
       
    }       
    private function createAndRunThread($room): ThreadRunResponse
    {
        return OpenAI::threads()->createAndRun([
            'assistant_id' => 'asst_FGqQ030ateyk9sj87K2IoBG9',
            'thread' => [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $this->generatePrompt($room),
                    ],
                ],
            ],
        ]);
    }
    private function loadAnswer(ThreadRunResponse $threadRun ,$room)
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
        $counter = $room->generated + 1;
        $room->update([
            'content' => $this->suggestions,
            'generated' => $counter,
        ]);
        $room->save();

    }
    private function generatePrompt($room)
    {
        $deviceNames = array_column($room->devices, 'value');
        $deviceList = implode(", ", $deviceNames);
        return "smart devices for a {$room->type} room measuring {$room->height} by {$room->width} meters. devices like {$deviceList}, ";
    }
}
