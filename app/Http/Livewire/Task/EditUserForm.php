<?php

namespace App\Http\Livewire\Task;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditUserForm extends Component
{

    use WithFileUploads;

    public $user;

    public $email;

    public $avatar;

    public $deleteAvatar;

    public function mount()
    {
        $this->email = $this->user->email;
    }

    public function rules()
    {
        return [
            'user.name' => ['required', 'string', 'max:190'],
            'email' => ['required', 'string', 'max:255', 'email', Rule::unique('users', 'email')->ignore($this->user->id)],
            'user.phone_number' => ['required', 'numeric', 'digits:11', Rule::unique('users', 'phone_number')->ignore($this->user->id)],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,bmp,png']
        ];
    }


    public function submit()
    {
        try {
            $this->validate();

            if ($this->email != $this->user->email) {
                $this->user->email = $this->email;
                $this->user->email_verified_at = null;
            }


            if ($this->deleteAvatar) {
                Storage::delete($this->user->avatar);
                $this->user->avatar = null;
            } else {
                if (!is_null($this->avatar)) {
                    $this->user->avatar = '/storage/' . $this->avatar->store('users', 'public');
                }
            }
            $this->user->save();

            return redirect()->route('user.profile')->with('success', 'اطلاعات کاربری با موفقیت بروزرسانی شد ');

        } catch (\Exception $exception) {

        }

    }

    public function render()
    {
        return view('livewire.task.edit-user-form');
    }
}
