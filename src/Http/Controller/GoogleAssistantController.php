<?php

namespace MakarenkoSergey\GoogleFields\Http\Controller;


use App\Repositories\GoogleApiRepository;
use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;

class GoogleAssistantController extends Controller
{
    protected $googleApiRepository;

    public function __construct(GoogleApiRepository $googleApiRepository)
    {
        $this->googleApiRepository = $googleApiRepository;
    }

    public function getPlacesByAddress(NovaRequest $novaRequest)
    {
        $address = $novaRequest->post('address');
        if (empty($address)) {
            return response()->json([]);
        }
        $places = $this->googleApiRepository->getPlacesByAddress($address);

        return response()->json($places->results->values()->toArray());
    }
}