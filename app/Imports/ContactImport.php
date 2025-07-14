<?php

namespace App\Imports;

use App\Models\MailerContact;
use App\Models\Contact;
use App\Models\Group;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Skip row if list_name is missing or empty
        if (empty(trim($row['group'] ?? ''))) {
            return null;
        }
        $groupId = $this->checkGroupId($row['group']);

        // Normalize email for consistency
        $email = strtolower(trim($row['email']));

        // Try to find an existing record by email
        $existing = Contact::where('email', $email)->first();

        if ($existing) {
            // Update existing record
            $existing->update([
                'group_id' => $groupId,
                'name'    => $row['name'],
                'email' => $row['email'],
            ]);
            return null; // Returning null because update() doesn't need to create a new model
        }

        // Insert new record if email doesn't exist
        return new Contact([
            'group_id' => $groupId,
            'name'    => $row['name'],
            'email'   => $email,
        ]);
    }

    public function checkGroupId($name)
    {
        $group = Group::whereRaw('LOWER(name) = ?', [strtolower($name)])->first();

        if ($group) {
            return $group->id;
        }

        $group = new Group;
        $group->name = $name;
        $group->save();
        return $group->id;
    }
}
