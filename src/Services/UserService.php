<?php

namespace GreenStreet\Extension\Services;

use GreenStreet\Extension\Models\User as UserModel;
use GreenStreet\Extension\Dto\User as UserDto;
use Illuminate\Database\Eloquent\Collection;

final class UserService implements UserServiceInterface
{
    public function __construct(public Image $imageService)
    {
    }

    public function getAll(): Collection
    {
        return UserModel::all();
    }

    public function create(UserDto $dto): UserModel
    {
        return UserModel::create([
            'name'  => $dto->name,
            'slug'   => $dto->slug,
            'email' => $dto->email,
            'password' => $dto->password,
        ]);
    }

    public function getById(int $id): UserModel
    {
        return UserModel::findOrFail($id);
    }

    public function update(int $id, UserDto $dto): UserModel
    {
        $timing = UserModel::findOrFail($id);

        $timing->update([
            'name'  => $dto->name,
            'egn'   => $dto->slug,
            'email' => $dto->email,
            'password' => $dto->password,
        ]);

        return $timing;
    }

    public function delete(int $id): bool
    {
        return UserModel::findOrFail($id)->delete();
    }

    public function convertToDto(UserModel $timing): UserDto
    {
        return new UserDto(
            name: $timing->name,
            slug: $timing->slug,
            email: $timing->email,
            password: $timing->password,
        );
    }
}