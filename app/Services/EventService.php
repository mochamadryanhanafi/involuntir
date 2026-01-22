<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;
use App\Repositories\EventRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EventService
{
    protected $eventRepository;

    

        public function __construct(EventRepository $eventRepository)

        {

            $this->eventRepository = $eventRepository;

        }

    

        public function getAllEvents(): LengthAwarePaginator

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

    

        public function updateEvent(Event $event, array $data): Event

        {

            return $this->eventRepository->update($event, $data);

        }

    

        public function deleteEvent(Event $event): void

        {

            $this->eventRepository->delete($event);

        }

    }

    