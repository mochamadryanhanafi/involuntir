<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
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
        return EventResource::collection($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'event_date' => ['required', 'date'],
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        $event = $this->eventService->createEvent($data);

        return ApiResponseHelper::sendResponse(new EventResource($event), 'Event created successfully.', 201);
    }

    public function show($id)
    {
        $event = $this->eventService->getEventById($id);

        if (!$event) {
            return ApiResponseHelper::sendError('Event not found.');
        }

        return new EventResource($event->load('users'));
    }

    public function join(Request $request, Event $event)
    {
        $user = Auth::user();
        $this->eventService->joinEvent($event, $user);

        return ApiResponseHelper::sendResponse(null, 'Successfully joined event.');
    }
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'event_date' => ['sometimes', 'date'],
        ]);

        $event = $this->eventService->updateEvent($event, $request->all());

        return ApiResponseHelper::sendResponse(new EventResource($event), 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $this->eventService->deleteEvent($event);

        return ApiResponseHelper::sendResponse(null, 'Event deleted successfully.');
    }
}
