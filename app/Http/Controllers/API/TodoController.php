<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\TodoResource;
use App\Komoditas;
use Illuminate\Http\Request;

class TodoController extends ApiController
{
    public function index()
    {
        $todos = Komoditas::all();
        // pakai collection resource
        return $this->success(
            TodoResource::collection($todos),
            'List of todos'
        );
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'title'     => 'required|string|max:255',
            'completed' => 'boolean',
        ]);

        $todo = Komoditas::create($payload);

        return $this->success(
            new TodoResource($todo),
            'Todo created',
            201
        );
    }

    public function show($id)
    {
        $todo = Komoditas::find($id);
        if (! $todo) {
            return $this->error('Todo not found', [], 404);
        }

        return $this->success(
            new TodoResource($todo),
            'Todo detail'
        );
    }

    public function update(Request $request, $id)
    {
        $todo = Komoditas::find($id);
        if (! $todo) {
            return $this->error('Todo not found', [], 404);
        }

        $payload = $request->validate([
            'title'     => 'sometimes|required|string|max:255',
            'completed' => 'sometimes|boolean',
        ]);

        $todo->update($payload);

        return $this->success(
            new TodoResource($todo),
            'Todo updated'
        );
    }

    public function destroy($id)
    {
        $todo = Komoditas::find($id);
        if (! $todo) {
            return $this->error('Todo not found', [], 404);
        }

        $todo->delete();

        // 204 No Content, tapi kita tetap kirim wrapper
        return $this->success(null, 'Todo deleted', 204);
    }
}
