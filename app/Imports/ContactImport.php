<?php

namespace App\Imports;

use App\Models\Contact;
use App\Models\Group;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class ContactImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Skip row if group is missing or empty
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
                'name'     => $row['name'],
                'email'    => $email,
            ]);
            return null; // No new row, just update
        }

        // Insert new record if email doesn't exist
        return new Contact([
            'group_id' => $groupId,
            'name'     => $row['name'],
            'email'    => $email,
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

    /**
     * Define chunk size for reading rows
     */
    public function chunkSize(): int
    {
        return 1000; // process 1000 rows at a time
    }

    /**
     * Define batch insert size
     */
    public function batchSize(): int
    {
        return 500; // insert 500 rows at once
    }
}
