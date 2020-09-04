<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Quote;
use App\Http\Resources\QuoteResource;
use Illuminate\Http\Request;

class QuoteController extends Controller
{

    public function index()
    {
        $quotes = Quote::latest()->paginate(10);

        return QuoteResource::collection($quotes);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
        ]);
        $quote = Quote::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return new QuoteResource($quote);
    }

    public function show($id)
    {
        $quote = Quote::findOrFail($id);

        return new QuoteResource($quote);
    }

    public function update(Request $request, Quote $quote)
    {
        $this->authorize('update',  $quote);

        $quote->update([
            'message' => $request->message,
        ]);

        return new QuoteResource($quote);
    }

    public function destroy(Quote $quote)
    {
        $this->authorize('delete', $quote);

        $quote->delete();

        return response()->json([
            'message' => 'Quote has ben deleted'
        ]);
    }
}
