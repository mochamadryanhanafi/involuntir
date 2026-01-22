<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $events = $this->eventService->getAllEvents();
        return ApiResponseHelper::sendResponse($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'event_date' => ['required', 'date'],
        ]);

        $event = $this->eventService->createEvent($request->all());

        return ApiResponseHelper::sendResponse($event, 'Event created successfully.', 201);
    }

    public function show($id)
    {
        $event = $this->eventService->getEventById($id);

        if (!$event) {
            return ApiResponseHelper::sendError('Event not found.');
        }

        return ApiResponseHelper::sendResponse($event);
    }

    public function join(Request $request, Event $event)
    {
        $user = Auth::user();
        $this->eventService->joinEvent($event, $user);

        return ApiResponseHelper::sendResponse(null, 'Successfully joined event.');
    }
}
