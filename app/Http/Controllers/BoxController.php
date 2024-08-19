<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
  public function index()
  {
    // Retrieve all boxes from the database
    $collection = Box::orderBy('id', 'desc')->paginate(10);
    $title = 'Daftar Kritik / Saran';

    // Pass the boxes to the view
    return view('admin.box.index', compact('collection', 'title'));
  }
}
