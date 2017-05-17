@extends('admin.app')

{{-- Web site Title --}}
@section('title')  @parent @endsection

{{-- Content --}}
@section('content')
  
  <!-- Content Header (Page header) -->

             <section class="content-header">
                <h1>Dashboard</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{url('/admin/dashboard')}}">
                            <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                            Dashboard
                        </a>
                    </li>
                </ol>
            </section>

    
@endsection
