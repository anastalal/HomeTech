@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="hero px-2">
                <h1>Simplify Your Life with Smart Home Solutions</h1>
                <p>Make Your Home a Smart Home – Convenience, Safety, Efficiency.</p>
                
                
                
            </div>
           
        </div>
    </div>
    <div class="mt-5">
        @if ($plans)
               <h1 class="text-center">Your Plans</h1>
               <div class="row">
                @foreach ($plans as $plan)
                <div class="col-md-3">
                    <div class="mycard">
                        <div class="top-section">
                          <div class="mborder"></div>
                          <div class="icons">
                            <div class="mylogo">
                                <small>{{$plan->created_at->diffForHumans()}}</small>
                            </div>
                            <div class="social-media">
                               <a href="{{ route('plan.show', $plan->id) }}">
                                <svg class="svg" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" >
                                    <path d="M9.75 12C9.75 10.7574 10.7574 9.75 12 9.75C13.2426 9.75 14.25 10.7574 14.25 12C14.25 13.2426 13.2426 14.25 12 14.25C10.7574 14.25 9.75 13.2426 9.75 12Z" fill="#1C274C"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 13.6394 2.42496 14.1915 3.27489 15.2957C4.97196 17.5004 7.81811 20 12 20C16.1819 20 19.028 17.5004 20.7251 15.2957C21.575 14.1915 22 13.6394 22 12C22 10.3606 21.575 9.80853 20.7251 8.70433C19.028 6.49956 16.1819 4 12 4C7.81811 4 4.97196 6.49956 3.27489 8.70433C2.42496 9.80853 2 10.3606 2 12ZM12 8.25C9.92893 8.25 8.25 9.92893 8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25Z" fill="#1C274C"/>
                                </svg>
                               </a>
                               <a href="#">
                                <svg class="svg" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none">
                                    <path d="M12 5.50063C7.50016 0.825464 2 4.27416 2 9.1371C2 14 6.01943 16.5914 8.96173 18.9109C10 19.7294 11 20.5 12 20.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                    <path opacity="0.5" d="M12 5.50063C16.4998 0.825464 22 4.27416 22 9.1371C22 14 17.9806 16.5914 15.0383 18.9109C14 19.7294 13 20.5 12 20.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                               </a>
                              <a href="#">
                                <svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                    <path d="M4 7H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6 10L7.70141 19.3578C7.87432 20.3088 8.70258 21 9.66915 21H14.3308C15.2974 21 16.1257 20.3087 16.2986 19.3578L18 10" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                              </a>
                              
                            </div>
                          </div>
                        </div>
                        <div class="bottom-section">
                          <span class="title">{{ $plan->name }}</span>
                          <div class="row row1">
                            <div class="item">
                              <span class="big-text">{{ $plan->area }}</span>
                              <span class="regular-text">Area</span>
                            </div>
                            <div class="item">
                              <span class="big-text">{{ $plan->rooms->count() }}</span>
                              <span class="regular-text">Rooms</span>
                            </div>
                            <div class="item">
                              <span class="big-text">{{ $plan->min_budget }} - {{ $plan->max_budget }}</span>
                              <span class="regular-text">Budget</span>
                            </div>
                            
                          </div>
                        </div>
                    </div>
                   
                </div>
                @endforeach
                
               </div>
               <div class="cta-buttons my-2 text-center mt-5">
                <a href="{{ route('plan.create') }}" class="btn mybtn" id="createPlan">Create New Plan
                    <div class="icon">
                        <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                        </svg>
                      </div>
                    </a>
            </div>
                @else
                <p>No plans available at the moment.</p>
                <div class="cta-buttons ">
                    <a href="{{ route('plan.create') }}" id="createPlan">Create Plan?</a>
                </div>
                @endif
                
    </div>
</div>
@endsection
