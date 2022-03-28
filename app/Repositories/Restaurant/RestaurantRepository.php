<?php
namespace App\Repositories\Restaurant;

use App\Models\Restaurant\Restaurant;
use App\Repositories\EloquentDBRepository;

class RestaurantRepository extends EloquentDBRepository
{
    public function __construct(Restaurant $restaurant){
        $this->model = $restaurant;
    }
    
    public function createRestaurant($attributes){
        return $this->model->create([
            'name' => $attributes['name'],
            'phone_number' => $attributes['phone_number'],
            'email' => $attributes['email'],
            'restaurant_code' => $attributes['restaurant_code'],
            'restaurant_desc' => $attributes['restaurant_desc'],
        ]);
    }

    public function listAllRestaurants($search = NULL, $order_by = 'ASC'){
        return $this->model->when(!is_null($search), function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->orderBy('name', $order_by);
    }
    
    public function updateRestaurant(Restaurant $restaurant, $attributes){
        return $restaurant->update([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'phone_number' => $attributes['phone_number'],
            'restaurant_code' => $attributes['restaurant_code'],
            'restaurant_desc' => $attributes['restaurant_desc'],
        ]);
    }

   
}