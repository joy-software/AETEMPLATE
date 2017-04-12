<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class groupController extends Controller
{
    public function index(){
        return view('group.index');
    }

    public function create_group(){
        return view('group.create_group');
    }

    public function search_group(){
        return view('group.search_group');
    }

    public function post_create_group(Request $request){

        /*Schema::create('group', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->string('logo');
*/
            $group = new group([
            'description'=> '',
            'name' =>'name',
            'logo' => 'logo'
        ]);
        $group->save();

    }
}
