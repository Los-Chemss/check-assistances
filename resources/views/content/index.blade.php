@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @if (Auth::user())
            <template v-if="menu==0">
                <content-component />/
                <content-component />
            </template>
            <template v-if="menu==1">
                <customers-component></customers-component>
            </template>
            <template v-if="menu==2">
                <payment-component></payment-component>
            </template>
            <template v-if="menu==3">
                <asistance-component></asistance-component>
            </template>
            <template v-if="menu==4">
                <membership-component></membership-component>
            </template>
            <template v-if="menu==5">
                <user-component></user-component>
            </template>
        @endif
    </div>
@endsection
