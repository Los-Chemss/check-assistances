@extends('layouts.app')
@section('content')
    {{-- <div class="container-fluid"> --}}
    @if (Auth::user())
        <template v-if="menu==0">
            <content-component />
        </template>
        <template v-if="menu==1">
            <customers-component />
        </template>
        <template v-if="menu==2">
            <payment-component />
        </template>
        <template v-if="menu==3">
            <asistance-component />
        </template>
        <template v-if="menu==4">
            <membership-component />
        </template>
        <template v-if="menu==5">
            <profile-component />
        </template>
        <template v-if="menu==6">
            <users-component />
        </template>
        <template v-if="menu==7">
            <products-component />
        </template>
        <template v-if="menu==8">
            <sales-component />
        </template>
        <template v-if="menu==9">
            <purchases-component />
        </template>
        <template v-if="menu==10">
            <branches-component />
        </template>
    @endif
    {{-- </div> --}}
@endsection
