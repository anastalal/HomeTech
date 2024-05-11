<?php

namespace App\Livewire\Plan;

use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component{
    // Class attributes 
    public $name = '';
    public $area = '';
    public $min_budget = '';
    public $max_budget = '';
    
    // This method defines the main render method that will be called to display the view associated with this component
    public function render(){
        return view('livewire.plan.create');
    }
    
    // This method defines the rules that validate the component's attributes
    public function rules(){
        return [
            'name' =>  'required|min:3',// The name field must be filled in with at least 3 characters
            'area' => 'required|integer|max:1000,min:5', // The area must be an integer between 5 and 1000
            'min_budget' => 'required|integer|max:100000,min:20|lt:max_budget', // Minimum budget must be at least 20 and less than the max_budget
            'max_budget' => 'required|integer|max:100000,min:20|gt:min_budget', // Maximum budget must be at least 20 and greater than the min_budget
        ];
    }
    
    // This method saves new plan using the validated data
    public function savePlan(){
        // The 'validate' method automatically applies the validation rules defined above
        $this->validate();

        // Creates new Plan record in the database 
        Plan::create([
            'name' =>$this->name,
            'area' =>$this->area,
            'min_budget' =>$this->min_budget,
            'max_budget'  =>$this->max_budget,
            'user_id'=>Auth::user()->id // Associates the new plan with the currently authenticated user
        ]);
        // Redirects the user to the '/home' route after the plan is saved
        return $this->redirect('/home');
    }
}