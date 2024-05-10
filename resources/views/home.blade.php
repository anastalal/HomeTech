@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="hero px-2">
                    <h1 class="text-4xl font-bold mb-4">Simplify Your Life with Smart Home Solutions</h1>
                    <p class="text-1xl font-bold">Make Your Home a Smart Home – Convenience, Safety, Efficiency.</p>
                </div>
            </div>
        </div>
        <div class="mt-5">
            @if ($plans)
                <h1 class="text-center mb-10">Your Plans</h1>
                <div class="row">
                    @foreach ($plans as $plan)
                      <div class="col-md-3">
                            <div class="mycard" onclick="window.location.href='{{ route('plan.show', $plan->id) }}'">
                              <div class="top-section">
                                  <div class="mborder"></div>
                                  <div class="icons">
                                      <div class="mylogo">
                                          <small>{{ $plan->created_at->diffForHumans() }}</small>
                                      </div>
                                      <div class="social-media">
                                          <a href="{{ route('plan.show', $plan->id) }}">
                                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
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
                                <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                    fill="currentColor"></path>
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
