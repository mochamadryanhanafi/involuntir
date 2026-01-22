<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;
use App\Repositories\EventRepository;
use Illuminate\Database\Eloquent\Collection;

class EventService
{
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getAllEvents(): Collection
    {
        return $this->eventRepository->getAll();
    }

    public function createEvent(array $data): Event
    {
        return $this->eventRepository->create($data);
    }

    public function getEventById(int $id): ?Event
    {
        return $this->eventRepository->findById($id);
    }

    public function joinEvent(Event $event, User $user): void
    {
        $this->eventRepository->attachUser($event, $user);
    }
}