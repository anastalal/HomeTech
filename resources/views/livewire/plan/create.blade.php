<div>
    <div class="container w-full max-w-md mx-auto mt-1">
        <div class="row justify-content-center">
            <div class="col-md-12 p-5 px-4">
                <div class="form">
                    <div class="wrapper">
                        <div class="header">
                            <h2>Create My Own Plan</h2>
                        </div>
                        <form id="room-form" wire:submit="savePlan">
                            <div class="form-step">
                                <h3>Home Informations</h3>
                                <div class="input-group">
                                    <label for="home-area">Plan Name:</label>
                                    <input type="text" wire:model="name" id="plan-area" class=" @error('name') is-invalid @enderror" placeholder="Enter the plne name" >
                                    @error('name')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="input-group">
                                    <label for="home-area">Home Area:</label>
                                    <input type="text" wire:model="area" class=" @error('area') is-invalid @enderror" id="home-area" placeholder="Enter the home area" >
                                    @error('area')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="input-group">
                                    <label for="min-budget">Minimum Budget:</label>
                                    <input type="text" wire:model="min_budget" class=" @error('min_budget') is-invalid @enderror" id="min-budget" placeholder="Enter the Minimum Budget" >
                                    @error('min_budget')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="input-group">
                                    <label class="form-label" for="max-budget ">Maximum Budget:</label>
                                <input type="text" id="max-budget" class=" form-controsl @error('max_budget') is-invalid @enderror"  wire:model="max_budget" placeholder="Enter the Maximum budget" >
                                @error('max_budget')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                </div>
                            </div>
                           <button type="submit" class="mybtn">Next
                            <div class="icon">
                                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M0 0h24v24H0z" fill="none"></path>
                                  <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                                </svg>
                              </div>
                           </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
