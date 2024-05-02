@extends('layouts.app')

@section('content')
<div class="container flex justify-content-center" style="margin-top: 12%">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-12">
            <div class="hero px-10">
                <h1 class="text-4xl font-bold mb-4">Simplify Your Life with Smart Home Solutions</h1>
                <p class="text-1xl font-bold">Make Your Home a Smart Home – Convenience, Safety, Efficiency.</p>
                <div class="cta-buttons mt-4">
                    <a href="{{ route('plan.create') }}" id="createPlan">Create Plan</a>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
