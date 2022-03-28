<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Restaurant\RestaurantRepository;
use App\Models\Restaurant\Restaurant;


class RestaurantController extends Controller
{

    // protected $restaurant_repo;
    // public function __construct(RestaurantRepository $restaurant_repo)
    // {
        
    //     $this->restaurant_repo = $restaurant_repo;
 
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{            
            DB::beginTransaction();
            $restaurant = $this->restaurant_repo->createRestaurant($request->all());
            DB::commit();
            return response()->json(['result'=>true,'title'=>__('variable.great'),'message'=>__('Restaurant has been added successfully.')],200)->setCallback(request()->input('callback'));
        }catch(Exception $e){
            DB::rollBack();
            Log::error(__('error'),[$e->getMessage()]);
            return response()->json(['result'=>false,'title'=>__('variable.sorry'),'message'=>__('error.500',['operation' => 'create practical'])],200)->setCallback(request()->input('callback'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_token)
    {
        $restaurant = $this->restaurant_repo->getById(decrypt_id_info($id_token));
        if(!$restaurant){
            abort(404);
        }
        return view('modules.restaurant.edit',compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_token)
    {
        $restaurant = $this->restaurant_repo->getById(decrypt_id_info($id_token));
        if(!$restaurant){
            return $this->responseFail(__('messages.not_found_msg',['module_name'=>'Restaurant']), ['title' => __('Great')]);
        }
        try{
            DB::beginTransaction();
            $restaurant = $this->restaurant_repo->updateRestaurant($restaurant, $request->all());
            if(!$restaurant){
                return $this->responseFail(__('error.500', ['operation' => __('restaurant has not been updated')]), ['title' => __('Sorry')]);
            }
            DB::commit();
            return $this->responseSuccessWithData(['message' =>__('restaurant has been updated'),'title' => __('Great')]);
        }
        catch(Exception $e){
            DB::rollBack();
            Log::error(__('Error').'=>',[$e->getMessage()]);
            return $this->responseFail(__('error.500', ['operation' => __('restaurant has not been updated')]), ['title' => __('Sorry')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::find(decrypt_id_info($id));
        if(!$restaurant){
            return $this->responseFail(__('messages.not_found_msg',['module_name'=>'Restaurant']), ['title' => __('Sorry')]);
        }
        try{
            DB::beginTransaction();
            $restaurant->delete();
            if(!$restaurant) {
                DB::rollBack();
                return $this->responseFail(__('error.500', ['operation' => __('')]), ['title' => __('variable.sorry')]);
            }
            DB::commit();
            return $this->responseSuccessWithData(['message' => __(''),'title' => __('variable.great')]);
        }catch(Exception $e){
            DB::rollBack();
            Log::error(__('Error').'=>',[$e->getMessage()]);
            return $this->responseFail(__('error.500', ['operation' => __('')]), ['title' => __('Sorry')]);
        }   
    }
}
