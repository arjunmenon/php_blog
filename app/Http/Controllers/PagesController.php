<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
    	$title = 'Hello';
    	// return view('pages.index', compact('title'));
    	return view('pages.index')->with('title', $title);
    }

    public function about(){
    	return view('pages.about');
    }

    public function services(){
    	$data = array(
    		'title' => 'Services',
    		'services' => ['Accounts', 'Payables', 'Receivables']
    	);
    	return view('pages.services')->with($data);
    }
}
