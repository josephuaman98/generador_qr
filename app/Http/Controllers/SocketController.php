<?php

namespace App\Http\Controllers;

use App\Events\SocketUpdated;
use Illuminate\Http\Request;
use App\Models\Libro;


class SocketController extends Controller
{
    public function index()
    {
        $libros = Libro::all();
        return view('socket.index',compact('libros'));
    }

    public function create()
    {
        
    }

    public function edit($id)
    {
        $libro = Libro::findOrFail($id);
        return view('socket.edit', compact('libro'));
    }

    public function update(Request $request, $id)
    {
 

        $libro = Libro::findOrFail($id);
        $libro->update($request->all());
        

        // Emitir el evento
        event(new SocketUpdated($libro->id, $request->nombre, $request->cantidad));

        return redirect()->route('socket.index')->with('success', 'WebSocket updated successfully.');
    }
}
