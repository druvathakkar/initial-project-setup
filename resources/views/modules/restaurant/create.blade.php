@extends('layouts.admin')
@section('content')
<div class="d-flex flex-column-fluid">  
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form class="form" id="RestaurantForm" action="{{route('restaurant.store')}}" data-redirect-url="{{route('restaurant.create')}}" onsubmit="return false;">
                    <div class="card card-custom card-sticky" id="kt_page_sticky_card">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="la la-user-plus"></i>
                                </span>
                                <h3 class="card-label font-brand">
                                    Add Restaurant
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <button type="button" id="addRestaurantBtn" class="btn btn-success">
                                    Save
                                </button>
							</div>
                        </div>
                        <div class="card-body" style="padding: 1rem 1rem;">
                         @include('modules.restaurant._partials.form-fields')
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop 