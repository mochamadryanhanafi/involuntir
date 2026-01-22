<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EventRepository
{
    
        public function getAll(): LengthAwarePaginator
        {
            return Event::paginate();
        }
    
        public function create(array $data): Event
        {
            return Event::create($data);
        }
    
        public function findById(int $id): ?Event
        {
            return Event::find($id);
        }
    
        public function attachUser(Event $event, User $user): void
        {
            $event->users()->attach($user);
        }
    
        public function update(Event $event, array $data): Event
        {
            $event->update($data);
            return $event;
        }
    
        public function delete(Event $event): void
        {
            $event->delete();
        }
    }
    