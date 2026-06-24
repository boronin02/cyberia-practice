<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Contacts\ContactResource;
use App\Repositories\ContactRepository;
use Illuminate\Http\JsonResponse;

final class ContactsController extends Controller
{
    public function index(ContactRepository $repository): JsonResponse
    {
        $items = $repository->all();

        return $this->successful(
            message: __('api.base.success'),
            data: ContactResource::collection($items),
        );
    }
}
