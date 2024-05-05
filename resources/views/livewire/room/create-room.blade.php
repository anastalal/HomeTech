
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 p-5 px-4">
                <div class="form">
                    <div class="wrapper">
                        <div class="header">
                            <h2>Room Preferences</h2>
                            
                        </div>
                        <form id="room-form" wire:submit="saveRoom">
                            <div class="form-step">
                                <h3>Room Information: Room {{ $count }}</h3>
                                <div class="input-group">
                                    <label for="room-type">Room Type :</label>
                                    <select id="room-type"  wire:model="type"  class="form-select2 @error('type') is-invalid @enderror">
                                        <option value="">Select room type</option>
                                        <option value="living-room">Living Room</option>
                                        <option value="bedroom">Bedroom</option>
                                        <option value="Kitchen">Kitchen</option>
                                        <option value="Guest Room">Guest Room</option>
                                        <option value="Home Office">Home Office</option>
                                      </select>
                                    @error('type')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="input-group">
                                    <label for="home-area">Room Height:</label>
                                    <input type="text" wire:model="height" class=" @error('height') is-invalid @enderror" id="home-area" placeholder="Enter the room height" >
                                    @error('height')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="input-group">
                                    <label for="min-budget">Room Width:</label>
                                    <input type="text" wire:model="width" class=" @error('width') is-invalid @enderror" id="min-budget" placeholder="Enter the romm width " >
                                    @error('width')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="input-group" wire:ignore>
                                    <label class="form-label" for="devices">Device Type:</label>
                                    <input type="text" class="tg-input" id="tags" >
                                @error('devices')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                </div>
                            </div>
                           <button type="submit" class="mybtn">Create
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
@assets

<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
@endassets

@script
<script>
   console.log('Runs on page one');
  
    var input = document.getElementById('tags');
    var tagify = new Tagify(input, {
         whitelist: ['Thermostats' ,'Plugs and Switches','lighting','Home Hubs','Locks','Doorbells','Security Cameras','Blinds and Curtains','Speakers and Displays'],
      maxTags: 10,
      dropdown: {
        maxItems: 20,           // <- mixumum allowed rendered suggestions
        classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
        enabled: 0,             // <- show suggestions on focus
        closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
      }
      // Your Tagify configuration options here
    });
  
    input.addEventListener('change', onChange)
    function onChange(e){
  // outputs a String
  console.log(e.target.value) ;
  $wire.$set('devices',e.target.value)
    }
      tagify.on('remove', function(e) {
        
        // @this.job_title = e.target.value;
        $wire.$set('devices',e.target.value)
      });
      
 

</script>
@endscript

