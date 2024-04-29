@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="hero">
                <h1>Simplify Your Life with Smart Home Solutions</h1>
                <p>Make Your Home a Smart Home – Convenience, Safety, Efficiency.</p>
                <div class="cta-buttons">
                    <a href="{{ route('plan.create') }}" id="createPlan">Create Plan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
