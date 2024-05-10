<?php

namespace App\Livewire\Plan;

use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $name = '';
    public $area = '';
    public $min_budget = '';
    public $max_budget = '';
    public function render()
    {
        return view('livewire.plan.create');
    }
    public function rules()
    {
        return [
            'name' =>  'required|min:3',
            'area' => 'required|integer|max:1000,min:5',
            'min_budget' => 'required|integer|max:100000,min:20|lt:max_budget',
            'max_budget' => 'required|integer|max:100000,min:20|gt:min_budget',
        ];
    }
    public function savePlan()
    {
        // dd('aad');
        $this->validate();
        Plan::create([
            'name' =>$this->name,
            'area' =>$this->area,
            'min_budget' =>$this->min_budget,
            'max_budget'  =>$this->max_budget,
            'user_id'=>Auth::user()->id
        ]);
        return $this->redirect('/home');
    }
}
