<?php

namespace GreenStreet\Extension\Dto;

use Illuminate\Http\Request;

final readonly class User
{
    public function __construct(
        public string $name,
        public string $email,
        public string $slug,
        public string $password,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            slug: $data['slug'],
            password: $data['password'],
        );
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
            slug: $request->input('slug'),
            password: $request->input('password'),
        );
    }


}
