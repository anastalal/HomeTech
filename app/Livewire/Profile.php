<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Component{
    public $user; // Variable to store the authenticated user
    public $profileInformation = []; // Array to store profile information fields
    public $passwordUpdate = []; // Array to store password update fields
    
    // This method defines the main render method that will be called to display the view associated with this component
    public function render(){
        return view('livewire.profile');
    }

    public function mount(){
        $this->user = Auth::user(); // Assign authenticated user to the user variable
        $this->profileInformation = [
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'email' => $this->user->email,
            // Add other profile information fields here
        ];
    }
    
    // Validate the input data
    public function updateProfile(){
        $this->validate([
            'profileInformation.first_name' => 'required|string|max:255',
            'profileInformation.last_name' => 'required|string|max:255',
            'profileInformation.email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
        ]);
        // Update the user with new profile data
        $this->user->update($this->profileInformation);
        session()->flash('message', 'Profile updated successfully.');
    }

    public function updatePassword(){
        $this->validate([
            'passwordUpdate.current_password' => 'required|string',
            'passwordUpdate.new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if the current password is correct
        if (!Hash::check($this->passwordUpdate['current_password'], $this->user->password)) {
            $this->addError('passwordUpdate.current_password', 'The current password is incorrect.');
            return;
        }
        $this->user->update(['password' => Hash::make($this->passwordUpdate['new_password'])]);
        session()->flash('message2', 'Password updated successfully.');
    }
}
