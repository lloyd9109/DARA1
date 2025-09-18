@extends('layouts.header')

@section('content')

<div class="contents">

<center><h1>this is teacher dashboard</h1></center>
    <form id="searchForm" action="/results" method="get">
        @csrf
        <div class="search">

                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
            </button>
        </div>
    </form>
