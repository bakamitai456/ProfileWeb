<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommandController extends Controller
{
    //
    public function manageCommand(Request $request){
    	$input = $request -> all();
    	return $this -> searchResult($input['text']);
    }

    function searchResult($command){
    	$commandList = explode(" ", $command);

    	return $commandList;
    }
}
