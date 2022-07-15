<?php

namespace App\Repositories;

use App\Models\Family;
use App\Models\Student;

class StudentRepository{

    public function getStudentByRegistrationCode($registration_code){
        return Student::where('registration_code', $registration_code)->first();
    }

    public function getStudentsByParentId($id){
        $parent = Family::findOrFail($id);
        return $parent ? $parent->students()->get() : null;
    }

    public function assignFamily($student, $family){
        return $student->update(['family_id' => $family->id]);
    }

    public function getStudentsWithFamily(){
        return Student::with('family')->get();
    }
}