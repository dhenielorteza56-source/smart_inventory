<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class BarcodeLookupController extends Controller
{
    public function lookup(Request $request): JsonResponse
    {
        $upc = preg_replace('/[\s\-]/', '', $request->query('upc', ''));

        // UPCs are 6–14 numeric digits (UPC-E, UPC-A, EAN-8, EAN-13, ITF-14)
        if (empty($upc) || ! preg_match('/^\d{6,14}$/', $upc)) {
            return response()->json([
                'code'    => 'INVALID_UPC',
                'message' => 'UPC must be 6–14 numeric digits.',
                'items'   => [],
            ], 422);
        }

        try {
            $response = Http::timeout(8)
                ->withHeaders(['Accept' => 'application/json'])
                ->get('https://api.upcitemdb.com/prod/trial/lookup', ['upc' => $upc]);

            // Pass the upstream status code through (200, 404, 429, etc.)
            return response()->json($response->json(), $response->status());
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return response()->json([
                'code'    => 'UPSTREAM_TIMEOUT',
                'message' => 'Barcode lookup service timed out. Please try again.',
                'items'   => [],
            ], 504);
        } catch (\Exception $e) {
            return response()->json([
                'code'    => 'SERVER_ERROR',
                'message' => 'An unexpected error occurred during barcode lookup.',
                'items'   => [],
            ], 502);
        }
    }
}
