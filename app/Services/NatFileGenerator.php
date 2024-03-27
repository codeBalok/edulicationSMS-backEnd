<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;

class NatFileGenerator
{
    public function generateNatFile($data)
    {
        $fileContent = $this->prepareFileContent($data);
        $filePath = 'nat_files/nat120.txt'; // Define the file path where you want to store the file

        //Store the file in the 'nat_files' directory within the storage disk
        Storage::disk('local')->put($filePath, $fileContent);
        // Write the content to the file
    
        return $filePath;
    }

    private function prepareFileContent($data)
    {
        $content = '';

        // Loop through the data and format it as required for the NAT file
        foreach ($data as $student) {
            $studentID = $student->id; // Assuming 'id' is the student's ID
            $name = $student->first_name; // Assuming 'name' is the student name

            // Format the data according to the NAT file specifications
            $formattedRow = sprintf("%-10s%-10s", $studentID, $name); // Adjust the format based on the specific requirements

            // Add the formatted row to the content
            $content .= $formattedRow . PHP_EOL; // PHP_EOL represents the end of the line
        }

        // Return the formatted content
        return $content;
    }
}
