@php
$showMainNavbar = true ;
@endphp

@if($showMainNavbar)
@include('frontend.components.navbar')
@else
@include('frontend.components.guestnavbar')
@endif